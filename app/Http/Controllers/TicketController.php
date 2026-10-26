<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Notun add kora

class TicketController extends Controller
{
    // 1. Shob ticket er list dekhabe
    public function index()
    {
        // Jodi user technician hoy, take shudhu tar assigned ticket gulo dekhabe
        if (Auth::user()->role === 'technician') {
            $tickets = Ticket::where('technician_id', Auth::id())->latest()->get();
        } else {
            // Admin shob ticket dekhte parbe
            $tickets = Ticket::latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    // 2. Ekta nirdisto ticket er details dekhabe
    public function show(Ticket $ticket)
    {
        // Technician shudhu tar ticket e dhukte parbe
        if (Auth::user()->role === 'technician' && $ticket->technician_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $technicians = User::where('role', 'technician')->get();
        return view('tickets.show', compact('ticket', 'technicians'));
    }

    // 3. Admin technician assign korbe
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id'
        ]);

        $ticket->update([
            'technician_id' => $request->technician_id,
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Technician assigned successfully!');
    }

    // 4. Ticket resolve kora
    public function resolve(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'resolution_note' => 'required|string',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $ticket->update([
            'status' => 'resolved',
            'resolution_note' => $data['resolution_note'],
            'cost' => $data['cost'] ?? 0,
            'resolved_at' => now(),
        ]);

        // Jodi maintenance ticket hoy, next service date update hobe
        if ($ticket->type === 'preventive') {
            $asset = $ticket->asset;
            $asset->update([
                'next_service_due' => now()->addDays($asset->service_interval_days),
            ]);
        }

        return back()->with('success', 'Ticket resolved successfully!');
    }
}