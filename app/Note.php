<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = [
        'id','note','id_article','id_expert'
    ];
}
