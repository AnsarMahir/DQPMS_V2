<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }

    public function mcqAttempt(): BelongsToMany
    {
        return $this->belongsToMany(Mcq_Question::class,'mcq_attempt','user_id','mcq_questions_id');
    }

    public function shAttempt(): BelongsToMany
    {
        return $this->belongsToMany(Sh_Question::class,'sh_attempt','user_id','sh_questions_id');
    }

    public function pastPaperCreated():HasMany
    {
        return $this->hasMany(Pastpaper::class,'CreatorID','id');
    }

    public function pastPaperModerated():HasMany
    {
        return $this->hasMany(Pastpaper::class,'ModeratorID','id');
    }
}   

