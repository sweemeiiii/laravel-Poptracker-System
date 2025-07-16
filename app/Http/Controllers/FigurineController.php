<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Figurine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Owned;
use App\Models\Wishlist;

class FigurineController extends Controller
{
    public function index(Request $request): View
    {
        $userId = Auth::id();
        $query = Figurine::where('user_id', Auth::id()); // Only fetch user's figurines
        $totalFigurines = Figurine::where('user_id', $userId)->count();
        $ownedCount = Figurine::where('user_id', $userId)->where('status', 'owned')->count();


        $figurines = Figurine::all();
        $ownedIds = Owned::where('user_id', auth()->id())->pluck('figurine_id')->toArray();
        $wishlistIds = Wishlist::where('user_id', auth()->id())->pluck('figurine_id')->toArray();
        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtering by Series,edition,rarity,condition
        if ($request->has('series') && $request->series !== 'all') {
            $query->where('series', $request->series);
        }
        if ($request->has('edition') && $request->edition !== 'all') {
            $query->where('edition', $request->edition);
        }
        if ($request->has('rarity') && $request->rarity !== 'all') {
            $query->where('rarity', $request->rarity);
        }
        if ($request->has('condition') && $request->condition !== 'all') {
            $query->where('condition', $request->condition);
        }

        // Sorting
        if ($request->has('sort')) {
            $order = $request->query('order', 'asc'); // Default to ascending if no order is specified

            if ($request->sort === 'name') {
                $query->orderBy('name', $order);
            } elseif ($request->sort === 'date_added') {
                $query->orderBy('created_at', $order);
            } elseif ($request->sort === 'rarity') {
                $query->orderByRaw("FIELD(rarity, 'Common', 'Secret', 'SuperSecret')");
            }
        } else {
            $query->orderBy('created_at', 'desc'); // Default sorting by latest added
        }

        //Get the figurines based on filters and sorting
        $figurines = $query->get();
        $figurines = $query->paginate(9);

        // // Get the total number of figurines for the authenticated user
        // $totalFigurines = Figurine::where('user_id', Auth::id())->count();

        // Get unique series,edition values for dropdown
        $series = Figurine::where('user_id', Auth::id())->select('series')->distinct()->pluck('series');
        $editions = Figurine::where('user_id', Auth::id())->select('edition')->distinct()->pluck('edition');
        $rarities = ['Common', 'Secret', 'SuperSecret'];
        $conditions = ['New', 'Used'];

        return view('figurines.index', compact('figurines', 'series', 'editions','rarities','conditions','totalFigurines', 'ownedCount', 'ownedIds', 'wishlistIds'));
    }


    public function create(): View
    {
        return view('figurines.create');
    }

public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'series' => 'required|string|max:255',
        'edition' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        'rarity' => 'required|in:common,secret,super secret',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('figurines', $imageName, 'public');
    }

    Figurine::create([
        'name' => $request->name,
        'series' => $request->series,
        'edition' => $request->edition,
        'imagePath' => $imagePath, // Ensure correct column name
        'user_id' => Auth::id(),
        'rarity' => $request->rarity,
    ]);

    return redirect()->route('figurines.index')->with('success', 'Figurine added successfully!');
}


    public function edit(Figurine $figurine): View
    {
        return view('figurines.edit', compact('figurine'));
    }

    public function update(Request $request, $id)
    {
        $figurine = Figurine::findOrFail($id);

        $figurine->series = $request->input('series');
        $figurine->edition = $request->input('edition');
        $figurine->purchaseDate = $request->input('purchaseDate');
        $figurine->condition = $request->input('condition');
        $figurine->rarity = $request->input('rarity');

        $figurine->save();

        return redirect()->route('figurines.index')->with('success', 'Figurine updated successfully.');
    }


    public function destroy(Figurine $figurine): RedirectResponse
    {
        // Ensure the figurine belongs to the authenticated user
        if ($figurine->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete associated image from storage
        if ($figurine->image) {
            Storage::disk('public')->delete($figurine->image);
        }

        $figurine->delete();
        return redirect()->route('figurines.index')->with('success', 'Figurine deleted successfully.');
    }

        public function show(Figurine $figurine): View
    {
        return view('figurines.show', compact('figurine'));
    }
    

}
