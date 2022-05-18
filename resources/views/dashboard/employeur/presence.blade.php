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
      
        <button class="btn btn-primary btn-icon-text" id="ForAdd"  data-toggle="modal" data-target="#Add" title="Ajouter une présence">
          <i class="mdi mdi-plus btn-icon-prepend"></i> Ajouter une présence
        </button>

      
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
    <form method="get" action="{{ url('/Presence/Recherche/Date')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="date" class="form-control form-control-sm"  name="date">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
  </div>
  <div class="col-lg-4">
      <form method="get" action="{{ url('/Presence/Recherche')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher une présence" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
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
                    <h4 class="card-title"></h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                        <th>Date</th>
                        <th>Employeur</th>
                        <th>Enregistrement</th>
                        <th>Vérifier</th>
                        <th>Statut</th>
                        <th>Responssable</th>
                        @if(Auth::user()->role == 1)
                        <th>Actions</th>
                        @endif
                          </tr>
                        </thead>
                        <tbody>
                          @if($presence != NULL)
                          @foreach($presence as $row)
                          <tr>
                            <td>
                              {{ $row->date }}
                            </td>
                            <td>
                              {{ $row->employeur }}
                            </td>

                            <td>  
                              {{ $row->enregistrement }}
                            </td>

                            <td>
                            {{ $row->verifier }}  
                            </td>

                            <td>
                              
                              @if($row->statut == "Présent(e)")
                              <label class="badge badge-success">{{ $row->statut }}</label>
                              @endif

                              @if($row->statut == "Abssent(e)")
                              <label class="badge badge-danger">{{ $row->statut }}</label>
                              @endif
                            </td>
                             <td>
                               {{ $row->responsable }}
                             </td>
                          <td>
                            @if(Auth::user()->role == 1)
                              <button type="button" class="btn btn-dark btn-rounded btn-icon" id="ForEdit" title="Modifier" data-toggle="modal" data-target="#Edit" data-id="{{ $row->id }}" data-employeur="{{ $row->employeur }}" data-date="{{ $row->date }}" data-enreg="{{ $row->enregistrement }}" data-verifier="{{ $row->verifier }}" title="Supprimer">
                                <i class="mdi mdi-pencil"></i>
                              </button>
                            
                            
                            
                              <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>
                            @endif

                          </td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                      </table>

                      

                    </div>
                    <br>
                    {{ $presence->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>

<!-- Modal Supprimer-->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette présence ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Presence/Supprimer')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="present_id" value="">
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


<!-- Modal Ajouter -->
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une présence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('/employeur/Presence')}}">
          {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employeur</label>
            <div class="col-sm-9">
              <select class="form-control" name="id_emp">
                @foreach($employeur as $emp)
                <option value="{{ $emp->id }}">{{ $emp->nom }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
              <input type="date" name="date" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Enregistrement</label>
            <div class="col-sm-9">
              <input type="time" name="arrive" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Vérifier</label>
            <div class="col-sm-9">
              <input type="time" name="sort" class="form-control">
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--fin model-->

<!-- Modal Modifier -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier la présence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('/Presence/Modifier')}}">
          {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employeur</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="employeur" id="employeur" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
              <input type="text" name="date" id="date" class="form-control" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Enregistrement</label>
            <div class="col-sm-9">
              <input type="time" name="arrive" id="enreg" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Vérifier</label>
            <div class="col-sm-9">
              <input type="time" name="sort" id="verifier" class="form-control">
            </div>
          </div>

          <input type="hidden" name="id" id="id" value="">
        
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

<script>
$(document).on("click", "#ForEdit", function () {
     var id = $(this).data('id');
     var employeur=$(this).data('employeur');
     var date=$(this).data('date');
     var enreg=$(this).data('enreg');
     var verifier=$(this).data('verifier');
     var id=$(this).data('id');
     
     $(".modal-body #employeur").val( employeur );
     $(".modal-body #date").val( date );
     $(".modal-body #enreg").val( enreg );
     $(".modal-body #verifier").val( verifier );
     $(".modal-body #id").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@endsection