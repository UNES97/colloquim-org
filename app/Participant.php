<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $fillable = [
        'id', 'nom','prenom','affiliation','adresse','reg_inscription'];
}
