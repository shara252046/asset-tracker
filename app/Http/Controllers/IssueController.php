<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function store(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'description' => 'required|string',
            'urgency' => 'required|in:low,medium,high',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('issues', 'public');
        }

        $issue = $asset->issues()->create($data);

        // Auto-create ticket
        Ticket::create([
            'asset_id' => $asset->id,
            'issue_id' => $issue->id,
            'type' => 'corrective',
            'status' => 'open',
        ]);

        return back()->with('success', 'Issue reported. Ticket created.');
    }
}