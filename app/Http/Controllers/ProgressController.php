<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Owned;
use App\Models\Duplicate;

class ProgressController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        $ownedCount = Owned::where('user_id', $userId)->count();
        $duplicateCount = Duplicate::where('user_id', $userId)->count();

        // Calculate percentages
        $total = $wishlistCount + $ownedCount + $duplicateCount;
        $ownedPercentage = ($total > 0) ? ($ownedCount / $total) * 100 : 0;
        $wishlistPercentage = ($total > 0) ? ($wishlistCount / $total) * 100 : 0;
        $duplicatePercentage = ($total > 0) ? ($duplicateCount / $total) * 100 : 0;

        return view('progress.index', compact(
            'ownedCount', 'wishlistCount', 'duplicateCount',
            'ownedPercentage', 'wishlistPercentage', 'duplicatePercentage'
        ));
    }

    public function trackProgress()
    {
        $userId = Auth::id();

        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        $ownedCount = Owned::where('user_id', $userId)->count();
        $duplicateCount = Duplicate::where('user_id', $userId)->count();

        $total = $wishlistCount + $ownedCount + $duplicateCount;
        $progress = ($total > 0) ? ($ownedCount / $total) * 100 : 0;

        return response()->json([
            'wishlist' => $wishlistCount,
            'owned' => $ownedCount,
            'duplicate' => $duplicateCount,
            'progress' => round($progress, 2),
            'ownedPercentage' => round(($total > 0) ? ($ownedCount / $total) * 100 : 0, 2),
            'wishlistPercentage' => round(($total > 0) ? ($wishlistCount / $total) * 100 : 0, 2),
            'duplicatePercentage' => round(($total > 0) ? ($duplicateCount / $total) * 100 : 0, 2),
        ]);
    }
}
