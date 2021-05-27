<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $fillable = [
        'id', 'theme','jour','heure_debut','heure_fin','cout_inscription','type_presentant',
        'id_auteur','id_expert','id_participant'];
}
