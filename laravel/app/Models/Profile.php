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
        'skill',
        'user_id',
    ];

    protected $cats = [
        'socials' => 'array',
        'experiences' => 'array',
        'about_me' => 'array',
        'skill' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
