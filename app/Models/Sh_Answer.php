<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sh_Answer extends Model
{
    use HasFactory;

    protected $table = 'sh_answers';

    protected $fillable = [
        'question_id',
        'sh_ans_id',
        'description',
        'reference',
    ];
}
