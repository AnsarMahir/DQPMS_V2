<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorRank extends Model
{
    use HasFactory;
    
    protected $table = 'creator_ranks';

    protected $fillable = 
    [
        'creator_id',
        'rank',
        'no_of_questions'
    ];
}
