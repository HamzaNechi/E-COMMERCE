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
                     <h4 class="card-title">Sélectionnez vos produits</h4>

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>Taille</th>
                            <th> Prix </th>
                            <th> Total </th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $total=0; ?>
                          @foreach($produits as $prod)
                          <tr>
                            <td>
                              {{ $prod->designation }}
                            </td>
                            <td>  {{ $prod->qty }}</td>
                            <td>
                              {{ $prod->size }}
                            </td>
                            <td> {{ $prod->prix_venteHT }}</td>
                            <td> {{ $prod->montant_ttc }} </td>
                            <td>
                              <a href="{{ url('/Supprimer/Produit/Facture',$prod->id)}}">
                              <button type="button" class="btn btn-danger btn-rounded btn-icon" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button></a>
                            </td>
                          </tr>
                          <?php $total=$total + $prod->montant_ttc ; ?>
                          @endforeach
                          
                        </tbody>
                      </table>
                      <div style="text-align: right;margin-top: 3%;">
                        <b>Total HT :</b><?php echo $total; ?> TND<br>
                        @if($facture->promo > 0)
                        <b>Remise :</b>- <?php echo $facture->promo; ?> TND<br>
                        @endif

                        @if($facture->code != NULL && $facture->code != "/")
                        <b>Code promo :</b><?php echo $facture->code; ?><br>
                        @endif

                        @if($facture->tva > 0)
                        <b>TVA :</b>+ <?php echo $facture->tva; ?> %<br>
                        <b>Timbre :</b>+ <?php echo $facture->timbre; ?> TND<br>
                        @endif
                        <b>Total TTC :</b><?php echo $facture->total_ttc; ?> TND<br>
                        @if($facture->tranche > 0)
                        <b>Paiement :{{ $facture->methode }}
                        </b><br>

                        <b>Montant payé:</b><?php echo $facture->tranche; ?> TND<br>

                        <b>Net à payé :</b><?php echo $facture->net; ?> TND<br>
                        @endif
                      </div>
                      
                    </div><br>
                    <form action="{{ url('/A-P-F-P-M',$facture->id)}}" method="post" id="addproductForm">
                        {{ csrf_field() }}
                      <div class="row" id="Addproduct">
                        <div class="col-md-4">
                          <div class="form-group row">
                            
                            <div class="col-sm-12">
                          <select class="form-control" id="product" name="id_produit">
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
                      <button class="btn btn-outline-info btn-rounded btn-icon" type="submit" >
                        <i class="mdi mdi-plus-circle"></i></button>
                            </div>
                
                          </div>
                        </div>
                      </div></form><br>
                    <h4 class="card-title">Modifier votre facture</h4>
            		<p class="card-description"></p>
                    <form class="form-sample" method="post" action="{{ url('/Personnaliser/ModifierFacture',$facture->id)}}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nom client</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom & prénom du client" value="{{ $facture->client }}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="tel" placeholder="Numéro du téléphone" name="tel" value="{{ $facture->tel }}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Région</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="region" name="region">
                              <option value="{{ $facture->region }}" selected>{{ $facture->region }}</option>
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
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ville</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="ville" placeholder="Ville" name="ville" value="{{ $facture->ville }}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Adresse</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse" value="{{ $facture->adresse }}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Code postale</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="postal" placeholder="Code postale" name="postal" value="{{ $facture->postal }}">
                            </div>
                
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="date" placeholder="Date" value="{{ $facture->date }}"name="date">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">TVA</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="tva" placeholder="TVA" name="tva" value="{{ $facture->tva }}">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Timbre</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="timbre" placeholder="Timbre" name="" value="0.600" disabled>
                            </div>
                            <input type="hidden" name="timbre" value="0.600">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            @if($facture->promo > 0)

                            <label class="col-sm-3 col-form-label">Promotion actuel</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="" placeholder="" name="" value="{{ $facture->promo }}" disabled>
                              <input type="hidden" name="Actuelpromo" value="{{ $facture->promo }}">
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Méthode paiement</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="paiement" name="paiement">
                                
                                @if($facture->methode=="Comptant")
                                <option value="Comptant" selected>Comptant</option>
                                @endif
                                @if($facture->methode=="Par tranche")
                                <option value="Par tranche" selected>Par tranche</option>
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            
                          </div>
                        </div>
                      </div>

                      @if($facture->methode == "Par tranche")
                      <div class="row" id="Addfield">
                        <div class="col-md-6" id="Input">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Tranche</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="date" placeholder="Montant à payé" name="tranche" value="{{ $facture->tranche }}">
                              </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                      </div>
                      @endif

                      <div class="row" id="AddRemise">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remise</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="remise" name="remise">
                                
                              <option value="0">Séléctionner la méthode de remise</option>
                                <option value="fixe">Fixe</option>
                                <option value="pourcentage">Pourcentage</option>
                                <option value="code_promo">Code promo</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row" id="InputRemise">
                            
                            
                            
                          </div>
                        </div>
                      </div>
                      <center><button type="submit" class="btn btn-gradient-primary mr-2">Modifier</button></center>
                    </form><br>
                    
                    
                  

                      
                      
                  </div>
                </div>
              </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">
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

  $(document).on("change","#paiement",function(e){
    var wrapper = $('#Input');
    var method = $(this).val();
    var fieldHTML ='<div class="form-group row"><label class="col-sm-3 col-form-label">Tranche</label><div class="col-sm-9"><input type="text" class="form-control" id="date" placeholder="Montant à payé" name="tranche"></div></div>';
    if (method=="Par tranche") {
      $(wrapper).append(fieldHTML);
    }
  });


  $(document).on("change","#remise",function(e){
    var wrapper = $('#InputRemise');
    var method = $(this).val();
    console.log(method);
    var fixe ='<label class="col-sm-3 col-form-label">Montant fixe</label><div class="col-sm-9"><input type="text" class="form-control" id="remise" placeholder="Montant fixe" name="Fixe"></div>';

    var pourcentage ='<label class="col-sm-3 col-form-label">Pourcentage</label><div class="col-sm-9"><input type="text" class="form-control" id="remise" placeholder="Pourcentage" name="Pourcentage"></div>';

    var code_promo ='<label class="col-sm-3 col-form-label">Code promo</label><div class="col-sm-9"><input type="text" class="form-control" id="remise" placeholder="Code promo" name="code"></div>';


    if (method=="fixe") {
      $(wrapper).empty();
      $(wrapper).append(fixe);
    }

    if (method=="pourcentage") {
      $(wrapper).empty();
      $(wrapper).append(pourcentage);
    }

    if (method=="code_promo") {
      $(wrapper).empty();
      $(wrapper).append(code_promo);
    }

    if (method=="0") {
      $(wrapper).empty();
    }
  });
</script>
@endsection