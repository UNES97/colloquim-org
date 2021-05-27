<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posession extends Model
{
    //
    protected $fillable = [
        'id','mot','id_article','id_auteur'
    ];
}
