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
          <i class="mdi mdi-plus btn-icon-prepend"></i> Ajouter une vacance
        </button>

      
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
    <form method="get" action="{{ url('/Vancance/Recherche/Mois')}}">
        <div class="form-group">
          <div class="input-group">
            <select class="form-control" name="month">
                  <option value="0">Chercher congé par mois</option>
                  <option value="01">Janvier</option>
                  <option value="02">Février</option>
                  <option value="03">Mars</option>
                  <option value="04">Avril</option>
                  <option value="05">Mai</option>
                  <option value="06">Juin</option>
                  <option value="07">Juillet</option>
                  <option value="08">Aout</option>
                  <option value="09">Septembre</option>
                  <option value="10">Octobre</option>
                  <option value="11">Novembre</option>
                  <option value="12">Décembre</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
  </div>
  <div class="col-lg-4">
      <form method="get" action="{{ url('/Vacance/Recherche')}}">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Chercher un congé" aria-label="Recipient's username" aria-describedby="basic-addon2" name="recherche">
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="button"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>
<br>
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
                            
                        <th>Date</th>
                        <th>Employeur</th>
                        <th>De</th>
                        <th>À</th>
                        <th>Note</th>
                        @if(Auth::user()->role == 1)
                        <th>Actions</th>
                        @endif
                          </tr>
                        </thead>
                        <tbody>
                          @if($vacance != NULL)
                          @foreach($vacance as $row)
                          <tr>
                            <td>
                              {{ $row->date }}
                            </td>
                            <td>
                              {{ $row->emp_nom }}
                            </td>

                            

                            <td>
                            {{ $row->de }}  
                            </td>

                            <td>
                              
                              {{ $row->a }}
                            </td>
                             <td>
                               {{ $row->note }}
                             </td>
                          <td>
                            @if(Auth::user()->role == 1)
                              <button type="button" class="btn btn-dark btn-rounded btn-icon" id="ForEdit" title="Modifier" data-toggle="modal" data-target="#Edit" title="Modifier" data-id="{{ $row->id }}" data-emp="{{ $row->emp_nom }}" data-date="{{ $row->date }}" data-de="{{ $row->de }}" data-a="{{ $row->a }}" data-note="{{ $row->note}}">
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
                    {{ $vacance->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
</div>

<!-- Modal Supprimer-->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette vacance ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Vacance/Supprimer')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="vacance_id" value="">
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une vacance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('/Congés/AjouterVacance')}}">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-sm-6">
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
            </div>
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Date</label>
              <div class="col-sm-9">
                <input type="date" name="date" class="form-control">
              </div>
            </div>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">De</label>
              <div class="col-sm-9">
                <input type="date" name="de" class="form-control">
              </div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">À</label>
              <div class="col-sm-9">
                <input type="date" name="a" class="form-control">
              </div>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Note</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="6" name="note" cols="10">
                  
                </textarea>
              </div>
            </div>
            </div>
            <div class="col-sm-6">
            
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier le congé</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('/Vacance/Modifier')}}">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Employeur</label>
              <div class="col-sm-9">
                <input type="text" name="employeur" class="form-control" value="" id="emp" disabled>
              </div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Date</label>
              <div class="col-sm-9">
                <input type="date" name="date" id="date" class="form-control">
              </div>
            </div>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">De</label>
              <div class="col-sm-9">
                <input type="date" name="de" id="de" value="" class="form-control">
              </div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">À</label>
              <div class="col-sm-9">
                <input type="date" name="a" id="a" value="" class="form-control">
              </div>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Note</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="6" id="note" name="note" cols="10">
                  
                </textarea>
              </div>
            </div>
            </div>
            <div class="col-sm-6">
            
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
     var employeur=$(this).data('emp');
     var date=$(this).data('date');
     var de=$(this).data('de');
     var a=$(this).data('a');
     var id=$(this).data('id');
     var note=$(this).data('note');
     
     $(".modal-body #emp").val( employeur );
     $(".modal-body #date").val( date );
     $(".modal-body #de").val( de );
     $(".modal-body #a").val(a);
     $(".modal-body #id").val( id );
     $(".modal-body #note").val( note );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@endsection