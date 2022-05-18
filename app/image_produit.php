<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image_produit extends Model
{
    protected $fillable = [
        'id_produit', 'image'
    ];
}
