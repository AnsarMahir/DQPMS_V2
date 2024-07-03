<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function reference(): HasOne
    {
        return $this->hasOne(Reference::class,'R_id','reference');
    }
}
