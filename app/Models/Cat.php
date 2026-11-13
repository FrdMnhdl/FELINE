<?php

namespace App\Models;

use Database\Factories\CatFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'breed', 'age', 'gender', 'description', 'image_path'])]
class Cat extends Model
{
    /** @use HasFactory<CatFactory> */
    use HasFactory;

    public const GENDERS = ['Jantan', 'Betina'];

    /**
     * Get the user who registered this cat.
     *
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the public URL for the cat's primary photograph.
     */
    public function imageUrl(): string
    {
        $path = ltrim($this->image_path, '/');

        return asset('storage/'.$path);
    }

    /**
     * Get the public URL for the cat's optimized gallery thumbnail when available.
     */
    public function thumbnailUrl(): string
    {
        $thumbPath = self::thumbnailPathFor($this->image_path);

        if ($thumbPath !== null && Storage::disk('public')->exists($thumbPath)) {
            return asset('storage/'.$thumbPath);
        }

        return $this->imageUrl();
    }

    /**
     * Derive the deterministic thumbnail path corresponding to a stored cat photograph.
     */
    public static function thumbnailPathFor(?string $imagePath): ?string
    {
        if (! is_string($imagePath) || $imagePath === '') {
            return null;
        }

        $normalized = ltrim($imagePath, '/');
        if (! str_starts_with($normalized, 'cats/')) {
            return null;
        }

        $filename = pathinfo($normalized, PATHINFO_FILENAME);
        if ($filename === '') {
            return null;
        }

        return 'cats/thumbs/'.$filename.'.webp';
    }
}
