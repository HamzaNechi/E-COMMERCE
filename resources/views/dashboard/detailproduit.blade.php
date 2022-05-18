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
<div class="row">
      <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    @if($detail != NULL)
                    @foreach($detail as $val)
                      <center><img src='{{ URL::asset("img/produit/m/$val->image")}}' style="width: 90%;height: auto;border-radius: 7%;"></center>
                      <br>
                      <center><h4>{{ $val->nom }}</h4></center>
                    <center><p class="card-description">{{ $val->code }}</p></center>
                    @endforeach
                    @endif


                    @if($pack != NULL)
                   
                      <center><img src='{{ URL::asset("img/produit/m/$pack->image")}}' style="width: 90%;height: auto;border-radius: 7%;"></center>
                      <br>
                      <center><h4>{{ $pack->nom }}</h4></center>
                    <center><p class="card-description">{{ $pack->code }}</p></center>
                    
                    @endif
                  </div>
                </div>
      </div>
      <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Détail produit</h4><br><br><br><br>                        
                      <ul class="list-ticked">
                        @if($detail != NULL)
                          @foreach($detail as $row)
                          <li><b>Id</b> : {{ $row->id}}</li><br><br>
                          <li><b>Couleur</b> : {{ $row->couleur }}</li><br><br>
                          <li><b>Quantité</b> : {{ $row->total_stock }}</li><br><br>
                          <li><b>Description</b> : <?php echo $row->description; ?></li>
                          
                      </ul>
                        <br><br><br>
                        <center>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon" id="ForDeleteProd" data-toggle="modal" data-target="#ModalProd" data-fourni="{{ $row->id }}" title="Supprimer"><i class="mdi mdi-delete"></i></button>

                          

                          <a href="{{ url('/edit-product',$row->id)}}">
                          <button type="button" class="btn btn-dark btn-rounded btn-icon" title="Modifier">
                            <i class="mdi mdi-pencil"></i>
                          </button></a>

                          <a href="{{ url('/add-attribute',$row->id)}}">
                          <button type="button" class="btn btn-success btn-rounded btn-icon" title="Ajouter attribut">
                            <i class="mdi mdi-plus-circle-outline"></i>
                          </button></a>

                          <a href="{{ url('/add-image',$row->id)}}">
                          <button type="button" class="btn btn-info btn-rounded btn-icon" title="Ajouter image">
                            <i class="mdi mdi-image-filter"></i>
                          </button></a></center>
                        @endforeach
                        @endif



                        @if($pack != NULL)
                          
                          <li><b>Id</b> : {{ $pack->id}}</li><br><br>
                          <li><b>Couleur</b> : {{ $pack->couleur }}</li><br><br>
                          <li><b>Prix</b> :{{ $pack->prix }} TND</li><br><br>
                          <li><b>Quantité</b> : {{ $pack->total_stock }}</li><br><br>
                          <li><b>Description</b> : <?php echo $pack->description; ?></li>
                          
                      </ul>
                        <br><br><br>
                        <center>
                        <button type="button" class="btn btn-danger btn-rounded btn-icon" id="ForDeleteProd" data-toggle="modal" data-target="#ModalProd" data-fourni="{{ $pack->id }}" title="Supprimer"><i class="mdi mdi-delete"></i></button>

                          

                          <a href="{{ url('/edit-product',$pack->id)}}">
                          <button type="button" class="btn btn-dark btn-rounded btn-icon" title="Modifier">
                            <i class="mdi mdi-pencil"></i>
                          </button></a>

                          

                          <a href="{{ url('/add-image',$pack->id)}}">
                          <button type="button" class="btn btn-info btn-rounded btn-icon" title="Ajouter image">
                            <i class="mdi mdi-image-filter"></i>
                          </button></a></center>
                        
                        @endif
                    </div>
                    
                  </div>
                </div>
      </div>
              
</div>

<!-- Modal 1 -->
<div class="modal fade" id="ModalProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cet produit ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Supprimer_produit')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="produit">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Supprimer</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--fin model-->



@if($pack == NULL && sizeof($attribute) > 0 )
<div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Autre détail</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Prix</th>
                            <th>Prix en gros</th>
                            <th>Sku</th>
                            <th>Taille</th>
                            <th>Quantité</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @foreach($attribute as $keye)
                          <tr>
                          <td>
                             {{ $keye->prix_at}} TND
                          </td>

                          <td>
                             {{ $keye->prix_gros }} TND
                          </td>
                     

                      <td>
                        {{ $keye->sku }}
                      </td>
                      <td>
                        {{ $keye->taille }}
                      </td>

                      <td>
                        {{ $keye->stock }}
                      </td>
                          <td>
                            <button type="button" id="ForDeleteAtt" class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#SupprimerAttribut" data-id_att="{{ $keye->id }}"><i class="mdi mdi-delete"></i></button>

                          <a href="{{ url('/Modifier_attribut',$keye->id)}}">
                          <button type="button" class="btn btn-dark btn-rounded btn-icon">
                            <i class="mdi mdi-pencil"></i>
                          </button></a>

                          </td>
                        </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endif

@if($produit_pack != NULL && $attribute==NULL)
<div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Produits du pack</h4>
                    <br>
                      <button class="btn btn-primary btn-icon-text" type="button" id="ForAddProduct" data-toggle="modal" data-target="#exampleModal" data-pack="{{ $pack->id }}">
                        <i class="mdi mdi-cart-plus"></i> Ajouter produit
                      </button><br><br>
                      
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Quantité</th>
                              <th>Taille</th>
                              <th>Prix</th>
                              <th>Total HT</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($produit_pack as $keye)
                          <tr>
                            <td>
                              {{ $keye->nom_produit }}
                            </td>
                     

                            <td>
                              {{ $keye->qty }}
                            </td>

                            <td>
                              @if($keye->prod_taille != 0)
                                {{ $keye->prod_taille }} 
                              @else 
                                -
                              @endif
                            </td>

                            <td>
                              {{ $keye->prix }}
                            </td>

                            <td>
                              {{ $keye->prix*$keye->qty }}
                            </td>

                            <td>
                              <button type="button" id="ForDeleteProdPack" class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#exampleModalAtt" data-fourni="{{ $keye->id }}"><i class="mdi mdi-delete"></i></button>
                            </td>
                          </tr>
                          @endforeach
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
<!--Modal pour ajouter un produit-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter produit dans le pack</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('/Pack/Modifier/Ajouter_produit')}}">
          {{ csrf_field()}}
          <input type="hidden" name="id_pack" id="id_pack">
          <div id="AddInputHidden">
            
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Produit :</label>
            <select class="form-control" id="product" name="prod_id">
              <option value="0">Produits</option>
              @if($pack != NULL)
              @foreach($produit as $row)
                <option value="{{ $row->id }}">{{ $row->nom }}</option>
              @endforeach
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Quantité :</label>
            <input type="text" class="form-control" id="qty" placeholder="Quantité" name="qty">
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Taille :</label>
            <select class="form-control" id="Size" name="taille">
              <option value="0">Taille</option>
            </select>
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--Fin Modal pour ajouter un produit-->
<!-- Modal supprimer produit pack -->
<div class="modal fade" id="exampleModalAtt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette produit ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Pack/SupprimerProduit')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="prod_pack">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Supprimer</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--fin model-->


<!-- Modal supprimer attribut produit -->
<div class="modal fade" id="SupprimerAttribut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette attribut ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Supprimer_attribut')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="id_attribut" name="id_attribut">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Supprimer</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--fin model-->
<script>
  $(document).on("click", "#ForDeleteProd", function () {
     var id = $(this).data('fourni');
     $(".modal-body #recipient-name").val( id );
});

//For modal add product
  $(document).on("click","#ForAddProduct" ,function (event) {
    var id_pack=$(this).data('pack');
    $(".modal-body #id_pack").val( id_pack );
    console.log(id_pack); 
  });

  $(document).on("change","#product",function(e){
    var id=e.target.value;
    var wrapper = $('#AddInputHidden');
    var link="{{ url('/Afficher/Produit')}}"+'/'+id;
    $.get(link, function(data){
      var nom ='<input type="hidden" name="prod_nom" value="'+data.nom+'">';
      var code ='<input type="hidden" name="prod_code" value="'+data.code+'">';
      var prix ='<input type="hidden" name="prod_prix" id="price" value="'+data.prix+'">';
      var couleur ='<input type="hidden" name="prod_couleur" id="price" value="'+data.couleur+'">';
      var photo ='<input type="hidden" name="photo" id="photo" value="'+data.image+'">';
      $(wrapper).empty();
      $(wrapper).append(nom); 
      $(wrapper).append(code); 
      $(wrapper).append(prix); 
      $(wrapper).append(couleur); 
      $(wrapper).append(photo);                        
    });
    
    var url="{{ url('/Taille')}}"+'/'+id;
    $.get(url, function(data){
      $('#Size').empty();
      $('#Size').append('<option value="0">Choisir la taille de produit</option>');
      $.each(data,function(index,attrObj){
        $('#Size').append('<option value="'+ attrObj.prix_at +"-"+attrObj.taille+'">'+ attrObj.taille +'</option>');
      })
    });
  });
</script>

<script>
  $(document).on("click", "#ForDeleteProdPack", function () {
     var id = $(this).data('fourni');
     $(".modal-body #recipient-name").val( id );
});

/**Supprimer attribut */
$(document).on("click", "#ForDeleteAtt", function () {
     var id = $(this).data('id_att');
     $(".modal-body #id_attribut").val( id );
});
</script>
@endsection