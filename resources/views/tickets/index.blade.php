<!DOCTYPE html>
<html>
<head>
    <title>Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Ticket List</h1>
            <a href="{{ route('assets.index') }}" class="text-blue-500">Back to Assets</a>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Ticket ID</th>
                    <th class="p-2 border">Asset</th>
                    <th class="p-2 border">Type</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td class="p-2 border">#{{ $ticket->id }}</td>
                    <td class="p-2 border">{{ $ticket->asset->name }}</td>
                    <td class="p-2 border capitalize">{{ $ticket->type }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 rounded text-white text-sm 
                            {{ $ticket->status == 'open' ? 'bg-red-500' : ($ticket->status == 'in_progress' ? 'bg-yellow-500' : 'bg-green-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </td>
                    <td class="p-2 border">
                        <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-500 font-bold">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No tickets found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>