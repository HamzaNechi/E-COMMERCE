@extends('layouts.app_page_vitrine')
@section('content')

    <!-- Shop Wrapper Start Here -->
    
        <!-- Header Area Start -->
        
        <!-- Header Area End -->
        <!-- Begin Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container-fluid h-100">
                <div class="breadcrumb-content h-100">
                    <h2 class="breadcrumb-title">NOTRE BOUTIQUE EN LIGNE</h2>
                    <ul>
                        <li><a href="{{ url('/')}}">Accueil</a></li>
                        <li class="active">Boutique</li>
                    </ul>
                </div>
            </div>
        </div>
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
        <!-- Breadcrumb Area End Here -->
        <!-- Shop Fullwidth Area Start Here -->
        <main class="shop-main_content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="sidebar-area mr-lg-4 pb-85">
                            <div class="widgets-area">
                                <div class="search-box text-center">
                                    <form class="mc-form ml-auto mr-auto" method="get" action="{{ url('/Boutique')}}">
                                        <input type="Text" class="text-box" placeholder="Rechercher un produit" name="produit">
                                        <button class="search-btn" type="submit"><i class="lastudioicon-zoom-1"></i></button>
                                    </form>
                                </div>
                            </div>
            <div class="widgets-area pt-60">
                <h2 class="heading"><span>Catégories</span></h2>
                    <div class="offcanvas-menu_wrapper">
                        <div class="offcanvas-menu-inner-2">
                            <div class="offcanvas-inner_nav">
                                <ul>
                                    @foreach($cat as $k)

                                    <?php
                                        $t=0;
                                    ?>

                                    @foreach($categorie as $c)
                                    @if($c->parent_id == $k->id)
                                        $t=$t+1;
                                    @endif
                                    @endforeach


                                    @if($t > 0)
                                        <li class="has-sub"><a href=""><?php echo $k['nom']; ?><i class="lastudioicon-down-arrow"></i></a>
                                        <ul>
                                        @foreach($categorie as $c)
                                        @if($c->parent_id == $k->id)
                                        <li><a href="{{ url('/Boutique_filtrer',$c->id)}}">{{ $c->nom }}</a></li>
                                        @endif
                                        @endforeach
                                        </ul>
                                        </li>
                                        
                                    @else
                                        <li><a href="{{ url('/Boutique_filtrer',$k->id)}}"><?php echo $k['nom']; ?></a>
                                    @endif
                                    @endforeach

                                    <li><a href="{{ url('/packpageboutique')}}">Pack</a>
                                    </ul>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-toolbar">
                            <div class="product-page_count">
                                <p>On a <?php echo count($product) ?> produits.</p>
                            </div>
                            <div class="product-selection_wrap">
                                <div class="product-selection_menu">
                                    <nav class="product-selection_nav">
                                        <ul>
                                            <li class="dropdown-holder">
                                                <a href="#">Vue<i class="lastudioicon-down-arrow"></i></a>
                                                <ul class="ps-dropdown product-view-mode">
                                                    <li><a class="grid-5" data-target="gridview-5" href="#">5 colonnes</a></li>
                                                    <li><a class="grid-4 active" data-target="gridview-4" href="#">4 colonnes</a></li>
                                                    <li><a class="grid-3" data-target="gridview-3" href="#">3 colonnes</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-holder">
                                                <a href="#">Trier par<i class="lastudioicon-down-arrow"></i></a>
                                                <ul class="ps-dropdown sort-wrap">
                                                    <li><a href="{{ url('/TrierPar/prix_desc') }}">Prix (Descendant)</a></li>
                                                    <li><a href="{{ url('/TrierPar/prix_asc') }}">Prix (Ascendant)</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="product-view-mode">
                                    <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top">
                                        <i class="lastudioicon-microsoft"></i>
                                    </a>

                                    <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top">
                                        <i class="lastudioicon-list-bullet-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid gridview-3 row">
                            @foreach($product as $row)
                            <div class="col-12">
                                
                                <div class="product-item">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{url('/Produit',$row->id) }}">
                                                <img src='{{URL::asset("img/produit/m/$row->image")}}' alt="Product Image">
                                                <div class="product-overlay"></div>
                                            </a>
                                            <div class="add-actions">
                                                <ul>
                                                    <li>
                                                        <a href="{{url('/Produit',$row->id) }}" data-toggle="tooltip" data-placement="top" data-original-title="Ajouter au panier">
                                                            <i class="lastudioicon-shopping-cart-3"></i>
                                                        </a>
                                                    </li>
                                                    <li class="view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <a href="#exampleModalCenter" data-toggle="tooltip" data-placement="top" data-original-title="APERÇU RAPIDE" data-id="{{ $row->id }}" id="pop">
                                                            <i class="lastudioicon-search-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$row->id)}}" data-toggle="tooltip" data-placement="top" data-original-title="Favorie">
                                                            <i class="lastudioicon-heart-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name"><a href="{{url('/Produit',$row->id) }}">{{ $row->nom }}</a></h3>
                                                <div class="price-box">
                                                    <span class="new-price">{{ $row->prix }} TND</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <div class="list-product_item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{url('/Produit',$row->id) }}">
                                                <img src="img/produit/m/{{ $row->image}}" alt="Product Image">
                                                <div class="product-overlay"></div>
                                            </a>
                                            <div class="add-actions">
                                                <ul>
                                                    <li class="view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <a href="#exampleModalCenter" data-toggle="tooltip" data-placement="top" data-original-title="APERÇU RAPIDE" data-id="{{ $row->id }}" id="pop">
                                                            <i class="lastudioicon-search-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-desc_info">
                                                <h3 class="product-name mb-0"><a href="{{url('/Produit',$row->id) }}">{{ $row->nom }}</a></h3>
                                                <div class="price-box">
                                                    <span class="new-price">{{ $row->prix }} TND</span>
                                                </div>
                                                <p class="short-desc mb-0"><?php echo $row->description; ?></p>
                                            </div>
                                            <div class="add-actions-2">
                                                <ul>
                                                    <li class="add-to-cart"><a href="{{url('/Produit',$row->id) }}">Ajouter au panier</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$row->id)}}" data-toggle="tooltip" data-placement="top" title="Favorie">
                                                            <i class="lastudioicon-heart-2"></i></a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="paginatoin-area position-center">
                                    {{$product->links('vendor\pagination\front-pagination')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Shop Fullwidth Area End Here -->
      

    <!-- Shop Wrapper End Here -->
@endsection