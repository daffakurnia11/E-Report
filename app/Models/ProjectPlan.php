<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'project_code', 'plan_type', 'month', 'electric_plan', 'gas_plan'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
