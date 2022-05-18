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
            
            <div class="page-header">
              <!-- <a href="{{ url('commande_en_pdf',$detail_commande->id)}}" title="Télécharger reçus">
                <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-cloud-download"></i>
                  </span>
                </h3>
              </a> -->
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
             		<div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                <center><h4 class="card-title">N° de commande</h4></center>
                    <div class="media">
                      
                      <div class="media-body">
                        <center>
                        	<i class="mdi mdi-alpha icon-lg text-danger"></i><br><br>
                        	<p class="card-text">
                  
                        	<?php echo $detail_commande['id']; ?></p></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">Date</h4></center>
                    <div class="media">
                      
                      <div class="media-body">
                        <center>
                        	<i class="mdi mdi-alarm icon-lg text-danger"></i><br><br>
                        	<p class="card-text"><?php echo $detail_commande['date']; ?></p></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">Total</h4></center>
                    <div class="media">
                      
                      <div class="media-body">
                        <center>
                        	<i class="mdi mdi-cash-multiple icon-lg text-danger"></i><br><br>
                        	<p class="card-text"><?php echo $detail_commande['net']; ?> TND</p></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">État de commande</h4></center>
                    <div class="media">
                      
                      <div class="media-body">
                        <center>
                        	<br>
                        	@if($detail_commande->etat == "Payé")
                        	<label class="badge badge-success">Payé</label>
                        	@else
                        		@if($detail_commande->etat == "En cours")
                        		<label class="badge badge-warning">En cours</label>
                            <a type="button" class="" id="ForEdit" data-toggle="modal" data-target="#Edit" data-id="{{ $detail_commande->id }}" title="Changer l'état"><label class="badge badge-dark"><i class="mdi mdi-pencil"></i></label></a>
                        		@else
                        		<label class="badge badge-danger">Refusé</label>
                        		@endif
                        	@endif
                        	<br><br>
                        	<p class="card-text">
                        	
                        		Paiement à la livraison
                        	</p>
                          
                        </center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th><strong>Produit</strong></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th><strong>Total</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($detail_commande->produits as $prod)
                          <tr>
                            <td class="v-align-middle semi-bold">
                                <p><b>{{ $prod->nom_produit}} @if($prod->taille != 0)( {{ $prod->taille }} )@endif</b> x{{ $prod->qty }}</p>
                            </td>
                                          
                            <td class="v-align-middle semi-bold">
                                 <p></p>
                            </td>
                                         
                                          
                                         

                            <td class="v-align-middle">
                                <p></p>
                            </td>

                                          

                            <td class="v-align-middle">
                               <p></p>
                            </td>
                            <td class="v-align-middle">
                                <p>{{ $prod->qty*$prod->price }} TND</p>
                            </td>
                          </tr>

                          @foreach($produit as $product)
                          @if($prod->id_produit == $product->id && $product->type == "pack")
                            <tr>
                            <th style="border-top-style: none;"><strong>&nbsp &nbsp &nbsp &nbspCe pack contient :</strong></th>
                              <th style="border-top-style: none;"></th>
                              <th style="border-top-style: none;">Taille</th>
                              <th style="border-top-style: none;"></th>
                              <th style="border-top-style: none;"><strong></strong></th>
                            </tr>
                          @foreach($produit_pack as $pp)
                          @if($pp->id_pack == $product->id)
                          <tr>
                            <td style="border-top-style: none;">
                                <p style="color:gray;">&nbsp &nbsp &nbsp &nbsp{{ $pp->nom_produit }}</p>
                            </td>
                                          
                            <td style="border-top-style: none;">
                                 <p></p>
                            </td>
                                         
                                          
                                         

                            <td class="v-align-middle" style="border-top-style: none;">
                                <p style="color:gray;">{{ $pp->prod_taille }}</p>
                            </td>

                                          

                            <td class="v-align-middle" style="border-top-style: none;">
                               <p></p>
                            </td>
                            <td class="v-align-middle" style="border-top-style: none;">
                                <p></p>
                            </td>
                          </tr>
                          @endif
                          @endforeach


                          @endif
                          @endforeach


                          @endforeach
                          <tr>
                                          <td class="v-align-middle semi-bold">
                                            
                                          </td>
                                          
                                          <td class="v-align-middle semi-bold">
                                            <p></p>
                                          </td>
                                         
                                          
                                         

                                          <td class="v-align-middle">
                                            <p></p>
                                          </td>

                                          

                                          <td class="v-align-middle">
                                              <p><b>Total produits :</b></p>
                                          </td>
                                          <td class="v-align-middle">
                                            <p><?php echo $detail_commande['total']; ?> TND</p>
                                          </td>
                          </tr>
                          @if($detail_commande->promo != 0)
                          <tr>
                                          <td class="v-align-middle semi-bold">
                                            
                                          </td>
                                          
                                          <td class="v-align-middle semi-bold">
                                            <p></p>
                                          </td>
                                         
                                          
                                         

                                          <td class="v-align-middle">
                                            <p></p>
                                          </td>

                                          

                                          <td class="v-align-middle">
                                              <p><b>Remise:</b></p>
                                          </td>
                                          <td class="v-align-middle"><b>
                                            - <?php echo $detail_commande['promo']; ?> TND</b>
                                          </td>
                          </tr>
                          @endif


                          @if($detail_commande->code_promo != "" && $detail_commande->code_promo != "/")
                            <tr>
                                          <td class="v-align-middle semi-bold">
                                            
                                          </td>
                                          
                                          <td class="v-align-middle semi-bold">
                                            <p></p>
                                          </td>
                                         
                                          
                                         

                                          <td class="v-align-middle">
                                            <p></p>
                                          </td>

                                          

                                          <td class="v-align-middle">
                                              <p><b>Code promo:</b></p>
                                          </td>
                                          <td class="v-align-middle"><b>
                                            <?php echo $detail_commande['code_promo']; ?></b>
                                          </td>
                          </tr>
                          @endif

                          <tr>
                                          <td class="v-align-middle semi-bold">
                                            
                                          </td>
                                          
                                          <td class="v-align-middle semi-bold">
                                            <p></p>
                                          </td>
                                         
                                          
                                         

                                          <td class="v-align-middle">
                                            <p></p>
                                          </td>

                                          

                                          <td class="v-align-middle">
                                              <p><b>Net à payé :</b></p>
                                          </td>
                                          <td class="v-align-middle">
                                            <p><?php echo $detail_commande['net']; ?> TND</p>
                                          </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              	<div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Adresse de facturation</h4>
                        
                        <p>
                        	<ul>
                                <li>Nom client :<?php echo $detail_commande['nomclient']; ?> </li>
                                <li>Adresse :<?php echo $detail_commande['adresse']; ?></li>
                                <li>Ville :<?php echo $detail_commande['ville']; ?></li>
                                <li>Région :<?php echo $detail_commande['region']; ?></li>
                                <li>Code postal: <?php echo $detail_commande['postal']; ?></li>
                                <li>Téléphone :<?php echo $detail_commande['tel']; ?></li>
                              </ul>
                         </p>
                      </div>
                    </div>
                  </div>
            </div>
            
<!-- Modal Edit -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier l'état de la commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Modifier_Etat')}}">
          <div class="form-group">
                        
                        <select name="etat" class="form-control">
                          <option disabled>Etat de commande</option>
                          <option value="Payé">Payé</option>
                          <option value="En cours">En cours</option>
                          <option value="Refusé">Refusé</option>
                        </select>
          </div>
          <div class="form-group">

            
            <input type="hidden" class="form-control" id="recipient-name" name="commande_id" value="">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Modifier</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--fin model-->

<!--script edit-->
<script>
  $(document).on("click", "#ForEdit", function () {
     var id = $(this).data('id');
     $(".modal-body #recipient-name").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>          
@endsection