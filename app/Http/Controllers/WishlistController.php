<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Figurine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(Request $request): View
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('figurine')->get();

        // Group wishlist items by series
        $groupedWishlist = $wishlist->groupBy(function ($item) {
            return $item->figurine->series;
        });

        return view('wishlists.index', compact('groupedWishlist'));
    }

    public function store(Request $request): RedirectResponse
    {
        $figurineId = $request->figurine_id;

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('figurine_id', $figurineId)
                          ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'figurine_id' => $figurineId,
            ]);
        }

        return back()->with('success', 'Added to Wish List!');
    }

    public function destroy($id): RedirectResponse
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())->where('figurine_id', $id)->first();
        
        if ($wishlistItem) {
            $wishlistItem->delete();
        }

        return back()->with('success', 'Removed from Wish List!');
    }
    
}
