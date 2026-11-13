<?php

namespace App\Services;

use App\Models\Cat;
use GdImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class CatImageService
{
    private const MAX_DIMENSION = 1400;

    private const THUMB_WIDTH = 720;

    private const SAFE_EXTENSIONS = [
        'jpeg' => 'jpg',
        'jpg' => 'jpg',
        'png' => 'png',
        'webp' => 'webp',
    ];

    /**
     * Store an uploaded cat photograph in public storage using a generated unique filename.
     */
    public function store(UploadedFile $file): string
    {
        $uuid = Str::uuid()->toString();
        $disk = Storage::disk('public');

        if ($this->canOptimizeWithGd()) {
            $webpRelativePath = 'cats/'.$uuid.'.webp';
            $optimized = $this->renderWebpPayload($file, self::MAX_DIMENSION, 84);

            if ($optimized !== null) {
                $stored = $disk->put($webpRelativePath, $optimized);

                if (! $stored) {
                    throw new RuntimeException('Unable to store the uploaded photograph.');
                }

                $thumbnail = $this->renderWebpPayload($file, self::THUMB_WIDTH, 80);
                if ($thumbnail !== null) {
                    $disk->put('cats/thumbs/'.$uuid.'.webp', $thumbnail);
                }

                return $webpRelativePath;
            }
        }

        $extension = self::SAFE_EXTENSIONS[$file->extension() ?? ''] ?? 'jpg';
        $filename = $uuid.'.'.$extension;
        $storedPath = $disk->putFileAs('cats', $file, $filename);

        if (! is_string($storedPath) || $storedPath === '') {
            throw new RuntimeException('Unable to store the uploaded photograph.');
        }

        return $storedPath;
    }

    /**
     * Safely delete a stored cat photograph and its corresponding thumbnail when present.
     */
    public function delete(?string $imagePath): void
    {
        if (! is_string($imagePath) || $imagePath === '') {
            return;
        }

        $normalized = ltrim($imagePath, '/');

        if (str_contains($normalized, '..') || ! str_starts_with($normalized, 'cats/')) {
            return;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($normalized)) {
            $disk->delete($normalized);
        }

        $thumbPath = Cat::thumbnailPathFor($normalized);
        if ($thumbPath !== null && $disk->exists($thumbPath)) {
            $disk->delete($thumbPath);
        }
    }

    /**
     * Determine whether PHP GD with WebP support is available in the current runtime.
     */
    private function canOptimizeWithGd(): bool
    {
        return extension_loaded('gd')
            && function_exists('imagecreatefromstring')
            && function_exists('imagewebp');
    }

    /**
     * Decode, orient, resize, and encode an uploaded image into WebP bytes.
     */
    private function renderWebpPayload(UploadedFile $file, int $maxSide, int $quality): ?string
    {
        $raw = @file_get_contents($file->getRealPath());
        if ($raw === false) {
            return null;
        }

        $source = @imagecreatefromstring($raw);
        if (! $source instanceof GdImage) {
            return null;
        }

        $source = $this->applyExifOrientation($source, $file);
        $width = imagesx($source);
        $height = imagesy($source);

        if ($width <= 0 || $height <= 0) {
            return null;
        }

        $target = $this->resizeProportionally($source, $width, $height, $maxSide);

        ob_start();
        $encoded = imagewebp($target, null, $quality);
        $bytes = ob_get_clean();

        unset($source, $target);

        if (! $encoded || ! is_string($bytes) || $bytes === '') {
            return null;
        }

        return $bytes;
    }

    /**
     * Normalize JPEG orientation based on EXIF metadata when available.
     */
    private function applyExifOrientation(GdImage $image, UploadedFile $file): GdImage
    {
        if (! function_exists('exif_read_data') || $file->getMimeType() !== 'image/jpeg') {
            return $image;
        }

        $exif = @exif_read_data($file->getRealPath());
        $orientation = $exif['Orientation'] ?? null;

        return match ($orientation) {
            3 => imagerotate($image, 180, 0) ?: $image,
            6 => imagerotate($image, -90, 0) ?: $image,
            8 => imagerotate($image, 90, 0) ?: $image,
            default => $image,
        };
    }

    /**
     * Scale an image proportionally so its longest side fits within maxSide.
     */
    private function resizeProportionally(GdImage $source, int $width, int $height, int $maxSide): GdImage
    {
        $longest = max($width, $height);
        if ($longest <= $maxSide) {
            imagealphablending($source, false);
            imagesavealpha($source, true);

            return $source;
        }

        $ratio = $maxSide / $longest;
        $targetWidth = max(1, (int) round($width * $ratio));
        $targetHeight = max(1, (int) round($height * $ratio));

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
        imagefill($canvas, 0, 0, $transparent);

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        return $canvas;
    }
}
