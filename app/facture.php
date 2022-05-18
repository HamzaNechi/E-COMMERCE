<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    protected $fillable = [
        'client', 'tel','region','ville','adresse','postal','net','promo','total_ht','date','tva','timbre','total_ttc','id_commande','code','id_fournisseur','etat','tranche','methode','rendu','type_promo'
    ];
}