<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit_devis extends Model
{
    protected $fillable = [
        'id_devis', 'nom_produit','qty','prix','total','taille','id_produit',
    ];
}
