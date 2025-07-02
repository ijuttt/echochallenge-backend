<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyQuest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'point',
    ];
}
