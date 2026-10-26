<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    protected $fillable = ['asset_id', 'interval_days', 'last_service_date', 'next_due_date'];

    protected $casts = [
        'last_service_date' => 'date',
        'next_due_date' => 'date',
    ];

    public function asset() { return $this->belongsTo(Asset::class); }
}