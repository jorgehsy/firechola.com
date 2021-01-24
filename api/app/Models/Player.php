<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = "players";

    protected $fillable = [
        'summoner_name', 'tier', 'roles', 'confirmed', 'riot_data'
    ];

    protected $casts = [
        'roles' => 'array',
        'riot_data' => 'array',
    ];

}
