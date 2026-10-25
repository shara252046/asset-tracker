<?php

namespace App\Http\Controllers;

use App\Models\Asset;          // <-- ei line add korte hobe
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::latest()->get();          // <-- add
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');               // <-- add
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'nullable',
            'serial_number' => 'required|unique:assets',
            'location' => 'required',
            'purchase_date' => 'required|date',
            'purchase_price' => 'nullable|numeric',
            'warranty_end_date' => 'nullable|date',
            'service_interval_days' => 'required|integer',
        ]);

        $data['next_service_due'] = now()->parse($data['purchase_date'])
            ->addDays($data['service_interval_days']);

        Asset::create($data);

        return redirect()->route('assets.index');
    }

    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)              // <-- string $id er bodole Asset $asset
    {
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)   // <-- Asset $asset
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'nullable',
            'serial_number' => 'required|unique:assets,serial_number,' . $asset->id,
            'location' => 'required',
            'purchase_date' => 'required|date',
            'purchase_price' => 'nullable|numeric',
            'warranty_end_date' => 'nullable|date',
            'service_interval_days' => 'required|integer',
        ]);

        $asset->update($data);

        return redirect()->route('assets.index');
    }

    public function destroy(Asset $asset)           // <-- Asset $asset
    {
        $asset->delete();

        return redirect()->route('assets.index');
    }
}