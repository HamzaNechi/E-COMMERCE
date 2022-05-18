<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employeur extends Model
{
    protected $fillable = [
        'nom','image','tel','cin','adresse','salaire','id_user','password'
    ];
}
