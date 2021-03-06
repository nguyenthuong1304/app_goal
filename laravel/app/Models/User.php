<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\CarbonImmutable as Carbon;

class User extends Authenticatable
{
    use Notifiable;

    // protected $dates = [
    //     'wake_up_time'
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'self_introduction',
        'wake_up_time',
        'birthday',
        'status',
        'provider_name',
        'provider_id',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
        'status' => 'boolean',
    ];

    protected $appends = ['age'];

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function achievement_days(): HasMany
    {
        return $this->hasMany(AchievementDay::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'likes')->withTimestamps();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }

    /**
     * @override Model@getWakeUpTimeAttribute
     */
    public function getWakeUpTimeAttribute(): Carbon
    {
        return new Carbon($this->attributes['wake_up_time']);
    }

    public function getAgeAttribute(): string
    {
        return Carbon::parse($this->birthday)->diff(\Carbon\Carbon::now())->format('%y');
    }

    /**
     * @override Model@setWakeUpTimeAttribute
     */
    public function setWakeUpTimeAttibute($value)
    {
        $this->attributes['wake_up_time'] = $value->format('H:i:s');
    }

    public function withCountAchievementDays(string $name)
    {
        $user = User::where('name', $name)
        ->withCount(['achievement_days' => function ($query) {
            $query
                ->where('date', '>=', Carbon::now()->startOfMonth()->toDateString())
                ->where('date', '<=', Carbon::now()->endOfMonth()->toDateString());
        }])
        ->first();

        return $user;
    }

    public function ranking()
    {
        $ranked_users =  User::withCount(['articles' => function ($query) {
            $query
                ->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
                ->where('created_at', '<=', Carbon::now()->endOfMonth()->toDateString());
        }])
            ->orderBy('articles_count', 'desc')
            ->limit(5)
            ->get();

        if (!$ranked_users->isEmpty()) {
            $rank = 1;
            $before = $ranked_users->first()->articles_count;
            $ranked_users = $ranked_users->transform(function ($user) use (&$rank, &$before) {
                if ($before > $user->articles_count) {
                    $rank++;
                    $before = $user->articles_count;
                }
                $user->rank = $rank;
                return $user;
            });
        }

        return $ranked_users;
    }
}

