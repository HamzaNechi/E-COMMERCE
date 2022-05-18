<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = [
        'prod_id', 'prod_nom','prod_code','prod_couleur','taille','prix','quantity','session_id'
    ];
}
