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
<div class="col-3">
  
</div> 
<div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-description"> </p>
                    <form method="POST" action="{{ url('/add-image',$productDetails->id)}}" enctype="multipart/form-data">
                    	{{ csrf_field() }}                                            
                      <input type="hidden" name="prod_id" value="{{ $productDetails->id }}">
                      
                      
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nom produit</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" value="{{ $productDetails->nom }}" name="nom" placeholder="Nom produit" disabled>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Code Produit</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ $productDetails->code }}" name="code" placeholder="Code de produit" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                          
                        <input type="file" name="images" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Choisir plusieur image pour votre produit">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                          </span>
                        </div>
                      
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2">Ajouter</button>
                      <button class="btn btn-light" type="reset">Annuler</button>
                    </form>
                  </div>
                </div>
</div>

</div>


<!--voir image-->
@if(sizeof($images) > 0)
<div class="row">
@foreach($images as $row)
<div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title"></h4></center>
                    <div class="media">
                      
                      <div class="media-body">
                        <center>
                          <img src='{{URL::asset("img/produit/s/$row->image")}}'><br><br><br>
                          <a href="{{ url('/Supprimer_image',$row->id)}}">
                          <button type="button" class="btn btn-gradient-primary mr-2">
                            <i class="mdi mdi-delete"></i>
                          </button></a>

                        
                        </center>
                      </div>


                    </div>
                  </div>
                </div>
</div>
@endforeach
</div>
@endif
@endsection