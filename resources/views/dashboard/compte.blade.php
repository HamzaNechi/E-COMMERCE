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


<!----------->
<div class="row">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-3">
          
  </div>
  <div class="col-lg-4">
      <form method="get" action="{{ url('/search_C')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher un compte" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="button"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
  </div>

  <div class="col-lg-2" style="text-align: right;">
    <div class="btn-group-vertical" role="group" aria-label="Basic example">
          <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Ajouter</button>
            <div class="dropdown-menu">
              <a class="dropdown-item" title="Ajouter employeur" href="{{ url('/AjouterEmployer')}}">Employeur</a>
              <a class="dropdown-item" title="Télécharger" href="{{ url('/Ajout_Fournisseur')}}">Fournisseur</a>
            </div>
          </div>
                                
        </div>
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
                            
                        
                        <th>Nom</th>
                        <th>Image</th>
                        <th>Téléphone</th>
                        <th>CIN</th>
                        <th>Email</th>
                        <th>Mot de passe</th>
                        
                        <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user as $row)
                          
                          <tr>
                            
                            <td>
                            {{ $row->name }}
                          </td>

                          <td>
                              <img src="img/{{ $row->photo}}" alt="image" class="mr-2" alt="image">
                            </td>

                            <td>{{ $row->tel }}</td>
                            <td>{{ $row->cin }}</td>
                          <td> {{ $row->email }} </td>
                          <td>@if($row->role == 2)
                                @foreach($fournisseur as $fr)
                                  @if($fr->id_user == $row->id)
                                   {{ $fr->pass }}
                                  @endif
                                @endforeach
                              @endif 
                            @if($row->role == 1) Admin @endif
                            @if($row->role == 3)
                              @foreach($employeur as $emp)
                                @if($emp->id_user == $row->id)
                                  {{ $emp->password }}
                                @endif
                              @endforeach
                            @endif 
                          </td>
                          
                          <td>
                            @if($row->role == 2)
                              <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" data-type="fournisseur" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>
                            @endif

                            @if($row->role == 3)
                              <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" data-type="employeur" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>
                            @endif
                          </td>
                          </tr>
                          
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    {{ $user->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer ce compte ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('Fournisseur/supprimer')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="id" value="">
            <input type="hidden" class="form-control" id="type" name="type" value="">
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
     var type=$(this).data('type');
     $(".modal-body #recipient-name").val( id );
     $(".modal-body #type").val(type);
});
</script>
@endsection