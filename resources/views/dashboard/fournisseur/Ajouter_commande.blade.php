@extends('layouts.app1')
@section('content')

@if(Session::has('flash_message_error'))
  <div class="toast" id="danger" data-autohide="true" data-delay="2300" style="background-color:#d42d2d;position:relative;margin-top: -20px; margin-left: 850px;">
    <div class="toast-header" style="background-color:#d42d2d;">
      <strong class="mr-auto"><h4 style="color:white;">Ouups !</h4></strong>
      <small class="text-muted"></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body" style="color:white;">
      <img src="{{URL::asset('assets/images/dashboard/danger.png')}}" style="width:30px;height: 30px; float: left;">
      <p style="margin-left: 50px;">{!! session('flash_message_error') !!}</p>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#danger').toast('show');
    });
  </script>
@endif


@if(Session::has('flash_message_success'))
      <div class="toast" id="success" data-autohide="true" data-delay="2300" style="background-color:#1bcfb4;position:relative;margin-top: -20px; margin-left: 850px;">
    <div class="toast-header" style="background-color:#1bcfb4;">
      <strong class="mr-auto"><h4 style="color:white;">Succés</h4></strong>
      <small class="text-muted"></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body" style="color:white;">
      <img src="{{URL::asset('assets/images/dashboard/success.png')}}" style="width:30px;height: 30px; float: left;">
      <p style="margin-left: 50px;">{!! session('flash_message_success') !!}</p>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#success').toast('show');
    });
  </script>
    @endif


  <?php $total=0.00; ?>
  @if(sizeof($produits) > 0)
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Votre panier</h4><br>
                      <div class="table-responsive col-12">
                      
                      <table class="table">
                        <thead>
                          <th>Désignation</th>
                          <th></th>
                          <th></th>
                          <th>Quantité</th>
                          <th>Taille</th>
                          <th>Prix</th>
                          <th>Total</th>
                          <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                        
                        @if($produits != NULL)
                        @foreach($produits as $pc)  
                          <tr>
                           
                      

                      <td>
                        {{ $pc->nom_produit }}
                      </td>
                      
                      <td>
                        
                      </td>
                     
                      
                     

                      <td>
                        
                      </td>

                      

                      <td>
                          {{ $pc->qty }} 
                      </td>
                      <td>
                        @if($pc->taille != 0)
                        {{ $pc->taille }}
                        @else
                          -
                        @endif
                      </td>

                      
                      <td>
                        {{ $pc->price }}
                      </td>

                      <td>
                        {{ $pc->price*$pc->qty }}
                      </td>
                      <td>
                        <a href="{{ url('/Commande/Supprimer/Produit',$pc->id)}}" title="Supprimer">
                          <button class="btn btn-danger btn-rounded btn-icon">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        </a>
                      </td>

                      
                        </tr>
                        <?php $total=$total+($pc->price*$pc->qty); ?>
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                      <br>
                    </div>
                      <p style="text-align: right;"><b>Total :&nbsp</b><?php echo $total; ?> TND</p>
                      <a href="{{ url('/PasserCommande')}}">
                        <button type="submit" class="btn btn-gradient-primary mr-2">Passer la commande</button>
                      </a>
                    </div>
                    
                  </div>
                </div>
              </div>        
  @endif

<!----test--->

<div class="col-md-12">
    <div class="card">
                  <div class="card-body">
                    <div class="product-nav-wrapper row">
                      <div class="col-lg-10 col-md-9">
                        <ul class="nav product-filter-nav">
                        <li class="active"><a href="{{ url('/Ajouter_commande')}}">Tous</a></li>
                            @foreach($categories as $cat)
                          
                          <li><a href="{{ url('/produitsducatégorie',$cat->id)}}">{{ $cat->nom }}</a></li>
                          
                          @endforeach
                        </ul>
                      </div>
                      <div class="col-lg-2 col-md-3 product-filter-options">
                        
                        
                        <!-- <ul class="account-user-actions">
                          
                            <a href="#"><i class="mdi mdi-cart"></i>
                              <div class="badge badge-pill badge-primary">{{ sizeof($produits)}}</div>
                            </a>
                          </li>
                          <li><a href="#"><?php echo $total; ?> TND</a></li>
                        </ul> -->
                      </div>
                    </div>
                    <div class="row product-item-wrapper">
                        @foreach($produit as $row)
                      <div class="col-lg-4 col-md-6 col-sm-6 col-12 product-item">
                        <div class="card">
                          <div class="card-body">
                            <div class="action-holder">
                              
                                  @if($row->total_stock > 0)
                                  <div class="sale-badge bg-success">
                                   <i class="mdi mdi-lock-open icon-md"></i>
                                   </div>
                                  @else
                                  <div class="sale-badge bg-danger">
                                  <i class="mdi mdi-lock icon-md"></i>
                                    </div>
                                  @endif
                                
                              
                            </div>
                            <div class="product-img-outer">
                              <img class="product_image" src='{{URL::asset("img/produit/m/$row->image")}}' alt="prduct image">
                            </div>
                            <p class="product-title">{{ $row->nom }}</p>
                            <p class="product-price" id="{{ $row->id }}-prixgros">{{ $row->prix_gros }} TND</p>
                            <p class="product-actual-price" id="{{ $row->id }}-prix">{{ $row->prix }} TND</p>
                            <ul class="product-variation">
                            @if(sizeof($row->attributes) > 0)
                            
                                @foreach($row->attributes as $att)
                                    <li id="{{ $row->id }}-check" style=""><a id="attribut" data-id="{{ $row->id }}" data-prix="{{ $att->prix_at }}" data-prix_gros="{{ $att->prix_gros }}" data-size="{{ $att->taille }}">{{ $att->taille }}</a></li>
                                @endforeach
                            @else
                                <br>
                            @endif
                            </ul>
                            <form id="Addtocartfform" method="post" action="{{ url('/Ajouter_au_panier')}}" class="forms-sample">
                                {{ csrf_field()}}
                                <div id="InputHidden">
                                    <input type="hidden" id="prod_nom" name="prod_nom" value="">
                                    <input type="hidden" id="prod_code" name="prod_code" value="">
                                    <input type="hidden" id="prod_prix" name="prod_prix" value="">
                                    <input type="hidden" id="prod_id" name="prod_id" value="">
                                    <input type="hidden" id="taille" name="taille" value="0">
                                    <input type="hidden" id="qty" name="qty" value="">
                                </div>
                               
                            
                          </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <input type="text" id="quantity" value="" class="form-control" placeholder="Entrer la quantité" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                        
                                        <button class="btn btn-sm btn-gradient-primary" type="button" data-prixgros="{{ $row->prix_gros }}" data-idprod="{{ $row->id }}" data-nom="{{ $row->nom}}" data-code="{{ $row->code }}" id="Submitform">Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                        </div>
                      </div>
                      @endforeach
                      
                    </div>
                    {{ $produit->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>

              <!--script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js
"></script>
<script>
    $(document).on("keyup", "#quantity", function (e) {
        var qty=e.target.value;
        $("#qty").val(qty);
    });
  $(document).on("click", "#attribut", function () {
     var prix = $(this).data('prix');
     var prix_gros = $(this).data('prix_gros');
     var size = $(this).data('size');
     var id_produit=$(this).data('id');
     $("#"+id_produit+"-prix").html(prix+" TND");
     $("#"+id_produit+"-prixgros").html(prix_gros+" TND");
     $("#taille").val(prix_gros+"-"+size);
     $("#prod_prix").val(prix_gros);
     $("#"+id_produit+"-check").css("background-color", "red");
     $("#"+id_produit+"-check").css("color", "white");
    // alert("prix="+prix+" / prix_gros ="+prix_gros+" / size="+size);
    });

    $(document).on("click","#Submitform",function(){
        var id=$(this).data('idprod');
        var nom =$(this).data('nom');
        var code=$(this).data('code');
        var prix=$(this).data('prixgros');
        $("#prod_nom").val(nom);
        $("#prod_code").val(code);
        $("#prod_id").val(id);
        if($("#taille").val() == "0"){
            $("#prod_prix").val(prix);
        }
        $("#Addtocartfform").submit();
    });
</script>
<!---fin test--->
 
            
@endsection