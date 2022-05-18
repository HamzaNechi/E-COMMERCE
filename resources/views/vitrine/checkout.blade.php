@extends('layouts.app_page_vitrine')
@section('content')
    <!-- Begin Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container-fluid h-100">
            <div class="breadcrumb-content h-100">
                <h2 class="breadcrumb-title">FINALISATION DE LA COMMANDE</h2>
                <ul>
                    <li><a href="{{ url('/Panier')}}">Panier</a></li>
                    <li class="active">Finalisation de la commande</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Checkout Area Start Here -->
    <div class="checkout-area">
        <div class="container-fluid">
            @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{!! session('flash_message_success') !!}</strong>
                      
                    </div>
                    @endif
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{!! session('flash_message_error') !!}</strong>
                      
                    </div>
                    @endif
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <h3>Avez-vous un coupon? <span id="showcoupon">Cliquez ici pour saisir votre code</span></h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form method="post" action="{{ url('/Appliquer_code')}}">
                                    {{ csrf_field()}}
                                    <p class="checkout-coupon">
                                        <input placeholder="Code promo" type="text" name="code_promo">
                                        <input class="coupon-inner_btn" value="Appliquer" type="submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form method="post" id="FormCommande" action="{{ url('/Ajouter_Commande')}}">
                        {{ csrf_field()}}
                        <div class="checkbox-form">
                            <h3>Fiche De Renseignements</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select clearfix">
                                        <label>Région <span class="required">*</span></label>
                                        <select name="region" class="myniceselect nice-select wide">
                                            <option data-display="Sélectionnez votre région">Sélectionnez votre région</option>
                                                <option value="Bizerte">Bizerte</option>
                                                <option value="Tunis">Tunis</option>
                                                <option value="Ariana">Ariana</option>
                                                <option value="Manouba">Manouba</option>
                                                <option value="Ben Arous">Ben Arous</option>
                                                <option value="Zaghouan">Zaghouan</option>
                                                <option value="Nabeul">Nabeul</option>
                                                <option value="Jendouba">Jendouba</option>
                                                <option value="Béja">Béja</option>
                                                <option value="Le Kef">Le Kef</option>
                                                <option value="Siliana">Siliana</option>
                                                <option value="Sousse">Sousse</option>
                                                <option value="Monastir">Monastir</option>
                                                <option value="Mahdia">Mahdia</option>
                                                <option value="Kairouan">Kairouan</option>
                                                <option value="Kasserine">Kasserine</option>
                                                <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                <option value="Sfax">Sfax</option>
                                                <option value="Gabès">Gabès</option>
                                                <option value="Médenine">Médenine</option>
                                                <option value="Tataouine">Tataouine</option>
                                                <option value="Gafsa">Gafsa</option>
                                                <option value="Tozeur">Tozeur</option>
                                                <option value="Kébili">Kébili</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Nom et prénom <span class="required">*</span></label>
                                        <input placeholder="" name="nomclient" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Téléphone <span class="required">*</span></label>
                                        <input placeholder="" name="tel" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Ville</label>
                                        <input placeholder="" type="text" name="ville">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Adresse <span class="required">*</span></label>
                                        <input placeholder="" name="adresse" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Code postal <span class="required">*</span></label>
                                        <input placeholder="" name="postal" type="text">
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                        </div>
                    
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Vos Commandes</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Produits</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_amount =0;
                                    ?>

                                    @foreach($cart as $row)
                                    <tr class="cart_item">
                                        <td class="cart-product-name"> {{ $row->prod_nom }}<strong class="product-quantity">
                                    × {{ $row->quantity }}</strong></td>
                                        <td class="cart-product-total text-center"><span class="amount">{{ $row->prix*$row->quantity }} TND</span></td>
                                    </tr>

                                    <?php 
                                        $total_amount = $total_amount + ($row->prix*$row->quantity) ;
                                    ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    
                                    <input type="hidden" name="total_prod" value="{{ $total_amount }}">
                                    @if(!empty(Session::get('CouponAmount')) AND !empty(Session::get('CouponCode')))

                                    <?php $type_promo=Session::get('TypeCoupon'); ?>

                                    <?php $promo=Session::get('CouponAmount'); ?>
                                                <?php $codepromo=Session::get('CouponCode'); ?>
                                                <input type="hidden" name="codepromo" value="{{ $codepromo }}">

                                                <input type="hidden" name="promo" value="{{ $promo }}">

                                                <?php $gt=$total_amount - Session::get('CouponAmount'); ?>

                                   <tr class="order-total">
                                        <th>Total</th>
                                        <td class="text-center"><strong><span class="amount">{{ $total_amount }} TND</span></strong></td>
                                        
                                    </tr>

                                    <tr class="order-total">
                                        <th>Remise</th>
                                        <td class="text-center"><strong><span class="amount"><?php echo $promo; ?> TND</span></strong></td>
                                    </tr>

                                    

                                    <tr class="order-total">
                                        <th>Net à payer</th>
                                        <td class="text-center"><strong><span class="amount">{{ $gt }} TND</span></strong></td>
                                        <input type="hidden" name="net" value="{{ $gt }}">
                                    </tr>

                                    <input type="hidden" name="type_promo" value="{{ $type_promo }}">
                                    @else
                                    <tr class="order-total">
                                        <th>Net à payer</th>
                                        <td class="text-center"><strong><span class="amount">{{ $total_amount }} TND</span></strong></td>
                                        
                                    </tr>

                                    <input type="hidden" name="net" value="{{ $total_amount }}">
                                                <?php $promo=0; ?>
                                                <?php $codepromo="/"; ?>
                                                
                                    <input type="hidden" name="codepromo" value="{{ $codepromo }}">

                                    <input type="hidden" name="promo" value="{{ $promo }}">

                                    <input type="hidden" name="type_promo" value="Vide">
                                    @endif
                                    
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a href="#" class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Paiement à la livraison.
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Le paiement se fait en espèces à la livraison.
                                                                Important:<br>
                                                                - Assurez-vous de préparer le montant exact de la commande. Les livreurs ne disposent pas toujours d'espèces pour vous rendre la monnaie.<br>
                                                                - Nous acceptons uniquement le paiement en Dinar Tunisien.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="order-button-payment">
                                    <input value="Confirmer la commande" type="submit">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Area End Here -->
@endsection