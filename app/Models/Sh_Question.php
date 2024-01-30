<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sh_Question extends Model
{
    use HasFactory;

    protected $table = 'sh_questions';

    protected $fillable = [
        'sh_questions_id',
        'description',
        'nature',
        'referenceid',
        'correct_answer',
        'pastpaper_reference'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Sh_Answer::class,'question_id','sh_questions_id');
    }
}
