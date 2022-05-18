<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    protected $fillable = [
        'cat_id', 'nom','code','couleur','description','prix','image','total_stock','type','prix_gros'
    ];

    public function attributes(){
    	return $this->hasMany('App\attributproduit','prod_id');
    }
}
