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
        'user_id',
        'description',
    ];

    protected $cats = [
        'start_time' => 'date',
        'end_time' => 'date',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
