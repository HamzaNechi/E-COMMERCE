<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class avis extends Model
{
    protected $fillable = [
        'note','nom','date','etoile','email','id_produit','status'
    ];
}
