<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'job',
        'socials',
        'experiences',
        'about_me',
        'skills',
        'user_id',
    ];

    protected $casts = [
        // 'socials' => 'array',
        'experiences' => 'array',
        // 'about_me' => 'array',
        'skills' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
