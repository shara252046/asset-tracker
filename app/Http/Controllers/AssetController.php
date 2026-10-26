<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $assets = Asset::query()
            ->when($request->search, function ($q, $s) {
                $q->where(function ($q) use ($s) {
                    $q->where('name', 'like', "%$s%")
                      ->orWhere('serial_number', 'like', "%$s%")
                      ->orWhere('location', 'like', "%$s%");
                });
            })
            ->when($request->category, fn ($q, $c) => $q->where('category', $c))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create', ['asset' => new Asset]);
    }

    public function store(Request $request)
    {
        $asset = Asset::create($request->validate($this->rules()));

        return redirect()->route('assets.show', $asset)
            ->with('success', 'Asset added successfully.');
    }

    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $asset->update($request->validate($this->rules()));

        return redirect()->route('assets.show', $asset)
            ->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', 'Asset deleted.');
    }

    private function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'category'          => 'required|in:ac,computer,printer,vehicle',
            'brand'             => 'nullable|string|max:255',
            'serial_number'     => 'nullable|string|max:255',
            'location'          => 'nullable|string|max:255',
            'purchase_date'     => 'nullable|date',
            'purchase_price'    => 'required|numeric|min:0',
            'warranty_end_date' => 'nullable|date',
            'status'            => 'required|in:active,under_maintenance,retired',
        ];
    }
}