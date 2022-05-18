@extends('layouts.app_page_vitrine')
@section('content')


<div class="breadcrumb-area">
        <div class="container-fluid h-120">
            <div class="breadcrumb-content h-120">
                <h2 class="breadcrumb-title">CRÉEZ VOTRE TROUSSE</h2>
                <ul>
                    <li><a href="{{url('/')}}">Acceuil</a></li>
                    <li class="active">CRÉEZ VOTRE TROUSSE</li>
                </ul>
            </div>
        </div>
    </div>
<div class="banner-3-area overflow-hidden pt-60" style="display: block;" id="blog1">
        <div class="banner-item">
            <div class="banner-inner-item d-md-flex d-sm-block align-items-center">
                <div class="banner-img wow fadeInLeft">
                   <img id="kit" src="vitrine/assets/images/banner/packclosed.jpg" alt="Banner Image">
                    <div class="banner-overlay"></div>
                    <div id="printed-name" class="centered" style="display:block;color:#cccccb;"></div><br>
                </div>
                <div class="banner-content-3 wow fadeInRight">
                    <div class="banner-inner-content">
                        <h1 class="heading-one text-uppercase">Offrez une trousse personnalisée</h1>
                        <span></span>
                        <p class="desc-one">Les trousses personnalisables sont un cadeau original . Ajoutez une phrase , nom ...</p>

                        <div class="col-12" id="name-div">
                            <div class="form-group row">
                               
                                <div class="col-sm-9">
                                    <input type="name"class="form-control form-control-lg" style="border-radius: 0px;" id="name" placeholder="Entrer votre nom">
                                </div>

                                <div class="col-sm-3">
                                    <div class="banner-btn d-block">
                                        <button id="btnName" class="mgana-btn mgana-btn-2 specific-hover_color-3" type="button">Continuer</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>



    <div class="banner-3-area overflow-hidden pt-90" style="display: none;" id="blog2">
        <div class="banner-item">
            <div class="banner-inner-item d-md-flex d-sm-block align-items-center">
                <div class="banner-img hover-style-2 order-sm-1 order-md-2 wow fadeInRight">
                    <a href="#">
                        <img src="vitrine/assets/images/banner/opened.jpg" alt="Banner Image">
                        <div class="banner-overlay"></div>
                        <div id="printed-products" class="col-4 under-centered" style="box-sizing: border-box;height:50%;width:100%;"></div>
                        <div id="zoom-image" class="centered"></div>
                    </a>
                </div>
                <div class="banner-content-3 order-sm-2 order-md-1 wow fadeInLeft">
                    <div class="banner-inner-content">
                        <h2 class="large-title-1 text-uppercase">Produits</h2>
                        <span></span>
                        <p class="desc-one">Praesent aliquet urna sapien, vestibulum maximus tellus rhoncus sed.</p>
                        <div class="col-12" id="category-div">
                            @foreach($categories as $category)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category" id="radio-{{$category->url}}" value="{{ $category->id }}">
                                <label class="form-check-label" for="radio-{{$category->url}}">{{ $category->nom }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12" id="products-div" style="display:none;">
                    
                        <div class="row" id="Gridproduct">
                            
                        </div>
                       
                    </div>
                        <form id="custom-pack-form" method="post" action="{{url('/ajouteraupanierproduitdupack')}}">
                            {{ csrf_field() }}
                    
                    
                    </form>
                    <!--test-->
                    <!-- <div class="compare-table">
                <table class="table mb-0">
                    <tbody>
                        <tr class="row">
                            
                            <td class="compare-column-productinfo col-sm-6">
                                <div class="compare-pdoduct-image">
                                    <a href="single-product.html">
                                        <img src="vitrine/assets/images/product/small-size/1.jpg" alt="mgana's Product Image">
                                    </a>
                                    
                                </div>
								<h5 class="compare-product-name"><a href="single-product.html">Printed retro dress gtzhnrjz,y,n</a>
                                </h5>
								<p>$60</p>
                            </td>
							
							<td class="compare-column-productinfo col-sm-6">
                                <div class="compare-pdoduct-image">
                                    <a href="single-product.html">
                                        <img src="vitrine/assets/images/product/small-size/1.jpg" alt="mgana's Product Image">
                                    </a>
                                    
                                </div>
								<h5 class="compare-product-name"><a href="single-product.html">Printed retro dress fdghrntyjty,ntrntenten,t,nte,</a>
                                </h5>
								<p>$60</p>
                            </td>
							
							<td class="compare-column-productinfo col-sm-6">
                                <div class="compare-pdoduct-image">
                                    <a href="single-product.html">
                                        <img src="vitrine/assets/images/product/small-size/1.jpg" alt="mgana's Product Image">
                                    </a>
                                    
                                </div>
								<h5 class="compare-product-name"><a href="single-product.html">Printed retro dress</a>
                                </h5>
								<p>$60</p>
                            </td>

                            <td class="compare-column-productinfo col-sm-6">
                                <div class="compare-pdoduct-image">
                                    <a href="single-product.html">
                                        <img src="vitrine/assets/images/product/small-size/1.jpg" alt="mgana's Product Image">
                                    </a>
                                    
                                </div>
								<h5 class="compare-product-name"><a href="single-product.html">Printed retro dress</a>
                                </h5>
								<p>$60</p>
                            </td>
                            
                            
                        </tr>
                        
                        
                        
                        
                        
                       
                        
                    </tbody>
                </table>
            </div> -->
                    <!--fin test-->
                    <div class="banner-btn d-block mt-30">
                        <a id="order" style="display:none;" href="javascript:{}"  class="mgana-btn btn_fullwidth mgana-btn-2 specific-hover_color-3" type="button">Ajouter au panier</a>
                    </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


   <!-- <div class="breadcrumb-area">
        <div class="container-fluid h-100">
            <div class="breadcrumb-content h-100">
                <h2 class="breadcrumb-title">Pack personnalisé</h2>
                <ul>
                    <li><a href="{{url('/')}}">Acceuil</a></li>
                    <li class="active">Pack personnalisé</li>
                </ul>
            </div>
        </div>
    </div>
   
    <div class="mgana-wishlist_area">
        <div class="container-fluid">
            @if (Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ session('flash_message_error') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif
            @if (Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session('flash_message_success') }}</strong>
            </div>
            @endif
            @if (Session::has('flash_message_info'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session('flash_message_info') }}</strong>
            </div>
            @endif
        </div>
        <div class="banner-3-area overflow-hidden">
            <-- <div class="banner-item"> --
            <div id="banner_inner" class="banner-inner-item d-md-flex d-sm-block align-items-center">
                <div id="banner-img" class="banner-img hover-style-2 order-sm-1 order-md-2 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="container">
                        <a>
                            <img id="kit" style="height:350;width:350px;" src="{{asset('vitrine/assets/images/closed1.jpg')}}" alt="">
                            <div class="banner-overlay"></div>
                            <div id="printed-name" class="centered" style="display:block;font-size:50px"></div><br>
                            <div id="printed-products" class="col-4 under-centered" style="box-sizing: border-box;height:50%;width:100%;"></div>
                            <div id="zoom-image" class="centered"></div>
                        </a>
                    </div>
                </div>
                <div id="banner-content" class="banner-content-3 order-sm-2 order-md-1 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="banner-inner-content">
                        <h2 class="large-title-1 text-uppercase">Votre Pack</h2>
                        <span></span>
                        <div class="col-12" id="name-div">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">
                                    <h5>Nom</h5>
                                </label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="name" placeholder="Entrer votre nom s'il vous plait">
                                </div>
                            </div>
                            <div class="banner-btn d-block mt-30">
                                <button id="add" class="mgana-btn mgana-btn-2 specific-hover_color-3" type="button">Continuer</button>
                            </div>
                        </div>
                        <div class="col-12" id="category-div" style="display:none;">
                            @foreach($categories as $category)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category" id="radio-{{$category->url}}" value="{{ $category->id }}">
                                <label class="form-check-label" for="radio-{{$category->url}}">{{ $category->nom }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12" id="products-div" style="display:none;">
                        </div>
                        <form id="custom-pack-form" method="post" action="{{url('/custom-pack-submit')}}">
                            {{ csrf_field() }}
                        </form>
                        <div class="banner-btn d-block mt-30">
                            <a id="order" style="display:none;" href="javascript:{}"  class="mgana-btn btn_fullwidth mgana-btn-2 specific-hover_color-3" type="button">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> --
        </div>
    </div>-->
@endsection