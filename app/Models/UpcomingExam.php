<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upcomingexam extends Model
{
    use HasFactory;
    protected $fillable = ['examination_name','start','closing_date'];
    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($model) {
        //     if (is_null($model->start)) {
        //         $model->start = date('Y-m-d');
        //     }
        // });
    }
}

