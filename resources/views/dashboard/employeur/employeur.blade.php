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
      <a href="{{ url('/AjouterEmployer')}}">
        <!--<label class="badge badge-primary">Ajouter employeur</label>-->
        @if(Auth::user()->role == 1)
        <button class="btn btn-primary btn-icon-text">
          <i class="mdi mdi-account-multiple-plus btn-icon-prepend"></i> Ajouter employeur
        </button>
        @endif

      </a>
    </div>
    <div class="col-4"></div>
    <div class="col-4">
      
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
  </div>
  <div class="col-lg-4">
      
      <form method="get" action="{{ url('/Employeur/Recherche')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher un employeur" name="nom">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="button"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
 </div>
</div>
<br>
<div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title">
                      
                    </h1>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                        <th>Nom</th>
                        <th>Image</th>
                        <th>CIN</th>
                        <th>Utilisateur</th>
                        <th>Téléphone</th>
                        <th>Salaire</th>
                        @if(Auth::user()->role == 1)
                        <th>Mot de passe</th>
                        @endif

                        @if(Auth::user()->role == 1)
                        <th>Actions</th>
                        @endif
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($employeur as $em)
                          <tr>
                            <td>
                              {{ $em->nom }}
                            </td>
                            <td>
                            <img src='{{ asset("img/$em->image") }}' alt="image" class="mr-2" alt="image">
                          </td>
                          <td> {{ $em->cin }} </td>
                          <td>
                            @if($em->id_user > 0)
                            <label class="badge badge-info">Oui</label>
                            @else
                            <label class="badge badge-dark">Non</label>
                            @endif
                          </td>
                          <td>{{ $em->tel }}</td>
                          <td>{{ $em->salaire }} TND</td>
                          @if(Auth::user()->role == 1)
                          <td>
                            @if($em->id_user > 0)
                              {{ $em->password }}
                            @else
                              N/O
                            @endif
                          </td>
                          @endif


                          @if(Auth::user()->role == 1)
                          <td>
                            
                            <a href="{{ url('/Employeur/Modifier',$em->id)}}">
                              <button type="button" class="btn btn-dark btn-rounded btn-icon" title="Modifier">
                                <i class="mdi mdi-pencil"></i>
                              </button>
                            </a>
                            
                              <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $em->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>
                            
                          </td>
                          @endif
                          </tr>
                          @endforeach
                          
                          
                        </tbody>
                      </table>
                    </div>
                    {{ $employeur->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cet employeur ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Employeur/Supprimer')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="employeur" value="">
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
@endsection