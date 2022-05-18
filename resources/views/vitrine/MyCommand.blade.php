@extends('layouts.app_page_vitrine')
@section('content')

<div class="breadcrumb-area">
        <div class="container-fluid h-100">
            <div class="breadcrumb-content h-100">
                <h2 class="breadcrumb-title">Commande</h2>
                <ul>
                    <li><a href="{{ url('/')}}">Accueil</a></li>
                    <li class="active">Commande</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Begin Account Page Area -->
    <div class="account-page-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                        
                        <li class="nav-item">
                            <a class="nav-link active" id="account-orders-tab" data-toggle="tab" href="#account-orders" role="tab" aria-controls="account-orders" aria-selected="true">Commande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-address-tab" data-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">Les achats</a>
                        </li>
                        
                        
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                        
                        <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                            <div class="myaccount-orders">
                                <h4 class="small-title">MES COMMANDES</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Désignation</th>
                                                <th>Quantité</th>
                                                <th>Prix</th>
                                                <th>Total</th>
                                                <th>Taille</th>
                                            </tr>
                                            @foreach($produits as $row)
                                            <tr>
                                                <td>
                                                    {{ $row->nom_produit }}
                                                </td>
                                                <td>
                                                    {{ $row->qty }}
                                                </td>
                                                <td>
                                                    {{ $row->price }}
                                                </td>
                                                <td>
                                                    {{ $row->qty * $row->price }}
                                                </td>
                                                
                                                <td>
                                                    @if($row->taille==0)
                                                    -
                                                    @else
                                                    {{ $row->taille }}
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                @foreach($commande as $com)
                                @if($com->etat == "En cours")
                                <hr>
                                <center>
                                    <a href="{{ url('/AnnulerCommande',$com->id) }}">
                                            <button class="mgana-btn" type="button"><span>Annuler la commande</span></button>
                                        </a>
                                </center>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                            <div class="myaccount-address">
                                
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="small-title mt-10 mb-10">ADRESSE DE LIVRAISON</h4>
                                        <address>
                                            @foreach($commande as $a)
                                            <ul>
                                                <li>{{ $a->nomclient }}</li>
                                                <li>{{ $a->tel }}</li>
                                                <li>{{ $a->region }}</li>
                                                <li>{{ $a->ville }}</li>
                                                <li>{{ $a->adresse }}</li>
                                                <li>{{ $a->postal }}</li>
                                            </ul>
                                       
                                            @endforeach
                                        </address>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="small-title mt-10">Informations commande</h4>
                                        <address>
                                            @foreach($commande as $c)
                                            <ul>
                                                <li><b>N°Commande :</b>{{ $c->id }}</li>
                                                <li><b>Date :</b>{{ $c->date }}</li>
                                                @if($c->promo > 0)
                                                    @if($c->code_promo != "" && $c->code_promo != "/")
                                                        <li><b>Code promo :</b>{{ $c->code_promo }}</li>
                                                    @endif
                                                <li><b>Remise :</b>{{ $c->promo }}</li>
                                                <li><b>Total :</b>{{ $c->total }} TND</li>
                                                <li><b>Net à payé :</b>{{ $c->net }} TND</li>
                                                @else
                                                <li><b>Total :</b>{{ $c->total }} TND</li>
                                                @endif
                                                <li><b>État de la commande</b> :{{ $c->etat }}</li>

                                            </ul>
                                            
                                        </address>
                                    </div>
                                </div>
                                @if($c->etat == "En cours")
                                <hr>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <a href="{{ url('/AnnulerCommande',$c->id) }}">
                                            <button class="mgana-btn" type="button"><span>Annuler la commande</span></button>
                                        </a>
                                    </div>
                                    
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection