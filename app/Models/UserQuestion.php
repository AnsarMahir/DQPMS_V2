<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    use HasFactory;
    protected $table = 'user_questions';

    protected $fillable = [
        'user_id',
        'question_id',
        'final_answer_status',
    ];
}
