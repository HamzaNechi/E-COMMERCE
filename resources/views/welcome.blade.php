@extends('layouts.app_vitrine')
@section('content')
    <!--==== Pre-Loading Area End ====-->
    <!-- Header Area Start -->
    
    <!-- Header Area End -->
    <!-- Begin Slider Area One -->
    <div class="slider-area-2">
        <div class="mgana-element-carousel home-slider custom-dots-2 arrow-style-2" data-slick-options='{
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "infinite": true,
        "arrows": true,
        "dots": false,
        "autoplay" : true,
        "fade" : true,
        "autoplaySpeed" : 7000,
        "pauseOnHover" : false,
        "pauseOnFocus" : false
        }' data-slick-responsive='[
        {"breakpoint":768, "settings": {
        "slidesToShow": 1,
        "arrows": false,
        "dots": true
        }},
        {"breakpoint":575, "settings": {
        "slidesToShow": 1,
        "arrows": false,
        "dots": true
        }}
        ]'>
        


            <!-- <div class="slide-item bg-2 bg-position image-30-40 slide-left_center animation-style-01 parallax">
                <div class="inner-slide justify-content-center">
                    <div class="slide-content-2">
                        <div class="inner-content-2 text-center">
                            <h4 class="white-title-color slider-head-2 pb-10">La vie en or</h4>
                            <h1 class="white-title-color slider-head-1">VIORE</h1>
                            <div class="slide-btn d-flex justify-content-center mt-30">
                                <a class="mgana-btn mgana-btn-2 white-color specific-hover_color-3" href="{{ url('/Boutique')}}">JE DÉCOUVRE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            
            


            <!-- <div class="slide-item bg-2 bg-position image-30-31 slide-left_center animation-style-01 parallax">
                <div class="inner-slide justify-content-center">
                    <div class="slide-content-2">
                        <div class="inner-content-2 text-center">
                            <h4 class="white-title-color slider-head-2 pb-10">La vie en or</h4>
                            <h1 class="white-title-color slider-head-1">VIORE</h1>
                            <div class="slide-btn d-flex justify-content-center mt-30">
                                <a class="mgana-btn mgana-btn-2 white-color specific-hover_color-3" href="{{ url('/Boutique')}}">JE DÉCOUVRE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="slide-item bg-2 image-3-3 slide-left_center animation-style-01 parallax">
                <div class="inner-slide justify-content-center">
                    <div class="slider-content-2">
                        <div class="inner-content-2 text-center">
                            <h4 class="white-title-color slider-head-2 pb-10">La vie en or</h4>
                            <h1 class="white-title-color slider-head-1 pb-20">VIORE</h1>
                            <div class="slide-btn d-flex justify-content-center mt-10">
                                <a class="mgana-btn mgana-btn-2 white-color specific-hover_color-3" href="{{ url('/Boutique')}}">JE DÉCOUVRE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="slide-item bg-2 bg-position image-3-3 slide-left_center animation-style-01 parallax">
                <div class="inner-slide d-flex left-20">
                    <div class="slide-content-2">
                        <div class="inner-content-2">
                            <h4 class="white-title-color slider-head-2 pb-10">La vie en or</h4>
                            <h1 class="white-title-color slider-head-1 pb-20">VIORE</h1>
                            <div class="slide-btn d-block mt-30">
                                <a class="mgana-btn mgana-btn-2 white-color specific-hover_color-3" href="{{ url('/Boutique')}}">JE DÉCOUVRE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Slider Area End Here -->
    <!-- Banner Area Start -->
    <div class="banner-3-area overflow-hidden pt-90" id="propos">
        <div class="banner-item">
            <div class="banner-inner-item d-md-flex d-sm-block align-items-center">
                <div class="banner-img hover-style-2 wow fadeInLeft">
                    <a href="#">
                        <img src="vitrine/assets/images/banner/3-1.jpg" alt="Banner Image">
                        <div class="banner-overlay"></div>
                    </a>
                </div>
                <div class="banner-content-3 wow fadeInRight">
                    <div class="banner-inner-content">
                        <h2 class="large-title-1 text-uppercase">À PROPOS !</h2>
                        <span></span>
                        <p class="desc-one">
                        Découvrez la boutique en ligne officielle VIORE. Explorez les dernières collections de produits de luxe,Nous n'avons pas d'intermédiaires, nous pouvons donc vous proposer des produits de haute qualité au même prix que les marques grand public.Nous développons des essentiels pour vous aider à prendre soin de vous et à vous sentir bien dans votre peau. Tous nos produits sont fabriqués en Tunisie. Ils sont naturels, agréables et faciles à utiliser et surtout, efficaces : ils sont toujours conçus avec des ingrédients aux bénéfices prouvés. Rien de plus.
                        </p>
                        <div class="banner-btn d-block mt-30">
                            <a class="mgana-btn mgana-btn-2 specific-hover_color-3" href="{{ url('/Boutique') }}">JE DÉCOUVRE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area Start -->
    <!-- Banner Area End -->
    <!-- <div class="banner-3-area overflow-hidden pt-90">
        <div class="banner-item">
            <div class="banner-inner-item d-md-flex d-sm-block align-items-center">
                <div class="banner-img hover-style-2 order-sm-1 order-md-2 wow fadeInRight">
                    <a href="#">
                        <img src="vitrine/assets/images/banner/3-2.jpg" alt="Banner Image">
                        <div class="banner-overlay"></div>
                    </a>
                </div>
                <div class="banner-content-3 order-sm-2 order-md-1 wow fadeInLeft">
                    <div class="banner-inner-content">
                        <h2 class="large-title-1 text-uppercase" style="font-size:35px">Trousse VIORE : une idée cadeau au top !</h2>
                        <span></span>
                        <p class="desc-one">
                        Que ce soit pour madame, monsieur ou les enfants, la trousse VIORE peut convaincre tout un chacun. Pour madame, ce sera bien évidemment l’accessoire phare de son sac à main, dans lequel elle pourra ranger son rouge à lèvres, son parfum de poche, et on en passe. Pour monsieur, la trousse VIORE peut-être sympa lors des déplacements le week-end ou en semaine. En effet, il pourra ranger tout son kit de rasage et autres éléments qu’il lui plaira.
                        </p>
                        <div class="banner-btn d-block mt-30">
                            <a class="mgana-btn mgana-btn-2 specific-hover_color-3" href="{{ url('/Pack')}}">Commencez</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner Area End -->



    <!-- Video Banner Area Start -->
    <!-- <div class="banner-4-area background-3 mt-90 parallax">
        <div class="container-fluid h-100 wow fadeInUp">
            <div class="row align-items-center h-100">
                <div class="col-lg-12">
                    <div class="banner-wrapper-4">
                        <div class="banner-content-4 align-items-center text-center">
                            <h1 class="large-title-1 white-title-color text-uppercase">À PROPOS DE NOTRE BOUTIQUE</h1>
                            <p class="white-title-color desc-content">Sed rhoncus vel mauris quis suscipit. Proin bibendum nec lorem eu mattis. Praesent ac felis at dui vulputate eleifend vulputate cursus libero. Aenean id libero libero. Suspendisse tincidunt sodales neque, eget tincidunt magna viverra a. Curabitur mollis imperdiet ipsum, non interdum nisl varius nec</p>
                        </div>
                        <div class="popup-video d-flex justify-content-center">
                            <a href="#1">
                                <i class="lastudioicon lastudioicon-triangle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Video Banner Area End -->


    
    <!--Code promo banner-->
    <div class="banner-18-area">
            <div class="banner-img background-3 parallax">
                <div class="container-fluid-custom p-0 h-100">
                    <div class="row h-100">
                        <div class="col-lg-12">
                            <div class="banner-inner-content-4 wow fadeInRight h-100">
                                <div class="content-wrapper">
                                <h4 class="small-title-3 text-uppercase">AVEC LE CODE:</h4>
                                    <h4 class="large-title text-uppercase text-white">VIORE</h4>
                                    
                                    <h2 class="small-title-3 text-uppercase text-white">-20% SUR TOUT</h2>
                                    <div class="slide-btn mt-10">
                                        <a class="border-button-3 text-white" href="{{ url('/Boutique') }}">Acheter maintenant</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--end code promo banner-->

    <!-- New Arrival Area Start -->
    <div class="new-arrival-3 d-flex">
        <div class="banner-thumb-area hover-style background-4">
            <div class="demo-image">
                <a href="shop-fullwidth.html">
                    <img src="vitrine/assets/images/banner/3-4.jpg" alt="fashion-image" class="img-full">
                    <div class="banner-overlay"></div>
                </a>
            </div>
            <div class="demo-content text-center">
                <h4 class="small-title-2 text-uppercase white-title-color">Offre spéciale</h4>
                <h1 class="large-title-2 text-uppercase white-title-color">- 30%</h1>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/Boutique')}}" class="border-button">Achetez</a>
                </div>
            </div>
        </div>
        <div class="product-slider wow fadeInUp">
            <div class="product-section">
                <div class="section-title">
                    <h1 class="heading-4 text-uppercase">NOUVEAUTÉ</h1>
                </div>
                <div class="mgana-product-tab">
                    <div class="mgana-element-carousel custom-dots blog-slider_dots" data-slick-options='{
                    "slidesToShow": 3,
                    "slidesToScroll": 1,
                    "infinite": false,
                    "arrows": false,
                    "dots": true
                    }' data-slick-responsive='[
                    {"breakpoint": 1500, "settings": {
                    "slidesToShow": 3,
                    "dots": true
                    }},
                    {"breakpoint": 1300, "settings": {
                    "slidesToShow": 2,
                    "dots": true
                    }},
                    {"breakpoint": 992, "settings": {
                    "slidesToShow": 2,
                    "dots": true
                    }},
                    {"breakpoint": 767, "settings": {
                    "slidesToShow": 1,
                    "dots": true
                    }}
                ]'>
                        @foreach($product as $row)
                        <div class="product-item">
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{url('/Produit',$row->id) }}">
                                        <img src="img/produit/m/{{$row->image}}" alt="Product Image">
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
                                           <!-- <span class="old-price">$40.00</span>-->
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
    <!-- New Arrival Area End -->
    <!-- Newslatter area start -->
    <div class="newsletter-group newslatter-2 wow fadeInUp" id="commande">
        <div class="container-fluid h-100">
            <div class="row align-items-center h-100">
                <div class="col-12">
                    <div class="newsletter-box text-center">
                        <div class="newsletter-title">
                            <h2 class="heading-two text-uppercase white-title-color">Votre commande</h2>
                        </div>
                        <form class="mc-form ml-auto mr-auto" method="get" action="{{ url('/Client/Commande')}}">
                            <input type="text" id="mc-email" class="email-box" placeholder="Entrez votre code commande" name="code_commande" value="VIORE-">

                            <button id="mc-submit" class="newsletter-btn" type="submit">Consulter</button>
                        </form>
                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts text-centre">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
                        </div><!-- mailchimp-alerts end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newslatter area End -->
    <!-- New Arrival Area Start -->
    <div class="new-arrival-3 d-flex">
        <div class="product-slider wow fadeInUp">
            <div class="product-section">
                <div class="section-title">
                    <h1 class="heading-4 text-uppercase">NOS PACKS</h1>
                </div>
                <div class="mgana-product-tab">
                    <div class="mgana-element-carousel custom-dots blog-slider_dots" data-slick-options='{
                    "slidesToShow": 3,
                    "slidesToScroll": 1,
                    "infinite": false,
                    "arrows": false,
                    "dots": true
                    }' data-slick-responsive='[
                    {"breakpoint": 1500, "settings": {
                    "slidesToShow": 3,
                    "dots": true
                    }},
                    {"breakpoint": 1300, "settings": {
                    "slidesToShow": 2,
                    "dots": true
                    }},
                    {"breakpoint": 992, "settings": {
                    "slidesToShow": 2,
                    "dots": true
                    }},
                    {"breakpoint": 767, "settings": {
                    "slidesToShow": 1,
                    "dots": true
                    }}
                ]'>
                        @foreach($pack as $top)
                        <div class="product-item">
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{url('/Produit',$top->id) }}">
                                        <img src="img/produit/m/{{$top->image}}" alt="Product Image">
                                        <div class="product-overlay"></div>
                                    </a>
                                    <div class="add-actions">
                                        <ul>
                                            <li>
                                                <a href="{{url('/Produit',$top->id) }}" data-toggle="tooltip" data-placement="top" data-original-title="Ajouter au panier">
                                                    <i class="lastudioicon-shopping-cart-3"></i>
                                                </a>
                                            </li>
                                            <li class="view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                <a href="#exampleModalCenter" data-toggle="tooltip" data-placement="top" data-original-title="APERÇU RAPIDE" data-id="{{ $top->id }}" id="pop">
                                                            <i class="lastudioicon-search-zoom-in"></i>
                                                        </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ url('/Ajouter_à_la_liste_de_souhaits',$top->id)}}" data-toggle="tooltip" data-placement="top" data-original-title="Favorie">
                                                    <i class="lastudioicon-heart-2"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-desc_info">
                                        <h3 class="product-name"><a href="{{url('/Produit',$row->id) }}">{{ $top->nom }}</a></h3>
                                        <div class="price-box">
                                            <span class="new-price">{{ $top->prix }} TND</span>
                                           <!-- <span class="old-price">$40.00</span>-->
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
        <div class="banner-thumb-area hover-style background-4">
            <div class="demo-image">
                <a href="shop-fullwidth.html">
                    <img src="vitrine/assets/images/banner/3-5.jpg" alt="fashion-image" class="img-full">
                    <div class="banner-overlay"></div>
                </a>
            </div>
            <div class="demo-content text-center">
                <h4 class="small-title-2 text-uppercase white-title-color">Offre spéciale</h4>
                <h1 class="large-title-2 text-uppercase white-title-color">- 30%</h1>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/Boutique')}}" class="border-button">Achetez</a>
                </div>
            </div>
        </div>
    </div>
    <!-- New Arrival Area End -->
    <!-- Shipping Area Start Here -->
    <div class="shipping-area bg-smoke_color wow fadeInUp">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 shipping-wrapper">
                    <div class="shipping-item text-center">
                        <div class="shipping-img">
                            <i class="dlicon shopping_delivery"></i>
                        </div>
                        <div class="shipping-content">
                            <h3 class="shipping-title text-uppercase">LIVRAISON GRATUITE</h3>
                            <p class="desc-content">Livraison gratuite sur toute La République</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 shipping-wrapper">
                    <div class="shipping-item text-center">
                        <div class="shipping-img">
                            <i class="dlicon shopping_gift"></i>
                        </div>
                        <div class="shipping-content">
                            <h3 class="shipping-title text-uppercase">OFFRES SPÉCIALES</h3>
                            <p class="desc-content">Nous vous remboursons la différence.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 shipping-wrapper">
                    <div class="shipping-item text-center">
                        <div class="shipping-img">
                            <i class="dlicon ui-3_security"></i>
                        </div>
                        <div class="shipping-content">
                            <h3 class="shipping-title text-uppercase">Protection des commandes</h3>
                            <p class="desc-content">Bien le choisir et savoir le protéger</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 shipping-wrapper">
                    <div class="shipping-item text-center">
                        <div class="shipping-img">
                            <i class="dlicon tech-2_headset"></i>
                        </div>
                        <div class="shipping-content">
                            <h3 class="shipping-title text-uppercase">Assistance téléphonique</h3>
                            <p class="desc-content">24h/7j Assistance En Ligne</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shipping Area End Here -->
    <!-- Testimonial Area Start Here -->
    <div class="testimonial-area pt-90 wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-wrapper">
                        <div class="section-title text-center pb-25">
                            <h1 class="heading-one text-uppercase">TÉMOIGNAGE</h1>
                        </div>
                        <div class="testimonial-icon-img">
                            <div class="icon5"></div>
                        </div>
                        <div class="client-details">
                            <div class="mgana-element-carousel custom-dots" data-slick-options='{
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "arrows": false,
                            "dots": true
                            }' data-slick-responsive='[
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 1,
                            "arrows": false,
                            "dots": true
                            }},
                            {"breakpoint":575, "settings": {
                            "slidesToShow": 1,
                            "arrows": false,
                            "dots": true
                            }}
                            ]'>
                                @foreach($avis as $item)
                                <div class="testimonial-item text-center">
                                    <div class="client-info">
                                        <p class="feedback">
                                            {{ $item->note }}
                                        </p>
                                        <div class="img-area">
                                        <div class="rating-box">
                                                <ul>
                                                    
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    <li><i class="lastudioicon-star-rate-1"></i></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <h6 class="client-name text-uppercase">{{ $item->nom }} - {{ $item->date }}</h6>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area End Here -->
    <!-- Brand Logo Area Start -->
    <div class="brand-logo-area brand-logo-2 bg-smoke_color">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="mgana-element-carousel brand-slider" data-slick-options='{
                    "slidesToShow": 6,
                    "slidesToScroll": 1,
                    "infinite": true,
                    "arrows": false,
                    "dots": false
                    }' data-slick-responsive='[
                    {"breakpoint": 1200, "settings": {
                    "slidesToShow": 5
                    }},
                    {"breakpoint": 992, "settings": {
                    "slidesToShow": 5
                    }},
                    {"breakpoint": 767, "settings": {
                    "slidesToShow": 4
                    }},
                    {"breakpoint": 575, "settings": {
                    "slidesToShow": 3
                    }},
                    {"breakpoint": 480, "settings": {
                    "slidesToShow": 2
                    }}
                ]'>
                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/2.png" alt="brand logo">
                                </a>
                            </div>
                        </div>

                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/3.png" alt="brand logo">
                                </a>
                            </div>
                        </div>
                        
                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/5.png" alt="brand logo">
                                </a>
                            </div>
                        </div>

                        
                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/1.png" alt="brand logo">
                                </a>
                            </div>
                        </div>

                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/6.png" alt="brand logo">
                                </a>
                            </div>
                        </div>
                        
                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/4.png" alt="brand logo">
                                </a>
                            </div>
                        </div>
                        <div class="single-brand-item">
                            <div class="brand-item">
                                <a href="#">
                                    <img class="img-fluid" src="vitrine/assets/images/brand-logo/3.png" alt="brand logo">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Logo Area End -->
@endsection