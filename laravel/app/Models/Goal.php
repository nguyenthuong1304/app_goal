<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'topic',
        'agenda',
        'start_time',
        'end_time',
        'priority',
        'user_id'
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
