<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duplicate;
use App\Models\Figurine;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DuplicateController extends Controller
{
    public function index(): View
    {
        $duplicates = Duplicate::where('user_id', auth()->id())->with('figurine')->get();

        // Group by series name
        $groupedDuplicates = $duplicates->groupBy(fn($item) => $item->figurine->series ?? 'Unknown');

        return view('duplicates.index', compact('groupedDuplicates'));
    }



    public function store(Request $request): RedirectResponse
    {
        Duplicate::create([
            'user_id' => auth()->id(),
            'figurine_id' => $request->figurine_id,
        ]);

        return redirect()->back()->with('success', 'Added to Duplicates.');
    }

    public function destroy($figurine_id): RedirectResponse
    {
        $duplicate = Duplicate::where('user_id', auth()->id())
            ->where('figurine_id', $figurine_id)
            ->first();

        if ($duplicate) {
            $duplicate->delete();
        }

        return redirect()->back()->with('success', 'Removed one from Duplicates.');
    }

}

