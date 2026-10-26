<!DOCTYPE html>
<html>
<head>
    <title>Ticket #{{ $ticket->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <a href="{{ route('tickets.index') }}" class="text-blue-500 text-sm mb-4 inline-block">&larr; Back to Tickets</a>
        
        <h1 class="text-2xl font-bold mb-2">Ticket #{{ $ticket->id }} ({{ ucfirst($ticket->type) }})</h1>
        <p class="text-gray-600 mb-6">Asset: <strong>{{ $ticket->asset->name }}</strong> ({{ $ticket->asset->serial_number }})</p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <!-- Issue Details -->
        @if($ticket->issue)
        <div class="bg-gray-50 p-4 rounded mb-6 border">
            <h3 class="font-bold text-lg mb-2">Reported Issue:</h3>
            <p>{{ $ticket->issue->description }}</p>
            <p class="text-sm text-gray-500 mt-2">Urgency: <span class="uppercase font-bold">{{ $ticket->issue->urgency }}</span></p>
            @if($ticket->issue->photo_path)
                <img src="{{ asset('storage/' . $ticket->issue->photo_path) }}" class="mt-4 max-h-48 rounded border">
            @endif
        </div>
        @endif

        <!-- Assign Technician (Only if not assigned yet) -->
        @if(!$ticket->technician_id && $ticket->status !== 'resolved')
        <div class="border p-4 rounded mb-6">
            <h3 class="font-bold text-lg mb-2">Assign Technician</h3>
            <form method="POST" action="{{ route('tickets.assign', $ticket) }}">
                @csrf
                <select name="technician_id" class="border p-2 rounded w-full mb-2" required>
                    <option value="">Select Technician...</option>
                    @foreach($technicians as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->name }} ({{ $tech->email }})</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Assign</button>
            </form>
        </div>
        @endif

        <!-- Resolve Ticket (Only if assigned and not resolved) -->
        @if($ticket->technician_id && $ticket->status !== 'resolved')
        <div class="border p-4 rounded mb-6 bg-blue-50">
            <h3 class="font-bold text-lg mb-2">Resolve Ticket</h3>
            <p class="text-sm mb-4">Assigned to: <strong>{{ $ticket->technician->name }}</strong></p>
            <form method="POST" action="{{ route('tickets.resolve', $ticket) }}">
                @csrf
                <textarea name="resolution_note" placeholder="What was fixed?" class="border p-2 rounded w-full mb-2" required></textarea>
                <input type="number" name="cost" placeholder="Total Cost (BDT)" step="0.01" class="border p-2 rounded w-full mb-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Mark as Resolved</button>
            </form>
        </div>
        @endif

        <!-- Resolved Details -->
        @if($ticket->status === 'resolved')
        <div class="bg-green-50 p-4 rounded border border-green-200">
            <h3 class="font-bold text-lg text-green-800 mb-2">Resolved</h3>
            <p><strong>Note:</strong> {{ $ticket->resolution_note }}</p>
            <p><strong>Cost:</strong> {{ $ticket->cost }} BDT</p>
            <p class="text-sm text-gray-500 mt-2">Resolved at: {{ \Carbon\Carbon::parse($ticket->resolved_at)->format('d M, Y h:i A') }}</p>
        </div>
        @endif
    </div>
</body>
</html>