<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'project_code', 'plan_type', 'gas_equipment_id', 'period_interval', 'total_plan', 'persen_plan',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function gas_equipment()
    {
        return $this->belongsTo(GasEquipment::class);
    }
}
