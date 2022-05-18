<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit_commander extends Model
{
    protected $fillable = [
        'id_commande', 'nom_produit','code_produit','session_id'
    ];
}
