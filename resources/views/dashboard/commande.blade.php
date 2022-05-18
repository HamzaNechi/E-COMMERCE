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
    <div class="col-12">
      <a href="{{ url('/AjoutCommande')}}">
        @if(Auth::user()->role == 1)
        <button class="btn btn-primary btn-icon-text">
          <i class="mdi mdi-account-multiple-plus btn-icon-prepend"></i> Ajouter une commande
        </button>
        @endif

      </a>
    </div>
    <div class="col-2"></div>
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
    <form method="get" action="{{ url('/Rechercher_commande')}}">
     <div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control form-control-sm" placeholder="Chercher une commande" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
        <div class="input-group-append">
          <button class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
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
          <a class="dropdown-item" title="Télécharger" href="{{ url('/Exporter/Commandes')}}">Télécharger pdf</a>
        </div>
      </div>
                            
    </div>
  </div>
</div>
<br> 
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
        </h4>
        <div class="table-responsive">
          <form method="post" id="ForDeleteAll" action="{{ url('/Effacer/Tous')}}">
          {{ csrf_field() }}
          <table class="table">
            <thead>
            <th>#</th>
            <th>Nom de client</th>
            <th></th>
            <th>Téléphone</th>
            <th></th>
            <th>Net à payé</th>
            <th></th>
            <th>État</th>
            <th></th>
            <th>Code</th>
            <th></th>
            <th>Actions</th>
            </tr>
          </thead>
                        
                        <tbody>
                          @foreach($commande as $key)
                          <tr>
                           <td>
                             <input type="checkbox" name="all[]" value="{{ $key->id }}">
                           </td>
                      

                      <td>
                        {{ $key->nomclient }}
                      </td>
                      
                      <td>
                        
                      </td>
                     
                      
                     

                      <td>
                        {{ $key->tel }}
                      </td>

                      

                      <td>
                          
                      </td>
                      <td>
                        {{ $key->net }}
                      </td>

                      
                      <td>
                        
                      </td>

                      <td>
                        @if($key->etat == "Payé")
                          <label class="badge badge-success">Payé</label>&nbsp &nbsp &nbsp &nbsp
                        @endif
                        @if($key->etat == "En cours")
                          <label class="badge badge-warning">En cours</label>
                        @endif
                        @if($key->etat == "Refusé")
                          <label class="badge badge-danger">Refusé</label>&nbsp &nbsp
                        @endif
                        @if($key->etat == "Annuler")
                          <label class="badge badge-info">Annuler</label>&nbsp &nbsp
                        @endif
                            
                        
                          @if($key->etat == "En cours")
                          <a type="button" class="" id="ForEdit" data-toggle="modal" data-target="#Edit" data-id="{{ $key->id }}" title="Changer l'état"><label class="badge badge-dark"><i class="mdi mdi-pencil"></i></label></a>
                          @endif
                      </td>
                      <td></td>
                      <td>{{ $key->code_commande }}</td>
                      <td></td>
                      <td>
                        
                          <a href="{{ url('/Detail_commande',$key->id)}}"><button type="button" class="btn btn-warning btn-rounded btn-icon" title="Voir détail">
                            <i class="mdi mdi-eye"></i>
                          </button></a>

                          <a href="{{ url('/Facture',$key->id)}}"><button type="button" class="btn btn-info btn-rounded btn-icon" title="Ajouter facture">
                            <i class="mdi mdi-note-plus"></i>
                          </button></a>

                          <a href="{{ url('/Commande/Modification',$key->id)}}">
                          <button type="button" class="btn btn-dark btn-rounded btn-icon" title="Modifier">
                            <i class="mdi mdi-pencil"></i>
                          </button>
                          </a>
                          @if(Auth::user()->role == 1)
                          <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $key->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                        </button>
                        @endif



                      </td>
                        </tr>
                          @endforeach
                        </tbody>
                      </table>
                      </form>
                    </div>
                    {{ $commande->links('vendor.pagination.dashboard-paginator') }}
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

<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cet commande ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Supprimer_commande')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="commande_id" value="">
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

<!--script delet-->
<script>
  $(document).on("click", "#ForDelete", function () {
     var id = $(this).data('fourni');
     $(".modal-body #recipient-name").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@endsection