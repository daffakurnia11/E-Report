<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'project_id', 'block_name', 'block_weight', 'sequence', 'filename', 'build_start', 'build_ended', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function equipment_process()
    {
        return $this->hasMany(EquipmentProcess::class);
    }
}
