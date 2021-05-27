<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    //
    protected $fillable = [
        'id','id_participant','id_session'
    ];
}
