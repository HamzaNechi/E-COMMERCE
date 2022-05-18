<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit_facture extends Model
{
    
    protected $fillable = [
        'id_facture','id_produit','designation','prix_venteHT','qty','montant_ttc','size','session_id'
    ];
}
