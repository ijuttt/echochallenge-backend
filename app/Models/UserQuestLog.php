<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestLog extends Model
{
    use HasFactory;

    protected $table = 'user_quest_logs';

    protected $fillable = [
        'user_id',
        'quest_name',
        'point',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
