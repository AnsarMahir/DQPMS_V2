<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper_Title extends Model
{
    use HasFactory;

    protected $table = 'paper_titles';

    protected $fillable = 
    [
        'Paper_Title',
        'Question_Types'
    ];

    public function types()
    {
        return $this->belongsToMany(PaperTitleType::class,'paper_title_pivot','paper_title_id','title_types_id');
    }

}
