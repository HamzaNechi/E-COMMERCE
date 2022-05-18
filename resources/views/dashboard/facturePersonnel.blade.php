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
    <div class="col-4">
      <a href="{{ url('/Personnaliser/Facture')}}">
        <button class="btn btn-primary btn-icon-text" title="Ajouter une facture">
          <i class="mdi mdi-plus btn-icon-prepend"></i> Ajouter une facture
        </button>
      </a>
      
    </div>
    <div class="col-4"></div>
    <div class="col-4">
      
  </div>
</div>
<br>

<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-3">
  </div>
  <div class="col-lg-4">
      
      <form method="get" action="{{ url('/Rechercher_facture_personnel')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher une facture" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="button"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
      

     
      
  </div>

  <div class="col-lg-2">
    <div class="btn-group-vertical" role="group" aria-label="Basic example">
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Actions</button>
      <div class="dropdown-menu">
      <a class="dropdown-item" title="Supprimer multiples" href="javascript:;" onclick="document.getElementById('ForDeleteAll').submit();">Supprimer</a>
      <a class="dropdown-item" title="Télécharger" href="{{ url('/Exporter/Facture')}}">Télécharger pdf</a>
      </div>
    </div>
    </div>
  </div>
</div>
<br>
<!---------->

<div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="table-responsive">
                      <form id="ForDeleteAll" method="get" action="{{ url('/Sélection/Supprimmer')}}">
                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Client</th>
                          <th>Date</th>
                          <th>Méthode</th>
                          
                          <th>Net à payé</th>
                          
                          <th>Montant TTC</th>
                          <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @foreach($facture as $row)
                          <tr>
                           
                      

                      <td>
                        <input type="checkbox" name="all[]" value="{{ $row->id }}">
                      </td>
                      
                      <td>
                        {{ $row->client }}
                      </td>
                     
                      
                     

                      <td>
                        {{ $row->date }}
                      </td>

                      

                      <td>
                          
                          @if($row->methode == "Par tranche")
                          <label class="badge badge-info">Par tranche</label>
                          @if($row->net > 0)
                          <a type="button" class="" id="ForEdit" data-toggle="modal" data-target="#Edit" data-id="{{ $row->id }}" data-tranche="{{ $row->tranche }}" data-net="{{ $row->net }}" title="Changer l'état"><label class="badge badge-dark"><i class="mdi mdi-pencil"></i></label></a>
                          @endif
                          @endif

                          @if($row->methode == "Comptant")
                          <label class="badge badge-dark">Comptant</label>
                          @endif
                      </td>
                      
                      <td>
                        
                        @if($row->net > 0)
                          {{ $row->net }} TND
                        @else
                        <label class="badge badge-success">Payé</label>
                        @endif
                      </td>
                      
                      
                      <td>
                        {{ $row->total_ttc }} TND
                      </td>
                      <td>
                        
                          <a href="{{ url('/Facture/Personnel',$row->id)}}"><button type="button" class="btn btn-warning btn-rounded btn-icon" title="Voir facture">
                            <i class="mdi mdi-eye"></i>
                          </button></a>

                        
                        <a href="{{ url('/Personnaliser/ModifierFacture',$row->id)}}">
                          <button type="button" class="btn btn-dark btn-rounded btn-icon" title="Modifier">
                            <i class="mdi mdi-pencil"></i>
                          </button>
                        </a>
                        

                        
                      @if(Auth::user()->role == 1)
                          <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                        </button>
                      @endif 


                      </td>
                        </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </form>
                    </div>
                    {{ $facture->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette facture ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Supprimer_facture')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="facture_id" value="">
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

<!-- Modal Edit -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payé une autre tranche</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Paiement')}}">

          <div class="form-group">
            <label>Montant payé</label>
            <input type="text" class="form-control" name="" id="tranche" value="" disabled>
          </div>

          <div class="form-group">
            <label>Net à payé</label>
            <input type="text" class="form-control" name="" id="net" value="" disabled>
          </div>

          <div class="form-group">
            <label>Montant à payé</label>
            <input type="text" class="form-control" placeholder="Tranche à payé" name="tranche">
          </div>
          <div class="form-group">

            
            <input type="hidden" class="form-control" id="recipient-name" name="facture_id" value="">
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

<script>
  $(document).on("click", "#ForDelete", function () {
     var id = $(this).data('fourni');
     $(".modal-body #recipient-name").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

<!--script edit-->
<script>
  $(document).on("click", "#ForEdit", function () {
     var id = $(this).data('id');
     var tranche= $(this).data('tranche');
     var net= $(this).data('net');
     $(".modal-body #recipient-name").val( id );
     $(".modal-body #tranche").val( tranche );
     $(".modal-body #net").val( net );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@endsection