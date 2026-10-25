<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'asset_id', 'issue_id', 'technician_id', 'type',
        'status', 'resolution_note', 'cost', 'resolved_at'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}