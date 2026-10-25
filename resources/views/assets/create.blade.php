<!DOCTYPE html>
<html>
<head>
    <title>Add Asset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Add New Asset</h1>
        <form method="POST" action="{{ route('assets.store') }}">
            @csrf
            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Category (AC, computer, printer, vehicle)</label>
                <input type="text" name="category" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Serial Number</label>
                <input type="text" name="serial_number" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Location</label>
                <input type="text" name="location" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Purchase Date</label>
                <input type="date" name="purchase_date" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label>Service Interval (Days)</label>
                <input type="number" name="service_interval_days" value="90" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Asset</button>
        </form>
    </div>
</body>
</html>