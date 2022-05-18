@extends('layouts.app_page_vitrine')
@section('content')
    <!-- Begin Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container-fluid h-100">
            <div class="breadcrumb-content h-100">
                <h2 class="breadcrumb-title">Liste de souhaits</h2>
                <ul>
                    <li><a href="{{ url('/Boutique')}}">Boutique</a></li>
                    <li class="active">Liste de souhaits</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!--Begin Mgana's Wishlist Area -->
    <div class="mgana-wishlist_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="wishlist-content table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="mgana-product_remove">Supprimer</th>
                                        <th class="mgana-product-thumbnail">image</th>
                                        <th class="cart-product-name">Produit</th>
                                        <th class="mgana-product-price">Prix</th>
                                        <th class="mgana-product-stock-status">Statut</th>
                                        <th class="mgana-cart_btn">Ajouter au panier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlist as $row)
                                    <tr>
                                        <td class="mgana-product_remove"><a href="{{ url('/Wishlist/Effacer-Produit',$row->id)}}"><i class="lastudioicon-e-remove"
                                        title="Remove"></i></a></td>
                                        <td class="mgana-product-thumbnail"><a href="#">
                                            @foreach($product_cart as $img)
                                            @if($img->id == $row->prod_id)
                                            <img src='{{URL::asset("img/produit/s/$img->image")}}' alt="{{ $row->prod_nom }}">
                                            @endif
                                            @endforeach
                                        </a>
                                        </td>
                                        <td class="mgana-product-name"><a href="#">{{ $row->prod_nom}}</a></td>
                                        <td class="mgana-product-price"><span class="amount">{{ $row->prix }} TND</span></td>
                                        <td class="mgana-product-stock-status">
                                        @foreach($product_cart as $val)
                                        @if($val->id == $row->prod_id)
                                        @if($val->total_stock > 0)
                                        <span class="in-stock">Disponible</span>
                                        @else
                                        <span class="out-stock">Indisponible</span>
                                        @endif
                                        @endif
                                        @endforeach
                                        </td>
                                        <td class="mgana-cart_btn"><a href="{{url('/product',$row->prod_id) }}">J'achéte</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mgana's Wishlist Area End Here -->
@endsection