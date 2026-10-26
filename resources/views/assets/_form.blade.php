@csrf

@if($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        @foreach($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <label>Name
        <input name="name" value="{{ old('name', $asset->name) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Category
        <select name="category" class="border rounded w-full px-2 py-1">
            @foreach(['ac','computer','printer','vehicle'] as $c)
                <option value="{{ $c }}" @selected(old('category', $asset->category) == $c)>{{ strtoupper($c) }}</option>
            @endforeach
        </select>
    </label>

    <label>Brand
        <input name="brand" value="{{ old('brand', $asset->brand) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Serial Number
        <input name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Location
        <input name="location" value="{{ old('location', $asset->location) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Purchase Price (Tk)
        <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price', $asset->purchase_price ?? 0) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Purchase Date
        <input type="date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date?->format('Y-m-d')) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Warranty End Date
        <input type="date" name="warranty_end_date" value="{{ old('warranty_end_date', $asset->warranty_end_date?->format('Y-m-d')) }}" class="border rounded w-full px-2 py-1">
    </label>

    <label>Status
        <select name="status" class="border rounded w-full px-2 py-1">
            @foreach(['active','under_maintenance','retired'] as $s)
                <option value="{{ $s }}" @selected(old('status', $asset->status ?? 'active') == $s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
            @endforeach
        </select>
    </label>
</div>

<button class="mt-4 bg-blue-600 text-white px-6 py-2 rounded">Save</button>