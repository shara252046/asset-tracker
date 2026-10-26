<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'asset_id', 'type', 'description', 'photo', 'urgency',
        'status', 'reporter_name', 'assigned_to',
    ];

    public function asset()         
    { return $this->belongsTo(Asset::class); }
    public function assignee()      
    { return $this->belongsTo(User::class, 'assigned_to'); }
    public function serviceRecord() 
    { return $this->hasOne(ServiceRecord::class); }
}