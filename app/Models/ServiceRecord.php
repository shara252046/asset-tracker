<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRecord extends Model
{
    protected $fillable = ['asset_id', 'ticket_id', 'technician_id', 'note', 'cost', 'service_date'];

    protected $casts = ['service_date' => 'date'];

    public function asset()      { return $this->belongsTo(Asset::class); }
    public function ticket()     { return $this->belongsTo(Ticket::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
}