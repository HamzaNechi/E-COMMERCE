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

    
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier catégorie.</h4>
                    <p class="card-description"> Accés admin . </p>
                    <form class="forms-sample" method="POST" action="{{ url('/Modifier',$categorie->id) }}" enctype="multipart/form-data">
                      {{ csrf_field() }} 
                      <div class="form-group">
                        <label for="exampleInputName1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Nom de la catégorie" name="nom" value="{{ $categorie->nom}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Level</label>
                        <select name="parent_id" class="form-control" id="exampleSelectGender" value="{{ $categorie->parent_id }}">
                          <option value="0">Catégorie principale</option>
                          @foreach($level as $row)
                              <option value="{{ $row->id }}">{{ $row->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Url</label>
                        <input type="text" name="url" class="form-control" id="exampleInputEmail3" placeholder="URL" value="{{ $categorie->url }}">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="exampleTextarea1" rows="4">
                          {{ $categorie->description }}
                        </textarea>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Modifier</button>

                      <button type="reset" class="btn btn-light">Annuler</button>
                    </form>
                  </div>
                </div>
</div>
@endsection