<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','category','brand','serial_number','location',
        'purchase_date','purchase_price','warranty_end_date',
        'status','service_interval_days','next_service_due'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}