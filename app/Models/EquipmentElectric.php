<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentElectric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'volt', 'ampere', 'watt', 'power_factor', 'quantity', 'spesification'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
