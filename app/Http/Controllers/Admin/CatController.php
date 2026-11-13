<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatRequest;
use App\Http\Requests\Admin\UpdateCatRequest;
use App\Models\Cat;
use App\Services\CatImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class CatController extends Controller
{
    public function __construct(
        private readonly CatImageService $imageService,
    ) {}

    /**
     * Show the form for adding a new cat to the collection.
     */
    public function create(): View
    {
        return view('admin.cats.create', [
            'genders' => Cat::GENDERS,
        ]);
    }

    /**
     * Validate and store a newly created cat record with its photograph.
     */
    public function store(StoreCatRequest $request): RedirectResponse
    {
        $imagePath = $this->imageService->store($request->file('image'));

        try {
            $cat = $request->user()->cats()->create([
                ...$request->safe()->except('image'),
                'image_path' => $imagePath,
            ]);
        } catch (Throwable $exception) {
            $this->imageService->delete($imagePath);

            throw $exception;
        }

        return redirect()
            ->route('cats.index')
            ->with('status', "{$cat->name} udah berhasil masuk ke galeri!");
    }

    /**
     * Show the form for editing an existing cat record.
     */
    public function edit(Cat $cat): View
    {
        return view('admin.cats.edit', [
            'cat' => $cat,
            'genders' => Cat::GENDERS,
        ]);
    }

    /**
     * Update an existing cat record and safely replace its photograph if a new one was uploaded.
     */
    public function update(UpdateCatRequest $request, Cat $cat): RedirectResponse
    {
        $attributes = $request->safe()->except('image');
        $previousImagePath = $cat->image_path;
        $newImagePath = null;

        if ($request->hasFile('image')) {
            $newImagePath = $this->imageService->store($request->file('image'));
            $attributes['image_path'] = $newImagePath;
        }

        try {
            $cat->update($attributes);
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                $this->imageService->delete($newImagePath);
            }

            throw $exception;
        }

        if ($newImagePath !== null && $newImagePath !== $previousImagePath) {
            $this->imageService->delete($previousImagePath);
        }

        return redirect()
            ->route('cats.show', $cat)
            ->with('status', "Data {$cat->name} berhasil diperbarui nih.");
    }

    /**
     * Delete a cat record and safely remove its stored photograph.
     */
    public function destroy(Request $request, Cat $cat): RedirectResponse
    {
        $catName = $cat->name;
        $imagePath = $cat->image_path;

        $cat->delete();
        $this->imageService->delete($imagePath);

        $redirectRoute = $request->input('return_to') === 'dashboard'
            ? 'admin.dashboard'
            : 'cats.index';

        return redirect()
            ->route($redirectRoute)
            ->with('status', "{$catName} sudah dihapus dari koleksi.");
    }
}
