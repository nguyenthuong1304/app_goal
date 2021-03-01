<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    CONST SOCIALS = ['facebook', 'instagram','twitter', 'likedin'];

    protected $fillable = [
        'job',
        'socials',
        'experiences',
        'about_me',
        'skills',
        'educations',
        'achievements',
        'phone',
        'user_id',
    ];

    protected $casts = [
        'socials' => 'array',
        'experiences' => 'array',
        'skills' => 'array',
        'educations' => 'array',
        'achievements' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
