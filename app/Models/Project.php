<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'code', 'ship_name', 'ship_owner', 'ship_size', 'contract_start', 'contract_ended', 'status'
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function block()
    {
        return $this->hasMany(Block::class);
    }
}
