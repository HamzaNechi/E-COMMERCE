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
      <a href="{{ url('/Ajout_Fournisseur')}}">
        @if(Auth::user()->role == 1)
        <button class="btn btn-primary btn-icon-text">
          <i class="mdi mdi-account-multiple-plus btn-icon-prepend"></i> Ajouter fournisseur
        </button>
        @endif

      </a>
    </div>
    <div class="col-4"></div>
    <div class="col-4">
      
  </div>
</div>
<br>
<!----------->
<div class="row">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
    
  </div>
  <div class="col-lg-4">
      <form method="get" action="{{ url('/search_F')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher un fournisseur" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="button"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
  </form>
  </div>
</div>
<!----------->
<div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Photo</th>
                        <th>Nom</th>    
                        
                        <th>Email</th>
                        <th>Téléphone</th>
                        
                        <th>Matricule fiscale</th>
                        <th>Actions</th>
                        
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($supplier as $row)
                          @if($row->role == 2)
                          <tr>

                            <td>
                              <img src="img/{{ $row->photo}}" alt="image" class="mr-2" alt="image">
                            </td>


                            <td>
                              {{ $row->name }}
                            </td>

                            
                            
                          <td> {{ $row->email }} </td>
                          <td>{{ $row->tel }}</td>
                          
                          <td>
                            @foreach($fournisseur as $fr)
                            @if($fr->id_user == $row->id)
                              {{ $fr->matricule }}
                            @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach($fournisseur as $frr)
                            @if($frr->id_user == $row->id)
                            <button type="button" class="btn btn-warning btn-rounded btn-icon" title="Voir détail" data-toggle="modal" data-target="#exampleModal" data-adresse="{{ $frr->adresse }}" data-ville="{{ $frr->ville }}" data-region="{{ $frr->region }}" data-postal="{{ $frr->postal }}" id="detail">
                            <i class="mdi mdi-eye"></i>
                            </button>
                            @endif
                            @endforeach

                            @if(Auth::user()->role==1)
                              <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>
                            @endif
                          </td>
                          
                          </tr>
                          @endif
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    {{ $supplier->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>



<!-- Modal de détail -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Détail de la fournisseur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <li id="adresse"><b>Adresse :</b>Rue hammadi boussa</li>
          <li id="ville"><b>Ville :</b>Tazarka</li>
          <li id="region"><b>Région :</b>Nabeul</li>
          <li id="postal"><b>Code postale :</b>8024</li>
        </ul>
      </div>
      
    </div>
  </div>
</div>
<!--end model détail-->
<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cet fournisseur ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('Fournisseur/supprimer')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="id" value="">
            <input type="hidden" name="type" value="fournisseur">
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
$(document).on("click", "#ForDelete", function () {
     var id = $(this).data('fourni');
     $(".modal-body #recipient-name").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>


<script>
$(document).on("click", "#detail", function () {
     var adresse = $(this).data('adresse');
     var ville = $(this).data('ville');
     var region = $(this).data('region');
     var postal = $(this).data('postal');
     $(".modal-body #adresse").html( "<b>Adresse :</b>"+adresse );
     $(".modal-body #ville").html( "<b>Ville :</b>"+ville );
     $(".modal-body #region").html("<b>Région :</b>"+region);
     $(".modal-body #postal").html("<b>Code postale :</b>"+);
});
</script> 
@endsection