<header class="main-header-area header-3">
        <!-- Main Header Area Start -->
        <div class="header-middle-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="social-link">
                            <ul>
                                <li class="facebook">
                                    <a href="https://www.facebook.com/vioretunisie" data-toggle="tooltip" target="_blank" data-original-title="Facebook">
                                        <i class="lastudioicon-b-facebook"></i>
                                    </a>
                                </li>
                                
                                <li class="instagram">
                                    <a href="https://www.instagram.com/vioretunisie/?hl=fr" data-toggle="tooltip" target="_blank" data-original-title="Instagram">
                                        <i class="lastudioicon-b-instagram"></i>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="header-logo justify-content-sm-start justify-content-xl-center justify-content-lg-center">
                            <a href="{{ url('/')}}">
                                <img class="img-full" src="{{URL::asset('vitrine/assets/images/logo/viore.png')}}"  alt="Header Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="header-right-area">
                            <ul>
                                <!-- <li>
                                    <a href="" class="search-btn toolbar-btn">
                                    <i class="lastudioicon-heart-2"></i>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="#searchBar" class="search-btn toolbar-btn">
                                        <i class="lastudioicon-zoom-1"></i>
                                    </a>
                                </li>
                                
                                
                                <li class="minicart-wrap">
                                    <a href="#miniCart" class="minicart-btn toolbar-btn">
                                        <div class="minicart-count_area">
                                            <i class="lastudioicon-shopping-cart-2"></i>
                                            <span class="cart-item_count"><?php echo sizeof($cart_icon); ?></span>
                                        </div>
                                    </a>
                                </li>
                                <li class="mobile-menu_wrap d-inline-block d-xl-none">
                                    <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn">
                                        <i class="lastudioicon-menu-4-1"></i>
                                    </a>
                                </li>
                                <li class="menu-wrap">
                                    <a href="#offcanvasMenu" class="menu-btn toolbar-btn d-none d-xl-block">
                                        <div class="minicart-count_area">
                                            <i class="lastudioicon-menu-4-1"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header main-header-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-lg-12 position-static d-none d-lg-block">
                                <nav class="main-nav d-flex justify-content-center">
                                    <ul class="nav">
                                        <li>
                                            <a class="" href="{{ url('/')}}">
                                                <span class="menu-text"> Accueil</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#propos">
                                                <span class="menu-text">À Propos</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/Boutique')}}">
                                                <span class="menu-text"> Boutique</span>
                                                
                                            </a>
                                        </li>

                                        <li>
                            <a href="{{ url('/articles')}}">
                            <span class="menu-text"> Magazine</span>
                                                
                            </a>
                        </li>
                                        <li>
                                            <a href="#footer">
                                                <span class="menu-text"> Contact</span>
                                                
                                            </a>
                                        </li>
                                        
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header Area End -->
        <!-- Sticky Header Start Here-->
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-sm-6">
                                <div class="header-logo">
                                    <a href="{{ url('/')}}">
                                        <img class="img-full" src="{{URL::asset('vitrine/assets/images/logo/viore.png')}}" alt="Header Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 position-static d-none d-xl-block">
                                <nav class="main-nav d-flex justify-content-center">
                                    <ul class="nav">
                                        <li>
                                            <a class="" href="{{ url('/')}}">
                                                <span class="menu-text"> Accueil</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#propos">
                                                <span class="menu-text">À Propos</span>
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/Boutique')}}">
                                                <span class="menu-text"> Boutique</span>
                                                
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('/articles')}}">
                                                <span class="menu-text"> Magazine</span>
                                                
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#footer">
                                                <span class="menu-text"> Contact</span>
                                                
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-xl-2 col-sm-6">
                                <div class="header-right-area">
                                    <ul>
                                        <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn">
                                                <i class="lastudioicon-zoom-1"></i>
                                            </a>
                                        </li>
                                        <li class="minicart-wrap">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn">
                                                <div class="minicart-count_area">
                                                    <i class="lastudioicon-shopping-cart-2"></i>
                                                    <span class="cart-item_count"><?php echo sizeof($cart_icon); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="mobile-menu_wrap d-inline-block d-xl-none">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn">
                                                <i class="lastudioicon-menu-4-1"></i>
                                            </a>
                                        </li>
                                        <li class="menu-wrap">
                                            <a href="#offcanvasMenu" class="menu-btn toolbar-btn d-none d-xl-block">
                                                <div class="minicart-count_area">
                                                    <i class="lastudioicon-menu-4-1"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sticky Header End Here -->
        <!-- Off-Canvas Search Start -->
        <div class="offcanvas-search_wrapper" id="searchBar">
            <div class="offcanvas-menu-inner">
                <div class="container h-100">
                    <a href="#" class="btn-close"><i class="lastudioicon-e-remove"></i></a>
                    <!-- Begin Offcanvas Search Area -->
                    <div class="offcanvas-search">
                        <span class="searchbox-info">Commencez à taper et appuyez sur Entrée pour rechercher</span>
                        <form method="get" action="{{ url('/Boutique')}}" class="hm-searchbox">
                            <input type="text" name="produit" placeholder="Rechercher">
                            <button class="search_btn" type="submit"><i class="lastudioicon-zoom-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offcanvas Search Area End Here -->
        <!-- Offcanvas Minicar Start -->
        <div class="offcanvas-minicart_wrapper" id="miniCart">
            <div class="offcanvas-menu-inner">
                <a href="#" class="btn-close"><i class="lastudioicon-e-remove"></i></a>
                <div class="minicart-content">
                    <div class="minicart-heading">
                        <h4>Panier</h4>
                    </div>
                    <ul class="minicart-list">
                        @foreach($cart_icon as $cart)
                        <li class="minicart-product">
                            <a class="product-item_remove" href="{{ url('/Panier/Effacer-Produit/'.$cart->id)}}"><i class="lastudioicon-e-remove"></i></a>
                            <div class="product-item_img">
                                @foreach($product_cart as $prod)
                                @if($prod->id == $cart->prod_id)
                                <img class="img-full" src='{{URL::asset("img/produit/s/$prod->image")}}' alt="Mgana Product Image">
                                @endif
                                @endforeach
                            </div>
                            <div class="product-item_content">
                                <a class="product-item_title" href="shop-fullwidth.html"><?php echo $cart['prod_nom']; ?></a>
                                <span class="product-item_quantity"><?php echo $cart['quantity']; ?> x <?php echo $cart['prix']; ?> TND</span>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <?php
                    $total_prix=0;
                    foreach ($cart_icon as $key) {
                        $total_prix=$total_prix + ($key->prix*$key->quantity);
                    }
                ?>
                <div class="minicart-item_total">
                    <span>Total</span>
                    <span class="ammount"><?php echo $total_prix ; ?> TND</span>
                </div>
                <div class="minicart-btn_area">
                    <a href="{{ url('/Panier')}}" class="mgana-btn btn_fullwidth">Voir le panier</a>
                </div>
                @if($total_prix > 0)
                <div class="minicart-btn_area">
                    <a href="{{ url('/Commande')}}" class="mgana-btn btn_fullwidth">Commander</a>
                </div>
                @endif
            </div>
        </div>
        <!-- Offcanvas Minicart End -->
        <!-- Offcanvas Menu Start -->
        <div class="offcanvas-menu_wrapper" id="offcanvasMenu">
            <div class="offcanvas-menu-inner">
                <a href="#" class="btn-close"><i class="lastudioicon-e-remove"></i></a>
                <div class="offcanvas-inner_nav">
                    <ul>
                        <li>
                            <a href="#propos">À Propos</a>
                        </li>
                        <li>
                            <a href="#">Help Center</a>
                        </li>
                        <li>
                            <a href="{{ url('/Boutique')}}">Boutique</a>
                        </li>
                        <li>
                            <a href="{{ url('/articles') }}">Articles</a>
                        </li>
                        <li>
                            @if (Auth::guest())
                            
                            <a href="{{ url('login')}}">Connexion <i class="lastudioicon-a-check"></i></a>
                            @else
                            <a href="{{ url('home')}}">Espace admin. <i class="lastudioicon-a-check"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-inner_banner">
                    <div class="inner-img">
                        <a href="#">
                            <img class="img-full" src="vitrine/assets/images/menu/offcanvas/1.png" alt="Offcanvas Inner Banner">
                        </a>
                    </div>
                </div>
                <div class="offcanvas-inner_info">
                    <span>(+216) 50 784 900</span>
                    <span>contact@viore.tn</span>
                    <span>Hammamet , Avenue abu dhabi 8050</span>
                    <div class="social-link">
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
                    
                    <div class="copyright">
                        <span>© 2021
                    <a href="#1">VIORE.</a>
                    <a href="#1" target="_blank">TOUS DROITS RÉSERVÉS.</a>
                </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offcanvas Menu End -->
        <!-- Mobile Menu Start -->
        <div class="mobile-menu_wrapper" id="mobileMenu">
            <div class="offcanvas-menu-inner">
                <a href="#" class="btn-close-2"><i class="lastudioicon-e-remove"></i></a>
                <nav class="offcanvas-navigation">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active"><a href="{{ url('/')}}"><span
                        class="mm-text">Accueil</span></a>
                            
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#propos">
                                <span class="mm-text">À Propos</span>
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ url('/Boutique')}}">
                                <span class="mm-text">Boutique</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/articles')}}">
                            <span class="menu-text"> Magazine</span>
                                                
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#footer">
                                <span class="mm-text">Contact</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
            </div>
        </div>
        <!-- Mobile Menu End -->
        <div class="global-overlay"></div>
    </header>