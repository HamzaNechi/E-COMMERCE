<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pack_produit extends Model
{
    protected $fillable = [
        'id_pack', 'nom_produit','code_produit','qty','prix','couleur','session_id','prod_taille','prod_id','photo'
    ];
}
