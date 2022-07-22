<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentGas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gas_equipment_id', 'capacity', 'unit', 'quantity', 'density'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function gas_equipment()
    {
        return $this->belongsTo(GasEquipment::class);
    }
}
