<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
