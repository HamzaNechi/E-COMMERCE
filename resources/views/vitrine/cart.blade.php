@extends('layouts.app_page_vitrine')
@section('content')
​
    <!-- Begin Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container-fluid h-100">
            <div class="breadcrumb-content h-100">
                <h2 class="breadcrumb-title">Panier</h2>
                <ul>
                    <li><a href="{{ url('/Boutique')}}">Boutique</a></li>
                    <li class="active">Panier</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Cart Area Start Here -->
    <div class="mgana-cart_area">
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
                        <h3>Avez-vous un code promo ? <span id="showcoupon">Cliquez ici pour saisir votre code</span></h3>
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
                <div class="col-lg-8">
                    <form action="#">
                        <div class="cart-content table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="mgana-product_remove">Supprimer</th>
                                        <th class="mgana-product-thumbnail">Image</th>
                                        <th class="cart-product-name">Produit</th>
                                        <th class="mgana-product-price">Taille</th>
                                        <th class="mgana-product-price">Prix</th>
                                        <th class="mgana-product-stock-status">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount=0; ?>
                                    @foreach($cart as $row)
                                    <tr>
                                        <td class="mgana-product_remove"><a href="{{ url('/Panier/Effacer-Produit/'.$row->id)}}"><i class="lastudioicon-e-remove"
                                        title="Remove"></i></a></td>
                                        <td class="mgana-product-thumbnail"><a href="#1">
                                            @foreach($productCart as $prod)
                                            @if($prod->id == $row->prod_id)
                                            <img src='{{URL::asset("img/produit/s/$prod->image")}}' alt="">
                                            @elseif($row->prod_code =='perso')
                                            <img src='{{URL::asset("img/produit/s/174.jpg")}}' alt="">
                                            @break
                                            @endif
                                            @endforeach
                                            
                                        </a>
                                        </td>
                                        <td class="mgana-product-name"><a href="#1">{{$row->prod_nom}}</a></td>
                                        @if($row->taille == 0)
                                        <td class="mgana-product-name"><a href="#1">-</a></td>
                                        @else
                                        <td class="mgana-product-name"><a href="#1">{{$row->taille}}</a></td>
                                        @endif
                                        <td class="mgana-product-price"><span class="amount">{{ $row->prix }} TND</span></td>
                                        <td class="mgana-product-stock-status">
                                            <div class="quantity d-flex justify-content-center m-0">
                                                <!--<div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box border-0" name="qty" value="{{ $row->quantity}}" type="text" id="qty">
                                                    <div class="dec qtybutton" id="dec" >
                                                        <i class="lastudioicon-i-delete-2"></i>
                                                    </div>
                                                    <div class="inc qtybutton" id="inc"><i class="lastudioicon-i-add-2"></i>
​
                                            
                                                    </div>
                                                </div>-->
                                                <table style="align-content: center; border: transparent; width: 10px;">
                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('/Panier/Modifier-Quantite/'.$row->id.'/'.$row->quantity)}}">
                                                            <i class="lastudioicon-i-delete-2"></i></a>
                                                        </td>
                                                        <td>
                                                            <input style="border: transparent;width: 15px;" name="qty" value="{{ $row->quantity}}" type="text" id="qty"> 
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/Panier/Increment_Quantite/'.$row->id.'/'.$row->quantity)}}">
                                                            <i class="lastudioicon-i-add-2"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        $total_amount = $total_amount + ($row->prix*$row->quantity) ;
                                            ?>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="cart-collaterals">
                        <div class="cart-shipping-wrapper">
                            <div class="cart-totals">
                                <h2 class="title">Total panier</h2>
                            </div>
                            <table class="cart-sub-table">
                                <tbody>
                        @if(!empty(Session::get('CouponAmount')))
                        <tr class="cart-subtotal">
                            <th>Total</th>
                            <td class="subtotal"><span><?php echo "$total_amount  TND"; ?></span></td>
                        </tr>
						<?php $promo=Session::get('CouponAmount'); ?>
						<tr class="cart-subtotal">
                            <th>Remise</th>
                            <td class="subtotal"><span><?php echo "$promo TND"; ?></span></td>
                        </tr>
						<?php $rt=$total_amount - Session::get('CouponAmount'); ?>
                        
                        <?php $gt=$total_amount - Session::get('CouponAmount'); ?>
                        
​
                        
                        <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span><?php echo "$gt TND"?></span></strong></td>
                        </tr>
                        @else
							<tr class="cart-subtotal">
                            <th>Total</th>
                            <td class="subtotal"><span><?php echo "$total_amount  TND"; ?></span>
							</td>
                        </tr>
						
						
						<?php $rt=$total_amount; ?>
                        
                        <?php $gt=$total_amount ; ?>
                        
                        <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span><?php echo "$gt TND"?></span></strong></td>
                        </tr>
                        @endif
                                </tbody>
                        </table>
                        </div>
                        <div class="order-button-payment">
                        @if(sizeof($cart)>0)
                            <a href="{{ url('/Commande') }}" class="mgana-btn btn_fullwidth">Finaliser la commande</a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End Here -->
    
@endsection