<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produit;
use App\categorie;

class StatController extends Controller
{
    public function statistique(){
        $produit=produit::all();
        return view('home')->with(compact('produit'));
    }
}
