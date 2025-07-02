<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_report')->withTimestamps();
    }
}
