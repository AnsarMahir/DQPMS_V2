<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PaperTitleType extends Model
{
    use HasFactory;

    protected $table = 'paper_title_types';

    public function paperTitles()
{
    return $this->belongsToMany(Paper_Title::class,'paper_title_pivot','title_types_id','paper_title_id');
}
}
