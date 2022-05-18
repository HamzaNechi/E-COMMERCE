<div class="footer-area footer-area-1 bg-footer-1" id="footer">
        <div class="footer-top-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="custom-col-1 col-12">
                        <div class="footer-widgets-area">
                            <div class="logo">
                            <a href="{{ url('/')}}">
                                        <img class="img-full" src="{{URL::asset('vitrine/assets/images/logo/viore-white.png')}}" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-2 col-12">
                        <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="footer-widgets-area xsm-space">
                                    <div class="footer-widgets">
                                        <h3 class="heading-3 text-uppercase">À propos</h3>
                                        <p class="footer-widgets-content">Tous nos produits sont fabriqués en Tunisie. Ils sont naturels, agréables et faciles à utiliser et surtout, efficaces... &nbsp &nbsp <a href="#propos">Lire la suite</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                                <div class="footer-widgets-area sm-space">
                                    <div class="footer-widgets">
                                        <h3 class="heading-3 text-uppercase">Boutique</h3>
                                        <ul>
                                            <li><a href="{{ url('/Boutique')}}">Découvrez la boutique en ligne officielle VIORE</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                                <div class="footer-widgets-area sm-space">
                                    <div class="footer-widgets">
                                        <h3 class="heading-3 text-uppercase">Articles</h3>
                                        <ul>
                                            <li><a href="{{ url('/articles')}}">Lisez nos magazines quand vous voulez ou vous voulez.</a></li>
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="footer-widgets-area">
                                    <div class="footer-widgets">
                                        <h3 class="heading-3 text-uppercase">Contact</h3>
                                        <ul>
                                            <li>
                                                <a href="#1">
                                                    <i class="lastudioicon lastudioicon-time-clock"></i>
                                                    <span>24h/7j</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto://contact@viore.tn">
                                                    <i class="lastudioicon lastudioicon-mail"></i>
                                                    <span>contact@viore.tn</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#1">
                                                    <i class="lastudioicon lastudioicon-phone-call-1"></i>
                                                    <span>(+216) 50 784 900</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#1">
                                                    <i class="lastudioicon lastudioicon-home-4"></i>
                                                    <span>Hammamet , Avenue abu dhabi 8050</span>
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
        </div>
        <div class="footer-bottom-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-8 col-12">
                        <div class="copyright">
                            <span>Copyright © 2021 | </span>
                            <a href="#1"> VIORE - Tous droits réservés..</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                        <div class="social-link-2">
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
                </div>
            </div>
        </div>
</div>
    <div class="mobile-footer">
        <div class="container-fluid-custom">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-footer-wrapper">
                        <ul class="mobile-footer-nav">
                            <li>
                                <a href="{{ url('/')}}" class="drop-toggle">
                                    <i class="lastudioicon lastudioicon-home-4"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/Wishlist')}}">
                                    <i class="lastudioicon-heart-2"></i>
                                    <span class="badge"><?php echo count($wishlist); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/')}}#commande">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/Panier')}}">
                                    <i class="lastudioicon-shopping-cart-3"></i>
                                    <span class="badge">0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Model pop up produit-->

<!-- Modal Area Start Here -->
    <div class="modal fade modal-wrapper" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area single-product-main-area row">
                        <div class="col-sm-12 col-xl-6 col-md-6">
                            
                                    <div class="single-blog-image" id="image">
                                        
                                    </div>
                                    
                                    
                               
                            
                        </div>
                        <div class="col-sm-12 col-xl-6 col-md-6">
                            <div class="product-summery position-relative">
                                <div class="product-head">
                                    <h1 class="product-title"><a href="" id="nom"></a></h1>
                                </div>
                                <div class="price-box">
                                    <span class="regular-price" id="prix"></span>
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
                                                <a href="#"><i class="fa fa-commenting-o"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-description" style="height:130px;overflow: hidden;text-overflow: ellipsis;">
                                    <p id="desc"></p>
                                </div>
                                <form name="addtocartForm" id="addtocartForm" action="{{url('add_cart')}}" method="post">
                                {{ csrf_field()}}
                                <input type="hidden" id="prod_id" name="prod_id" value="">
                                <input type="hidden" id="prod_nom" name="prod_nom" value="">
                                <input type="hidden" id="prod_code" name="prod_code" value="">
                                <input type="hidden" name="prod_prix" id="price" value="">
                                <input type="hidden" id="prod_couleur" name="prod_couleur" value="">    
                                
                                <div class="product-variant">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Taille</th>
                                                <td>
                                                    <select class="myniceselect wide" id="size" name="taille" style="width: 100%;padding: 0px;margin: 0px;height: 40px;line-height: 40px;">
                                                        
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Marque</th>
                                                <td>
                                                    <p>VIORE</p>
                                                </td>
                                            </tr>
                                            <tr class="sku">
                                                <th>Réf </th>
                                                <td>
                                                    <p id="ref"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="quantity-with_btn">
                                    <div class="quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text" name="qty">
                                            <div class="dec qtybutton"><i class="lastudioicon-i-delete-2"></i></div>
                                            <div class="inc qtybutton"><i class="lastudioicon-i-add-2"></i></div>
                                        </div>
                                    </div>
                                    <div class="add-to_cart">
                                        <a class="border-button border-color-2" href="javascript:{}" onclick="document.getElementById('addtocartForm').submit(); return false;">J'achéte</a>
                                    </div>
                                </div>
                                <div class="add-actions">
                                    <ul>
                                        <li><a href="" id="wishlist" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ajouter aux favories"><i class="lastudioicon-heart-2"></i></a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                
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

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Area End Here -->
<script>
$(document).on("click", "#pop", function () {
     var id = $(this).data('id');
     /*****link add to wishlist */
     var link="{{ url('/Ajouter_à_la_liste_de_souhaits')}}"+"/"+id;
     $("#wishlist").attr('href',link);
     var url="{{ url('/DetailProduit')}}"+'/'+id;
     $("#size").empty();
        
     $.get(url, function(data){
        console.log();
      $(".modal-body #nom").html( data.nom );
      $(".modal-body #prix").html( data.prix +" TND");
      $(".modal-body #desc").html( data.description);
      $(".modal-body #ref").html( data.code);
      $(".modal-body #image").html('<img class="img-fluid" src="img/produit/l/'+ data.image +'" alt="">');
      /******Remplir dropdown taille*******/
      if (data.attributes.length > 0) {
        $.each(data.attributes,function(index,attrObj){
           $("#size").append("<option value='"+id+"-"+attrObj.taille+"' >"+attrObj.taille+"</option>");
        })
      }
      


      /****Remplir le formulaire******/
      $(".modal-body #prod_id").val( id );
      $(".modal-body #price").val( data.prix);
      $(".modal-body #prod_nom").val(data.nom);
      $(".modal-body #prod_code").val( data.code);
      $(".modal-body #prod_couleur").val( data.couleur);

    });
});
</script> 


<script>
            $(document).ready(function(){
                $("#size").change(function(){
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
</script>