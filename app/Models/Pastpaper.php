<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pastpaper extends Model
{
    use HasFactory;

    protected $table = 'pastpaper';
    protected $primaryKey = 'P_id';

    protected $fillable = [
        'name',
        'year',
        'language',
        'no_of_questions',
        'CreatorState',
        'ModeratorState',
        'CreatorID',
        'ModeratorID'
    ];

    public function pastPaperMcqQuestions() : HasMany
    {
        return $this->hasMany(Mcq_Question::class, 'pastpaper_reference', 'P_id'); 
    }

    public function pastPaperShQuestions() : HasMany
    {
        return $this->hasMany(Sh_Question::class, 'pastpaper_reference', 'P_id'); 
    }

    public function paperCreator(): BelongsTo
    {
        return $this->belongsTo(User::class,'CreatorID','P_id');
    }

    public function paperModerator(): BelongsTo
    {
        return $this->belongsTo(User::class,'ModeratorID','P_id');
    }

}
