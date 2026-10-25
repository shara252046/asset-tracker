<!DOCTYPE html>
<html>
<head>
    <title>Asset Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
        <h1 class="text-2xl font-bold mb-2">{{ $asset->name }}</h1>
        <p class="text-gray-600 mb-4">{{ $asset->category }} | {{ $asset->serial_number }}</p>
        
        <!-- QR CODE -->
        <div class="my-6 flex justify-center">
            {!! QrCode::size(200)->generate(route('assets.show', $asset)) !!}
        </div>


        

        @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="mt-8 text-left border-t pt-4">
    <h3 class="text-xl font-bold mb-4">Report an Issue</h3>
    <form method="POST" action="{{ route('issues.store', $asset) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <textarea name="description" placeholder="Describe the problem" class="w-full border p-2 rounded" required></textarea>
        </div>
        <div class="mb-2">
            <select name="urgency" class="w-full border p-2 rounded">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div class="mb-2">
            <input type="file" name="photo" accept="image/*" class="w-full">
        </div>
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Submit Report</button>
    </form>
</div>




        
        <p class="text-sm text-gray-500 mb-4">Scan this QR to open this page</p>
        
        <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back to List</a>
    </div>
</body>
</html>