<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attributproduit extends Model
{
    protected $fillable = [
        'prod_id', 'sku','taille','prix_at','stock','prix_gros'
    ];
}
