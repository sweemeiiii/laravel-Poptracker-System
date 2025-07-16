<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Wishlist;
use App\Models\Owned;
use App\Models\Duplicate;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $ownedCount = Owned::count();
    $wishlistCount = Wishlist::count();
    $duplicateCount = Duplicate::count();

    // Calculate percentages
    $totalFigurines = $ownedCount + $wishlistCount + $duplicateCount;
    $ownedPercentage = $totalFigurines ? ($ownedCount / $totalFigurines) * 100 : 0;
    $wishlistPercentage = $totalFigurines ? ($wishlistCount / $totalFigurines) * 100 : 0;
    $duplicatePercentage = $totalFigurines ? ($duplicateCount / $totalFigurines) * 100 : 0;

    return view('user_dashboard.dashboard', compact('ownedCount', 'wishlistCount', 'duplicateCount', 'ownedPercentage', 'wishlistPercentage', 'duplicatePercentage'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
