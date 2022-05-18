<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devis extends Model
{
    protected $fillable = [
        'client', 'tel','region','ville','adresse','postal','net','total_ht','date','tva','timbre','total_ttc','id_commande','fournisseur_id'
    ];
}
