@extends('layouts.app_page_vitrine')
@section('content')
 <!-- Begin Breadcrumb Area -->
 <!-- <div class="breadcrumb-area">
            <div class="container-fluid h-100">
                <div class="breadcrumb-content h-100">
                    <h2 class="breadcrumb-title"></h2>
                    <ul>
                        <li><a href="{{ url('/')}}">Accueil</a></li>
                        <li><a href="{{ url('/Boutique')}}">Boutique</a></li>
                        <li>Détail produit</li>
                    </ul>
                </div>
            </div>
        </div> -->
        <!-- Breadcrumb Area End Here -->
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumb-area-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ url('/')}}">Accueil</a></h1>
                            </li>
                            <li>
                                <h1><a href="{{ url('/Boutique')}}">Boutique</a></h1>
                            </li>
                            <li>{{ $productD['nom'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Single Product Main Area Start -->
    <div class="single-product-main-area">
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
                <div class="col-lg-6">
                        <div class="product-details-img vertical-tab">
                            <div class="mgana-element-carousel lightgallery product-details_slider" data-slick-options='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".pd-slider-nav"
                        }'>
                                <div class="single-image">
                                    <img src='{{URL::asset("img/produit/l/$productD[image]")}}' alt="Mgana's Product">
                                    <div class="inner-stuff">
                                        <ul>
                                            <li class="gallery-item" data-src='{{URL::asset("img/produit/l/$productD[image]")}}'>
                                                <a href="#">
                                                    <i class="lastudioicon-full-screen"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                 @if(sizeof($images)>0)
                                @foreach($images as $img)
                                <div class="single-image">
                                    <img src='{{URL::asset("img/produit/l/$img->image")}}' alt="Mgana's Product">
                                    <div class="inner-stuff">
                                        <ul>
                                            <li class="gallery-item" data-src='{{URL::asset("img/produit/l/$img->image")}}'>
                                                <a href="#">
                                                    <i class="lastudioicon-full-screen"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="pd-slider-nav mgana-element-carousel arrow-style-7" data-slick-options='{
                            "slidesToShow": 3,
                            "asNavFor": ".product-details_slider",
                            "focusOnSelect": true,
                            "arrows" : true,
                            "spaceBetween": 30,
                            "vertical" : true
                            }' data-slick-responsive='[
                                    {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":1200, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":992, "settings": {"slidesToShow": 3}},
                                    {"breakpoint":575, "settings": {"slidesToShow": 3}}
                                ]'>
                                <div class="single-thumb">
                                    <img src='{{URL::asset("img/produit/l/$productD[image]")}}' alt="Mgana's Product Thumnail">
                                </div>
                                @if(sizeof($images)>0)
                                @foreach($images as $img)
                                <div class="single-thumb">
                                    <img src='{{URL::asset("img/produit/l/$img->image")}}' alt="Mgana's Product Thumnail">
                                </div>
                                @endforeach
                                @endif
                                
                            </div>
                        </div>
                    </div>
                <div class="col-lg-6">
                    <form name="addtocartForm" id="addtocartForm" action="{{url('add_cart')}}" method="post">
                                {{ csrf_field()}}
                                <input type="hidden" name="prod_id" value="{{ $productD->id }}">
                                <input type="hidden" name="prod_nom" value="{{ $productD->nom }}">
                                <input type="hidden" name="prod_code" value="{{ $productD->code }}">
                                <input type="hidden" name="prod_prix" id="price" value="{{ $productD->prix }}">
                                <input type="hidden" name="prod_couleur" value="{{ $productD->couleur }}">
                    <div class="product-summery position-relative">
                        <div class="product-head">
                            <h1 class="product-title"><?php echo $productD['nom']; ?></h1>
                            <div class="product-arrows text-right">
                            <ul>
                                <li><a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$productD['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ajouter aux favories"><i class="lastudioicon-heart-2"></i></a>
                                </li>
                                
                            </ul>
                            </div>
                        </div>
                        <div class="price-box">
                            <span class="regular-price" id="prix"><?php echo $productD['prix']; ?> TND</span>
                            <div class="rating-meta">
                                <div class="rating-box">
                                    <ul>
                                        <li><i class="lastudioicon-star-rate-1"></i></li>
                                        <li><i class="lastudioicon-star-rate-1"></i></li>
                                        <li><i class="lastudioicon-star-rate-1"></i></li>
                                        <li><i class="lastudioicon-star-rate-1"></i></li>
                                        <li><i class="lastudioicon-star-rate-1"></i></li>
                                    </ul>
                                </div>
                                <ul class="meta d-flex">
                                    <li>
                                        <a href="#"><i class="fa fa-commenting-o"></i>(<?php if($avis != NULL){ echo sizeof($avis); }else{ echo "0"; } ?>)</a>
                                    </li>
                                </ul>
                                / @if($total_stock>0) <span class="in-stock"><i class="lastudioicon-check"></i>{{ $total_stock }} In Stock </span>@else <span class="in-stock">Out of stock</span> @endif
                            </div>
                        </div>
                        <div class="product-description" style="height:130px;overflow: hidden;text-overflow: ellipsis;">
                            <p><?php echo $productD['description']; ?></p>
                        </div>
                        @if(sizeof($productD->attributes)!=0)
                        <div class="product-variant">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Taille</th>
                                            <td>
                                                <select class="myniceselect nice-select wide" id="selSize" name="taille">
                                                    @foreach($productD->attributes as $sizes)
                                            <option value="{{$productD->id}}-{{ $sizes->taille }}">{{ $sizes->taille }}</option>
                                            @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                        </div>
                        @endif
                        <!---table pack si il existe-->
                        @if($pack != NULL)
                        <div class="cart-content table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th class="mgana-product-thumbnail" colspan="4">CE PACK CONTIENT</th>
                                        <th class="cart-product-name"></th>
                                        <th class="mgana-product-stock-status"></th>
                                        <th class="mgana-product-stock-status"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pack as $ligne)
                                    <tr>
                                        
                                        <td class="mgana-product-thumbnail"><a href="#"><img src='{{URL::asset("img/produit/l/$ligne->photo")}}' style="width: 35px;height: auto;"></a>
                                        </td>
                                        <td class="mgana-product-name"><a href="#">{{ $ligne->nom_produit }}</a></td>
                                        <td class="mgana-product-stock-status">
                                            @if($ligne->prod_taille == 0)
                                                -
                                            @else
                                                {{ $ligne->prod_taille }}
                                            @endif
                                        </td>
                                        
                                        <td class="mgana-product-stock-status">
                                            x {{ $ligne->qty }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><br><br>
                        @endif
                        <!--fin table pack-->
                        
                        <div class="quantity-with_btn">
                            <div class="quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="1" type="text" name="qty">
                                    <div class="dec qtybutton"><i class="lastudioicon-i-delete-2"></i></div>
                                    <div class="inc qtybutton"><i class="lastudioicon-i-add-2"></i></div>
                                </div>
                            </div>
                            <div class="add-to_cart">
                                @if($total_stock>0)
                                <a class="border-button border-color-2" href="javascript:{}" onclick="document.getElementById('addtocartForm').submit(); return false;">Ajouter au panier</a>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="add-actions">
                            <ul>
                                <li><a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$productD['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add To Wishlist"><i class="lastudioicon-heart-2"></i></a>
                                </li>
                                
                            </ul>
                        </div> -->
                        <div class="sku">
                            <span>SKU: <?php echo $productD['code']; ?></span>
                        </div>
                        <ul class="categories">
                        @if($categorie != NULL)
                            <li>Categories: </li>
                            <li>
                                <a href="{{ url('/Boutique_filtrer',$categorie->id)}}">{{ $categorie->nom }}</a>
                            </li>
                        @else
                            <li>Categories: </li>
                            <li>
                                <a href="#1">Pack</a>
                            </li>
                        @endif   
                        </ul>
                        
                        <div class="social-link with-radius-2">
                            <ul>
                                <li class="facebook">
                                    <a href="https://www.facebook.com/vioretunisie" data-toggle="tooltip" target="_blank" title="" data-original-title="Facebook">
                                        <i class="lastudioicon-b-facebook"></i>
                                    </a>
                                </li>
                                
                                <li class="instagram">
                                    <a href="https://www.instagram.com/vioretunisie/?hl=fr" data-toggle="tooltip" target="_blank" title="" data-original-title="Instagram">
                                        <i class="lastudioicon-b-instagram"></i>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product Main Area End -->
    <!-- Single Product Tab Area Start -->
    <div class="single-product-tab-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-top-tab">
                        <ul class="nav justify-content-center">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                            <li><a data-toggle="tab" href="#additional" class=""><span>INFORMATIONS COMPLÉMENTAIRES</span></a></li>
                            <li><a data-toggle="tab" href="#reviews" class=""><span>Avis (<?php echo sizeof($avis);?>)</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div id="description" class="tab-pane show active" role="tabpanel">
                            <div class="desc-body">
                                <!-- <div class="inner-img">
                                    <img class="w-100" src="{{URL::asset('vitrine/assets/images/product/brand/prod-details.jpg')}}" alt="Brand Image">
                                </div> -->
                                <div class="inner-content">
                                    <!-- <p class="short-desc mb-20">Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam egestas libero ac turpis pharetra, in vehicula lacus scelerisque. Vestibulum ut sem laoreet, feugiat tellus at, hendrerit arcu..</p> -->
                                    <p class="short-desc mb-0 pb-0"><?php echo $productD['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div id="additional" class="tab-pane" role="tabpanel">
                            <div class="additional-summery">
                                <table class="additional-summery-item">
                                    <tbody>
                                        <tr>
                                            <th>Marque</th>
                                            <td>
                                                <p>VIORE</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Catégories</th>
                                            <td>
                                                @if($categorie != NULL)
                                                <p>{{ $categorie->nom }}</p>
                                                @else
                                                <p>Pack</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Taille</th>
                                            <td>
                                                <p>@foreach($productD->attributes as $at) {{ $at->taille }} , @endforeach</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane" role="tabpanel">
                            <div class="review-body">
                                <h3 class="heading"><?php if($avis != NULL){ echo sizeof($avis); }else{ echo "0"; } ?> avis pour cette produit</h3>
                                @if($avis != NULL)
                                    
                                    @foreach($avis as $val)
                                        @if($val->status == 1)
                                        <ul class="user-info mt-30">
                                        
                                        <!-- <li class="user-avatar">
                                            <img src="{{URL::asset('vitrine/assets/images/testimonial/avatar1.png')}}" alt="User">
                                        </li> -->
                                        <li class="user-comment">
                                            <div class="rating-box">
                                                <ul>
                                                    @for($i=0 ; $i < $val->etoile ; $i++)
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    @endfor

                                                    @for($i=0 ; $i < 5-$val->etoile ; $i++)
                                                    <li><i class="lastudioicon-star-rate-2"></i></li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <div class="meta">
                                                <strong>{{ $val->nom }} - </strong>
                                                <span>{{ $val->date }}</span>
                                            </div>
                                            <p class="short-desc mb-0">{{ $val->note }}.</p>
                                        </li>
                                    </ul>
                                    @endif
                                    @endforeach

                                    


                                @endif
                                <div class="user-feedback">
                                    <h3 class="heading">Ajouter un avis</h3>
                                    <p class="short-desc mb-0">Votre adresse email ne sera pas publiée.</p>
                                    <div class="rating-box" id="add_review">
                                        <span>Votre note</span>
                                        <ul id="init_review">
                                            <li id="1" data-id="1"><i class="lastudioicon-star-rate-2"></i></li>
                                            <li id="2" data-id="2"><i class="lastudioicon-star-rate-2"></i></li>
                                            <li id="3" data-id="3"><i class="lastudioicon-star-rate-2"></i></li>
                                            <li id="4" data-id="4"><i class="lastudioicon-star-rate-2"></i></li>
                                            <li id="5" data-id="5"><i class="lastudioicon-star-rate-2"></i></li>
                                        </ul>
                                    </div>
                                    <form class="feedback-form" action="{{ url('/ajoutervotreavis')}}" method="post" id="avis">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_produit" value="{{ $productD['id']}}">
                                        <div class="comment-field">
                                            <label class="label-field mb-0">Votre avis*</label>
                                            <textarea name="note" spellcheck="false" class="textarea-field"></textarea>
                                        </div>
                                        <div class="group-input">
                                            <div class="name-field">
                                                <label class="label-field mb-0">Nom*</label>
                                                <input type="text" name="nom" class="input-field input-name">
                                            </div>
                                            <div class="email-field">
                                                <label class="label-field mb-0">Email*</label>
                                                <input type="text" name="email" class="input-field input-email">
                                            </div>
                                        </div>
                                        <div class="field-checkbox">
                                            
                                            <label class="label-checkbox mb-0" for="remember_me"></label>
                                        </div>
                                        <div class="comment-btn_wrap">
                                            <a class="mgana-btn" href="javascript:{}" onclick="document.getElementById('avis').submit(); return false;">Envoyer</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product Tab Area End -->
    <!-- Product Carousel Area Start -->
    <div class="product-carousel-area mt-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-product-title">
                        <h4>PRODUITS CONNEXES</h4>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp">
                    <div class="mgana-product-tab">
                        <div class="mgana-element-carousel" data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": false,
                        "arrows": false,
                        "dots": false
                        }' data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 3
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                    ]'>
                    @foreach($productRelated as $ligne)
                            <div class="product-item">
                                <!-- Single Product Start -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img src='{{URL::asset("img/produit/m/$ligne->image")}}' alt="Product Image">
                                           
                                            <div class="product-overlay"></div>
                                        </a>
                                        <div class="add-actions">
                                                <ul>
                                                    <li>
                                                        <a href="{{url('/Produit',$ligne->id) }}" data-toggle="tooltip" data-placement="top" data-original-title="Ajouter au panier">
                                                            <i class="lastudioicon-shopping-cart-3"></i>
                                                        </a>
                                                    </li>
                                                    <li class="view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                        <a href="#exampleModalCenter" data-toggle="tooltip" data-placement="top" data-original-title="APERÇU RAPIDE" data-id="{{ $ligne->id }}" id="pop">
                                                            <i class="lastudioicon-search-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$ligne->id)}}" data-toggle="tooltip" data-placement="top" data-original-title="Favorie">
                                                            <i class="lastudioicon-heart-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#1">{{ $ligne->nom }}</a></h3>
                                            <div class="price-box">
                                                <span class="new-price">{{ $ligne->prix }} TND</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                    @endforeach      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Carousel Area End -->

     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#selSize").change(function(){
                    var idSize=$(this).val();
                    $.ajax({
                        type:'get',
                        url:'{{url("/Prix_produit")}}',
                        data:{idSize:idSize},
                        success:function(resp){
                            $("#prix").html(resp +" TND");
                            document.getElementById("price").value = resp;
                        },
                        error:function(){
                            alert("Error");
                        }
                    });
                });
            });


            $(document).ready(function(){
                $("#1").click(function(){
                    var review=$(this).data('id');
                    var input='<input type="hidden" name="etoile" value="1">';
                    var fieldHTML='<ul><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li></ul>';
                    $('#init_review').hide();
                    $('#add_review').append(fieldHTML);
                    $('#avis').append(input);
                });


                $("#2").click(function(){
                    var reviw=$(this).data('id');
                    var input='<input type="hidden" name="etoile" value="2">';
                    var fieldHTML='<ul><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li></ul>';
                    $('#init_review').hide();
                    $('#add_review').append(fieldHTML);
                    $('#avis').append(input);
                });


                $("#3").click(function(){
                    var reviw=$(this).data('id');
                    var input='<input type="hidden" name="etoile" value="3">';
                    var fieldHTML='<ul><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-2"></i></li><li><i class="lastudioicon-star-rate-2"></i></li></ul>';
                    $('#init_review').hide();
                    $('#add_review').append(fieldHTML);
                    $('#avis').append(input);
                });

                $("#4").click(function(){
                    var reviw=$(this).data('id');
                    var input='<input type="hidden" name="etoile" value="4">';
                    var fieldHTML='<ul><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-2"></i></li></ul>';
                    $('#init_review').hide();
                    $('#add_review').append(fieldHTML);
                    $('#avis').append(input);
                });

                $("#5").click(function(){
                    var reviw=$(this).data('id');
                    var input='<input type="hidden" name="etoile" value="5">';
                    var fieldHTML='<ul><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li><li><i class="lastudioicon-star-rate-1"></i></li></ul>';
                    $('#init_review').hide();
                    $('#add_review').append(fieldHTML);
                    $('#avis').append(input);
                });
            });
        </script>
@endsection
    

    

   