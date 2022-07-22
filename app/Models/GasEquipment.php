<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasEquipment extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function equipment_gas()
    {
        return $this->hasMany(EquipmentGas::class);
    }

    public function project_plan()
    {
        return $this->hasMany(ProjectPlan::class);
    }
}
