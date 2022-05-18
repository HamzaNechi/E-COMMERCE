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
                    <form method="POST" action="{{ url('/Modifier_attribut',$attribut->id)}}" enctype="multipart/form-data">
                      {{ csrf_field() }}                                            
                                                                  
                      
                      
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Sku</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" name="sku" value="{{ $attribut->sku }}" placeholder="Sku">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Quantité</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="stock" value="{{ $attribut->stock }}" placeholder="Quantité">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Taille</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="taille" value="{{ $attribut->taille }}" placeholder="Taille">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Prix</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" name="prix" value="{{ $attribut->prix_at }}" placeholder="Prix">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Prix en gros</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" name="prix_gros" value="{{ $attribut->prix_gros }}" placeholder="Prix en gros">
                        </div>
                      </div>


                      
                      
                      <button type="submit" class="btn btn-gradient-primary mr-2">Modifier</button>
                      <button class="btn btn-light" type="reset">Annuler</button>
                    </form>
                  </div>
                </div>
              </div>

</div>
@endsection