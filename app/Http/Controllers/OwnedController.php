<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owned;
use App\Models\Figurine;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OwnedController extends Controller
{
    // public function index(): View
    // {
    //     $owned = Owned::where('user_id', auth()->id())->with('figurine')->get();
    //     return view('owned.index', compact('owned'));
    // }

    public function index(): View
    {
        $owned = Owned::where('user_id', auth()->id())->with('figurine')->get();

        // Group by series
        $groupedOwned = $owned->groupBy(function ($item) {
            return $item->figurine->series;
        });

        return view('owned.index', compact('groupedOwned'));
    }


    public function store(Request $request): RedirectResponse
    {
        Owned::firstOrCreate([
            'user_id' => auth()->id(),
            'figurine_id' => $request->figurine_id,
        ]);

        return redirect()->back()->with('success', 'Added to Owned Collection.');
    }

    public function destroy($figurine_id): RedirectResponse
    {
        Owned::where('user_id', auth()->id())->where('figurine_id', $figurine_id)->delete();
        return redirect()->back()->with('success', 'Removed from Owned Collection.');
    }
}
