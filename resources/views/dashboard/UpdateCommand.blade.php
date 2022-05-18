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

    
<div class="col-12">
                <div class="card">
                  <div class="card-body">

                    


                    

                      <h4 class="card-title">Modifier les produits</h4><br>
                      <form method="POST" action="{{ url('/Commande/AjouterProduit')}}">
                           {{ csrf_field() }}

                           <input type="hidden" name="id_command" value="{{ $commande->id }}">
                      <div class="row" id="Addproduct">
                        <div class="col-md-4">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <select class="form-control" id="product" name="id_produit">
                          <option value="0">Produits</option>
                          @foreach($produit_dropdown as $row)
                            <option value="{{ $row->id }}">{{ $row->nom }}</option>
                            @endforeach
                       </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="qty" placeholder="Quantité" name="qty2">
                            </div>
                
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              <select class="form-control" id="Size" name="size">
                                <option value="0">Taille</option>
                              </select>
                            </div>
                
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                              
                      <button type="submit" class="btn btn-outline-info btn-rounded btn-icon" id="btn">
                        <i class="mdi mdi-plus-circle"></i>
                        </button>
                            </div>
                
                          </div>
                        </div>
                      </div>
                      
                      </form>

                      <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                      

                      <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <tr class="">
                    
                              <th>Détail de la commande</th>
                              <th class="text-right">Quantité</th>
                              
                              <th class="text-right">Taille</th>
                              
                              <th class="text-right">Prix</th>
                              <th class="text-right">Total</th>
                              <th class="text-right">Actions</th>
                            </tr>
                        
                          </tr>
                        </thead>
                        <tbody>
                         <?php 
                            $total=0;
                          ?>
                    
                          @if($produits != NULL)
                          @foreach($produits as $pro)
                          <tr class="text-right">
                              
                              <td class="text-left">{{ $pro->nom_produit }}</td>
                              <td class="text-center">
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp{{ $pro->qty }}
                                
                              </td>
                              
                              <td>
                                
                                @if($pro->taille > 0)
                                {{ $pro->taille }}
                                @else
                                <i class="mdi mdi-block-helper"></i> &nbsp &nbsp 
                                @endif
                              </td>
                              
                              <td id="prix">{{ $pro->price }} TND</td>
                              <input type="hidden" name="price" id="price" value="{{ $pro->price }}">
                              <td id="totalttc">{{ $pro->qty*$pro->price }} TND</td>
                              <input type="hidden" name="total" id="total" value="{{ $pro->montant_ttc }}">


                              <td>
                              <a href='{{ url("/Modifier/Commande/Supprimer/Produit",$pro->id)}}'> 
                                <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" title="Supprimer"><i class="mdi mdi-delete"></i>
                                </button>
                              </a>

                              </td>
                          </tr>
                          <?php 
                            $total=$total+($pro->qty*$pro->price);
                          ?>
                          @endforeach
                          @endif
                          
                        </tbody>
                      </table>
                    </div>
                    </div>
                    <hr>
                    <div class="container-fluid mt-5 w-100">
                      

                      <h4 class="text-right mb-5">Total TTC : {{ $commande->total }} TND</h4>
                      @if($commande->promo > 0)
                      <h4 class="text-right mb-5">Remise : - <?php echo $commande->promo ;?> TND</h4>
                      @endif

                      @if($commande->code_promo != NULL && $commande->code_promo != "/")
                      <h4 class="text-right mb-5">Code promo : <?php echo $commande->code_promo ;?> TND</h4>
                      @endif

                     
                      <h4 class="text-right mb-5">Net à payé : <?php echo $commande->net ;?> TND</h4>

                      
                    </div>
                    
                    <h4 class="card-title">Modifier commande</h4>
                    <p class="card-description"></p><br>
                    
                    <form class="form-sample" method="post" action="{{ url('/Commande/Modification',$commande->id)}}">
                      
                      {{ csrf_field() }}
      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nom client</label>
                            
                              <input type="text" class="form-control" name="nom" value="{{ $commande['nomclient'] }}"/>
                            
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Téléphone</label>
                            
                              <input type="text" class="form-control" name="tel" value="{{ $commande->tel }}" />
                              
                            
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Région</label>
                            
                              <select class="form-control" name="region">
                                <option value="{{ $commande->region }}" selected>{{ $commande->region }}</option>
                                <option value="Bizerte">Bizerte</option>
                                                <option value="Tunis">Tunis</option>
                                                <option value="Ariana">Ariana</option>
                                                <option value="Manouba">Manouba</option>
                                                <option value="Ben Arous">Ben Arous</option>
                                                <option value="Zaghouan">Zaghouan</option>
                                                <option value="Nabeul">Nabeul</option>
                                                <option value="Jendouba">Jendouba</option>
                                                <option value="Béja">Béja</option>
                                                <option value="Le Kef">Le Kef</option>
                                                <option value="Siliana">Siliana</option>
                                                <option value="Sousse">Sousse</option>
                                                <option value="Monastir">Monastir</option>
                                                <option value="Mahdia">Mahdia</option>
                                                <option value="Kairouan">Kairouan</option>
                                                <option value="Kasserine">Kasserine</option>
                                                <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                <option value="Sfax">Sfax</option>
                                                <option value="Gabès">Gabès</option>
                                                <option value="Médenine">Médenine</option>
                                                <option value="Tataouine">Tataouine</option>
                                                <option value="Gafsa">Gafsa</option>
                                                <option value="Tozeur">Tozeur</option>
                                                <option value="Kébili">Kébili</option>

                              </select>
                            
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Ville</label>
                            
                              <input type="text" class="form-control" name="ville" value="{{ $commande->ville }}" />
                              
                            
                          </div>
                        </div>
                        
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Adresse</label>
                            
                              <input type="text" class="form-control" name="adresse" value="{{ $commande->adresse }}" />
                            
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Code postale</label>
                            
                              <input type="text" class="form-control" name="postal" value="{{ $commande->postal }}" />
                              
                            
                          </div>
                        </div>
                        
                      </div>
                      
                      
                      <center><button type="submit" class="btn btn-gradient-primary mr-2">Modifier adresse</button></center>
                    </form><br>
                  </div>
                </div>
              </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js
"></script>
<script>
  $(document).on("change","#product",function(e){
    var id=e.target.value;
    console.log(id);
    var url="{{ url('/Taille')}}"+'/'+id;
    $.get(url, function(data){
      $('#Size').empty();
      $('#Size').append('<option value="0">Choisir la taille de produit</option>');
      $.each(data,function(index,attrObj){
        $('#Size').append('<option value="'+ attrObj.id +'">'+ attrObj.taille +'</option>');
      })
      
    });
  });
  
</script>



@endsection