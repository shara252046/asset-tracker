<!DOCTYPE html>
<html>
<head>
    <title>Assets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Asset List</h1>
            <a href="{{ route('assets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Asset</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Category</th>
                    <th class="p-2 border">Serial</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                <tr>
                    <td class="p-2 border">{{ $asset->name }}</td>
                    <td class="p-2 border">{{ $asset->category }}</td>
                    <td class="p-2 border">{{ $asset->serial_number }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('assets.show', $asset) }}" class="text-blue-500">View & QR</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>