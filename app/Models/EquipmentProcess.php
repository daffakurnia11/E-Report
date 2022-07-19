<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id', 'equipment_id', 'equipment_type', 'gas_usage', 'period', 'kWh'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
