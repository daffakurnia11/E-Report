<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'block_id', 'type', 'equipment_gas_id', 'equipment_electric_id', 'flowmeter', 'volt', 'ampere', 'watt', 'activity', 'status', 'stopped_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function equipment_gas()
    {
        return $this->belongsTo(EquipmentGas::class);
    }

    public function equipment_electric()
    {
        return $this->belongsTo(EquipmentElectric::class);
    }
}
