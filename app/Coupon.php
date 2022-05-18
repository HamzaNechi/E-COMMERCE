<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
       'coupon_code','montant','montant_type','date_expiration','statut'
    ];
}
