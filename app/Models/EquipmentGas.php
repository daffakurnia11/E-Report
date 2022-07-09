<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentGas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gas_filter', 'flowmeter', 'capacity', 'unit', 'quantity', 'activity', 'density'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}