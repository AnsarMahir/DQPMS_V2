<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastpaper extends Model
{
    use HasFactory;

    protected $table = 'pastpaper';

    protected $fillable = [
        'name',
        'year',
        'language',
        'CreatorState',
        'ModeratorState',
        'CreatorID',
        'ModeratorID'
    ];
}
