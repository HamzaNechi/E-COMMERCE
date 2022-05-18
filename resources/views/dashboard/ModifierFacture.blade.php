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
                    <h4 class="card-title">Modifier facture</h4>
                    <p class="card-description"></p><br>

                    @if($facture->id_fournisseur != 0)
                    <form class="form-sample" method="post" action="{{ url('/ModifierFacture',$facture['id'])}}">
                      
                      {{ csrf_field() }}
                    @endif
                      <input type="hidden" name="id_user" value="">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fournisseur</label>
                            
                              <input type="text" class="form-control" name="nom" value="{{ $facture['client'] }}" disabled/>
                            
                          </div>
                        </div>
                        @if($facture->id_fournisseur != 0)
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Matricule fiscale</label>
                            @foreach($fourni as $f)
                              <input type="text" class="form-control" name="matricule" value="{{ $f->matricule }}" disabled/>
                              
                            @endforeach
                          </div>
                        </div>
                        @else
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Téléphone</label>
                            
                              <input type="text" class="form-control" name="matricule" value="{{ $facture->tel }}" disabled/>
                              
                            
                          </div>
                        </div>
                        @endif
                      </div>
                      @if($facture->id_fournisseur > 0)
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Paiement</label>
                            
                              <select class="form-control" id="paiement" name="paiement">
                                <option value="Comptant">Comptant</option>
                                <option value="Par tranche">Par tranche</option>
                              </select>
                            
                          </div>
                        </div>

                        <div class="col-md-6" id="tranche">
                          
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Modifier paiement</button>
                      </form><br>
                      @endif
                      

                      
                      <form method="POST" action="{{ url('/Modifier/AjouterProduit',$facture->id_commande)}}">
                           {{ csrf_field() }}
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
                              
                                <a href="{{ url('/EffacerProduitDeFacture',$pro->id)}}">
                                <button type="button" class="btn btn-danger btn-rounded btn-icon" title="Supprimer"><i class="mdi mdi-delete"></i>
                                </button></a>

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
                    
                    <div style="text-align: right;margin-top: 3%;">
                        <b>Total HT :</b> <?php echo $total; ?> TND<br>
                        @if($facture->promo > 0)
                        <b>Remise :</b> <?php echo "-".$facture->promo; ?> TND<br>
                        @endif

                        @if($facture->code != NULL && $facture->code != "/")
                        <b>Code promo :</b> <?php echo $facture->code; ?><br>
                        @endif

                        @if($facture->tva > 0)
                        <b>TVA :</b> <?php echo $facture->tva; ?> %<br>
                        <b>Timbre :</b> <?php echo $facture->timbre; ?> TND<br>
                        @endif
                        <b>Total TTC :</b> <?php echo $facture->total_ttc; ?> TND<br>
                        @if($facture->tranche > 0)
                        <b>Paiement :{{ $facture->methode }}
                        </b><br>

                        <b>Montant payé:</b> <?php echo $facture->tranche; ?> TND<br>
                        @endif
                        <b>Net à payé :</b><?php echo $facture->net; ?> TND<br>
                      </div>
                    
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
      //$('#Size').append('<option value="0">Choisir la taille de produit</option>');
      $.each(data,function(index,attrObj){
        $('#Size').append('<option value="'+ attrObj.id +'">'+ attrObj.taille +'</option>');
      })
      
    });
  });


  $(document).on("change","#paiement",function(e){
    var wrapper = $('#tranche');
    var method = $(this).val();
    var fieldHTML ='<label>Tranche à payé</label><input type="text" class="form-control" name="tranche" placeholder="Tranche à payé" />';
    if (method=="Par tranche") {
      $(wrapper).append(fieldHTML);
    }
  });
  
</script>



@endsection