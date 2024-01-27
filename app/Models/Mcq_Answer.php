<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq_Answer extends Model
{
    use HasFactory;

    protected $table = 'mcq_answers';

    protected $fillable = [
        'question_id',
        'mcq_ans_id',
        'description',
        'reference'
    ];
}
