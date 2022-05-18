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
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-description"> </p>

                    <!--Start block pack-->
                    @if($produits == NULL)
                      <div id="BlockPack" style="display: none;">
                    @else
                    <div id="BlockPack" style="display: block;">
                    @endif
                        <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Produit </th>
                            <th>Taille</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @if($produits != NULL)
                          <?php $tot=0; ?>
                          @foreach($produits as $ligne)
                          <tr>
                          <td>{{ $ligne->nom_produit }}  </td>
                          <td>{{ $ligne->prod_taille }}  </td>
                          
                          <td>{{ $ligne->qty }}</td>
                          <td>{{ $ligne->prix }}</td>
                          <td>{{ $ligne->qty*$ligne->prix }}</td>
                          <td>
                            
                           
                              <a href="{{ url('/Pack/SupprimerProduit',$ligne->id)}}">
                                <button type="button" title="Supprimer" class="btn btn-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i>
                                </button>
                              </a>
                          
                          
                        
                          </td>
                        </tr>
                        <?php $tot=$tot+$ligne->qty*$ligne->prix ; ?>
                        @endforeach

                          
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <p style="text-align: left;"><b>Total :</b>{{ $tot }} TND .</p>
                            </td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div><br>
                      <br>

                      <form action="{{ url('/Pack/Ajouter_produit')}}" method="post" id="addproductForm">
                        {{ csrf_field() }}

                        <div id="AddInputHidden">
                          
                        </div>
                      <div class="row" id="Addproduct">
                        <div class="col-md-4">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                          <select class="form-control" id="product" name="prod_id">
                            <option value="0">Produits</option>
                            @foreach($produit as $row)
                            <option value="{{ $row->id }}">{{ $row->nom }}</option>
                            @endforeach
                          </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="qty" placeholder="Quantité" name="qty">
                            </div>
                
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <select class="form-control" id="Size" name="taille">
                  
                            <option value="0">Taille</option>
                    
                        </select>
                            </div>
                
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <a href="javascript:{}" onclick="document.getElementById('addproductForm').submit(); return false;">
                                  <button class="btn btn-outline-info btn-rounded btn-icon" type="submit" >
                                    <i class="mdi mdi-plus-circle"></i></button>
                              </a>
                            </div>
                
                          </div>
                        </div>
                      </div></form>

                      </div>
                      <!--End block pack-->


                    <form id="addProductForm" class="forms-sample" method="POST" action="{{ url('/AddProduct')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label for="exampleSelectGender">Type*</label>
                        <select class="form-control" name="type_product" id="type">
                          @if($produits == NULL)
                          <option value="produit">Produit</option>
                          <option value="pack">Pack</option>
                          @else
                          <option value="produit">Produit</option>
                          <option value="pack" selected>Pack</option>
                          @endif
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Nom*</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Nom produit" name="nom">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Code*</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" name="code" placeholder="Code produit">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Catégorie*</label>
                        <select class="form-control" id="cat_id" name="cat_id">
                          <option value="0">Séléctionnez la catégorie</option>
                          <?php echo $cat_dropdown; ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword4">Couleur</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Couleur de produit" name="couleur">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputCity1">Prix*</label>
                        <input type="text" class="form-control" id="exampleInputCity1" name="prix" placeholder="Prix produit">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputCity1">Prix en gros</label>
                        <input type="text" class="form-control" name="prix_gros" placeholder="Prix en gros">
                      </div>


                      <div class="form-group">
                        <label for="exampleInputCity1">Quantité totale</label>
                        <input type="text" class="form-control" name="total_stock" placeholder="Quantité totale de produit" >
                      </div>
                      
                      <div class="form-group">
                        <label>Image*</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Choisir une image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                          </span>
                        </div>
                      </div>

                       <div class="form-group">
                        <!-- <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" rows="4" name="description"></textarea> -->
                        <div class="col-lg-12">
                            <div class="card">
                                <input type="hidden" id="description" name="description">
                                <div class="card-body">
                                    <label>Description</label>
                                    <div id="summernoteExample">
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div> 


                      
                      
                      <!-- <button type="submit" class="btn btn-gradient-primary mr-2">Ajouter</button> -->
                      <a class="btn btn-gradient-primary mr-2" href="javascript:{}" onclick="document.getElementById('description').value=document.getElementsByClassName('note-editable')[0].innerHTML;document.getElementById('submit').click();">Ajouter</a>
                <button type="submit" id="submit" style="display:none;"></button>
                      <button class="btn btn-light" type="reset">Annuler</button>
                    </form>
                  </div>
                </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">
  $(document).on("change","#product",function(e){
    var id=e.target.value;
    var wrapper = $('#AddInputHidden');
    var link="{{ url('/Afficher/Produit')}}"+'/'+id;
    $.get(link, function(data){
      var nom ='<input type="hidden" name="prod_nom" value="'+data.nom+'">';
      var code ='<input type="hidden" name="prod_code" value="'+data.code+'">';
      var prix ='<input type="hidden" name="prod_prix" id="price" value="'+data.prix+'">';
      var couleur ='<input type="hidden" name="prod_couleur" id="price" value="'+data.couleur+'">';
      var photo='<input type="hidden" name="photo" id="photo" value="'+data.image+'">';
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

  
  $(document).on("change","#type",function(e){
    var type = $(this).val();
    console.log(type);
    if (type=="produit") {
      $("#BlockPack").hide(500);
    }

    if (type=="pack") {
      $("#BlockPack").show(500);
    }
  });
</script>
@endsection