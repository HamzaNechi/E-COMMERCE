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
      <h4 class="card-title">Ajouter produit</h4>
        <form class="forms-sample col-12" action="{{ url('/Ajouter_produit_devis')}}" method="post">
                    {{ csrf_field() }}
                      
                    <div id="AddInputHidden">
                          
                        </div>
                      
                      <div class="form-group">
                        
                        <select class="form-control" name="id_produit" id="product">
                          <option value="0">Tous les produit</option>
                          @foreach($produit_dropdown as $pd)
                            <option value="{{ $pd->id }}">{{ $pd->nom }}</option>
                          @endforeach
                          
                        </select>
                      </div>

                      <div class="form-group">
                        
                        <input type="text" name="qty" class="form-control" placeholder="Quantité">
                      </div>

                      <div class="form-group">
                        
                        <select class="form-control" name="size" id="Size">
                          <option value="0">Séléctionnez le taille</option>
                        </select>
                      </div>
                      
                      
                      
                      <center><button type="submit" class="btn btn-gradient-primary mr-2">Ajouter</button></center>
                      
                    </form>
    </div>
  </div>
</div>

<div class="col-md-7 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="clearfix">
        <h4 class="card-title float-left">Les produits sélectionnez</h4>
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
                          <?php $total=0; ?>
                          @if($produits != NULL)
                          @foreach($produits as $row)
                          <tr>
                           
                      

                      <td>
                        {{ $row->nom_produit }}
                      </td>
                      
                      <td>
                        
                      </td>
                     
                      
                     

                      <td>
                        
                      </td>

                      

                      <td style="text-align: center;">
                          {{ $row->qty }} 
                      </td>
                      <td style="text-align: center;">
                        @if($row->taille == 0)
                        -
                        @else
                        {{ $row->taille }}
                        @endif
                        
                      </td>

                      
                      <td>
                        {{ $row->prix }}
                      </td>

                      <td>
                        {{ $row->total }}
                      </td>
                      <td>
                        <a href="{{ url('/Devis/DemanderDevis/SupprimerProduit',$row->id)}}">
                        <button class="btn btn-danger btn-rounded btn-icon" title="Supprimer"><i class="mdi mdi-delete"></i>
                        </button></a>
                      </td>

                      
                        </tr>
                        <?php $total=$total+$row->total; ?>
                        @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                      <br>
                      <p style="text-align: right;"><b>Total :&nbsp</b><?php echo $total; ?> TND</p>
                      <a href="{{ url('/Devis')}}">
                        <button type="submit" class="btn btn-gradient-primary mr-2">Confirmer</button>
                      </a>
      </div>
      
    </div>
  </div>
</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js
"></script>
<script>
  $(document).on("change","#product",function(e){
    var id=e.target.value;
    var wrapper = $('#AddInputHidden');
    var link="{{ url('/Afficher/Produit')}}"+'/'+id;
    $.get(link, function(data){
      var nom ='<input type="hidden" name="prod_nom" value="'+data.nom+'">';
      var code ='<input type="hidden" name="prod_code" value="'+data.code+'">';
      var prix ='<input type="hidden" name="prod_prix" id="price" value="'+data.prix_gros+'">';
      var couleur ='<input type="hidden" name="prod_couleur" id="price" value="'+data.couleur+'">';
      $(wrapper).empty();
      $(wrapper).append(nom); 
      $(wrapper).append(code); 
      $(wrapper).append(prix); 
      $(wrapper).append(couleur);                        
    });
    
    var url="{{ url('/Taille')}}"+'/'+id;
    $.get(url, function(data){
      $('#Size').empty();
      $('#Size').append('<option value="0">Choisir la taille de produit</option>');
      $.each(data,function(index,attrObj){
        $('#Size').append('<option value="'+ attrObj.prix_gros +"-"+attrObj.taille+'">'+ attrObj.taille +'</option>');
      })
      
    });
  });
  
</script>             
@endsection