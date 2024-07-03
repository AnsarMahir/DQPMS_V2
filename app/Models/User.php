<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [ ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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
    public function isAdmin()
    {
        return $this->type === 'ADMIN';
    }
    public function isCreator()
    {
        return $this->type === 'CREATOR';
    }
    public function isModerator()
    {
        return $this->type === 'MODERATOR';
    }
    public function isTutor()
    {
        return $this->type === 'TUTOR';
    }
    public function isStudent()
    {
        return $this->type === 'STUDENT';
    }
    
    
}   

