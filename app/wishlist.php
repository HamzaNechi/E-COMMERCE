<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    protected $fillable = [
        'prod_id', 'prod_nom','prod_code','prod_couleur','prix','session_id'
    ];
}
