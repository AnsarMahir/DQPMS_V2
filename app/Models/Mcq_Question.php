<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq_Question extends Model
{
    use HasFactory;

    protected $table = 'mcq_questions';

    protected $fillable = [
        'mcq_questions_id',
        'description',
        'nature',
        'referenceid',
        'correct_answer',
        'pastpaper_reference'
    ];
}
