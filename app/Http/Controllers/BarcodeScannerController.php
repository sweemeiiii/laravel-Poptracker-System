<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarcodeFigurine;
use App\Models\Figurine;

class BarcodeScannerController extends Controller
{
    public function scanPage()
    {
        return view('barcode_scanner');
    }

    public function getFigurineByBarcode($barcode)
    {
        // Trim barcode to remove any leading/trailing spaces
        $barcode = trim($barcode);

        // Check for figurine in the barcode_figurines table
        $figurine = BarcodeFigurine::where('barcode', $barcode)->first();
        
        if (!$figurine) {
            return response()->json(['error' => 'Figurine not found.'], 404);
        }

        return response()->json([
            'name' => $figurine->name,
            'series' => $figurine->series,
            'edition' => $figurine->edition,
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'barcode' => 'required|string',
        'name' => 'required|string',
        'series' => 'required|string',
        'edition' => 'required|string',
        'purchase_date' => 'required|date',
        'condition' => 'required|in:new,used',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['barcode', 'name', 'series', 'edition', 'purchase_date', 'condition']);

    if ($request->hasFile('image')) {
        $data['imagePath'] = $request->file('image')->store('figurine_images', 'public');
    }

    Figurine::create($data);  // Assuming you're saving it to Figurine model

    return redirect()->route('figurines.index')->with('success', 'Figurine added successfully!');
}



}
