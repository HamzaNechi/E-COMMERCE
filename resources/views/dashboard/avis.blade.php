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
  <div class="col-lg-4">
  </div>
  <div class="col-lg-2">
  </div>
  <div class="col-lg-4">
      <form method="get" action="{{ url('/avisduproduit')}}">
        <div class="form-group">
          <div class="input-group">
            <select class="form-control" id="exampleSelectGender"  name="id_produit">
              @foreach($produit as $val)
              <option value="{{ $val->id }}">{{ $val->nom }}</option>
              @endforeach
            </select>
            <div class="input-group-append">
              <button class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
            </div>
          </div>
        </div>
      </form>
  </div>

  <div class="col-lg-2">
    <a title="Supprimer multiples" href="javascript:;" onclick="document.getElementById('ForDeleteAll').submit();">
    <button class="btn btn-primary btn-fw">Supprimer</button></a>
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
                            <th>#</th>

                            <th> Nom </th>
                          <th> Email </th>
                          
                          <th>Avis</th>
                          <th>Produit</th>
                          <th>Affichage</th>
                          <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <form method="get" id="ForDeleteAll" action="{{ url('/suppressionavismultiples')}}">
                          @foreach($avis as $row)
                          <tr>
                            <td>
                             <input type="checkbox" name="all[]" value="{{ $row->id }}">
                           </td>
                          <td> {{ $row->nom }} </td>
                          <td> {{ $row->email }} </td>
                          
                          <td>
                            @for($i=0 ; $i < $row->etoile ; $i++)
                           
                                <img src="{{URL::asset('assets/images/dashboard/etoile.png')}}" width="15px" height="15px">
                              
                            @endfor

                            @for($i=0 ; $i < 5-$row->etoile ; $i++)
                            <img src="{{URL::asset('assets/images/dashboard/etoile_gray.png')}}" width="15px" height="15px">
                            @endfor
                          </td>

                          <td>
                            @foreach($produit as $p)
                              @if($row->id_produit == $p->id)
                                {{ $p->nom }}
                              @endif
                            @endforeach
                          </td>

                          <td>
                        
                              @if($row->status == 0)
                              <a href="{{ url('/modifierstatusavis/1',$row->id)}}">
                              
                              <label class="badge badge-dark"><i class="mdi mdi-eye-off"></i></label>
                              </a>
                              @else
                              <a href="{{ url('/modifierstatusavis/0',$row->id)}}">
                                <label class="badge badge-info"><i class="mdi mdi-eye"></i></label>
                              </a>
                              @endif
                          </td>
                          
                          <td>
                            
                           

                          

        
                          <button type="button" class="btn btn-warning btn-rounded btn-icon" title="Voir commentaire" data-toggle="modal" data-target="#exampleModalCenter" data-comment="{{ $row->note }}" data-name="{{ $row->nom }}" id="note">
                            <i class="mdi mdi-eye"></i>
                          </button>
                        

                          <button type="button" id="ForDelete"class="btn btn-danger btn-rounded btn-icon" data-toggle="modal" data-target="#Delete" data-fourni="{{ $row->id }}" title="Supprimer"><i class="mdi mdi-delete"></i>
                              </button>

                          
                          
                        
                          </td>
                        </tr>
                          @endforeach
                          </form>
                        </tbody>
                      </table>
                    </div>
                    {{ $avis->links('vendor.pagination.dashboard-paginator') }}
                  </div>
                </div>
              </div>
            </div>



<!----Modal view text---->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="comment">
        
      </div>
      
    </div>
  </div>
</div>
<!-----end model view text--->


<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sur de supprimer cette avis ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/supprimerunavis')}}">
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="recipient-name" name="avis" value="">
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
});



$(document).on("click", "#note", function () {
     var note = $(this).data('comment');
     var nom = $(this).data('name');
     $("#comment").html(note);
     $("#exampleModalLongTitle").html("Commentaire de "+nom);
});
</script>
@endsection