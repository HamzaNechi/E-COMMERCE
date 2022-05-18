<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presence extends Model
{
    protected $fillable = [
        'date','enregistrement','verifier','statut','emp_id','id_user','employeur','responsable'
    ];
}
