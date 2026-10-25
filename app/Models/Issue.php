<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['asset_id', 'description', 'photo_path', 'urgency'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}