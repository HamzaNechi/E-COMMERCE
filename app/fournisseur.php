<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fournisseur extends Model
{
    protected $fillable = [
       'matricule','region','ville','postal','adresse','id_user','pass'
    ];
}
