<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameByUser extends Model
{
    protected $fillable = ['user_id', 'game_id'];
    public $timestamps = false;
}
