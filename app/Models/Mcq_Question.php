<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mcq_Question extends Model
{
    use HasFactory;

    protected $table = 'mcq_questions';
    protected $primaryKey = 'mcq_questions_id';
    protected $fillable = [
        'mcq_questions_id',
        'description',
        'nature',
        'referenceid',
        'correct_answer',
        'pastpaper_reference'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Mcq_Answer::class,'question_id','mcq_questions_id');
    }

    public function reference(): HasOne
    {
        return $this->hasOne(Reference::class,'R_id','referenceid');
    }
}
