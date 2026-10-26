<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Asset extends Model
{
    protected $fillable = [
        'name', 'category', 'brand', 'serial_number', 'location',
        'purchase_date', 'purchase_price', 'warranty_end_date', 'status',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_end_date' => 'date',
    ];

    // Asset save hobar age unique QR token auto toiri kore
    protected static function booted()
    {
        static::creating(function ($asset) {
            $asset->qr_token = (string) Str::uuid();
        });
    }

    public function tickets()        
    { return $this->hasMany(Ticket::class); }
    public function schedule()       
    { return $this->hasOne(MaintenanceSchedule::class); }
    public function serviceRecords() 
    { return $this->hasMany(ServiceRecord::class); }

    public function totalRepairCost()
    {
        return $this->serviceRecords()->sum('cost');
    }

    public function shouldReplace(): bool
    {
        return $this->purchase_price > 0
            && $this->totalRepairCost() > $this->purchase_price * 0.5;
    }
}
?>