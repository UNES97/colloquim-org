<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preparticipation extends Model
{
    //
    protected $fillable = [
        'id','id_participant','year_participation','type_participation'
    ];
}
