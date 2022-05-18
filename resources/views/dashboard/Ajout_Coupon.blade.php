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
            <h4 class="card-title">Ajouter code promo.</h4>
              <p class="card-description"></p>
                    <form id="addCouponForm" class="forms-sample" method="POST" action="{{ url('/AjoutCoupon')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Code</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Code promo" name="coupon_code">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Montant</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputEmail2" name="montant" placeholder="Montant">
                        </div>
                        
                      </div>
                      
                      <div class="form-group row">
                        <label for="exampleSelectGender" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                        <select class="form-control" id="exampleSelectGender"  name="type">
                          <option disabled>Choisissez le type de promotion</option>
                              <option value="pourcentage">Pourcentage</option>
                              <option value="fixe">Fixé</option>
                        </select>
                      </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date d'expiration</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="date" placeholder="dd/mm/yyyy">
                        </div>
                        
                      </div>


                      <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="0" name="status"> Désactivé </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="1" name="status" checked> Activé </label>
                            </div>
                      </div>

                      <button type="submit" class="btn btn-gradient-primary mr-2">Ajouter</button>
                      <button class="btn btn-light" type="reset">Annuler</button>
                    </form>
                  </div>
                </div>
</div>
<div class="col-3">
  
</div>
</div>
@endsection