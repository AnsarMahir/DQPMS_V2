<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
