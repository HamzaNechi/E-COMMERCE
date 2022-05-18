<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conges extends Model
{
    protected $fillable = [
        'date','emp_nom','emp_id','de','a','note',
    ];
}
