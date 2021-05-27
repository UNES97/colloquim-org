<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    //
    protected $fillable = [
        'id', 'nom','prenom','affiliation','adresse','tel','telecopie',
        'email'];
}
