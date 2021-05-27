<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mot_cle extends Model
{
    //
    protected $fillable = [
        'id','mot','id_article'
    ];
}
