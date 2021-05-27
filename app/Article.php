<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'id', 'titre','id_session','heure','nbr_pages'];
}
