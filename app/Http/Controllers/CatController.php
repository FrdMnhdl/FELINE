<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\View\View;

class CatController extends Controller
{
    /**
     * Display the published cat collection gallery.
     */
    public function index(): View
    {
        $cats = Cat::query()
            ->with('creator:id,name')
            ->latest()
            ->paginate(9);

        return view('cats.index', [
            'cats' => $cats,
        ]);
    }

    /**
     * Display an individual cat profile page.
     */
    public function show(Cat $cat): View
    {
        $cat->load('creator:id,name');

        return view('cats.show', [
            'cat' => $cat,
        ]);
    }
}
