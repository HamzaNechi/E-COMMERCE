<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    protected $fillable = [
        'nomclient', 'tel','region','ville','adresse','postal','net','promo','total','etat','fournisseur','code_commande','type_promo'
    ];

    public function produits(){
    	return $this->hasMany('App\produit_commander','id_commande');
    }
}
