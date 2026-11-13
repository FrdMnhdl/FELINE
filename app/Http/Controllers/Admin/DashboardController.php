<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the administrator collection overview.
     */
    public function index(): View
    {
        $totalCats = Cat::query()->count();
        $recentCats = Cat::query()
            ->with('creator:id,name')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'totalCats' => $totalCats,
            'recentCats' => $recentCats,
        ]);
    }
}
