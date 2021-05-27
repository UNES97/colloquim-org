<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    //
    protected $fillable = [
        'id', 'nom','prenom','affiliation','type','tel_auteur_princip','telecopie_auteur_princip',
        'mail_auteur_princip','cv_orateur'];
}
