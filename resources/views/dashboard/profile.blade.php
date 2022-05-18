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
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-top">
                      <img src="img/{{ Auth::user()->photo }}" class="img-sm rounded-circle mr-3" alt="image">
                      <div class="mb-0 flex-grow">
                        <h5 class="card-title mr-2 mb-2">{{ Auth::user()->name }}</h5>
                        <div class="d-flex align-items-center mr-4 text-muted font-weight-light">
                        <i class="mdi mdi-account-outline icon-sm mr-2"></i>
                        <span>
                          @if(Auth::user()->role == 1)
                            Admin
                          @endif

                          @if(Auth::user()->role == 2)
                            Fournisseur
                          @endif


                          @if(Auth::user()->role == 3)
                            Employeur
                          @endif
                        </span>
                      </div>
                      </div>
                      
                    </div>
                    <br><br>
                    
                    <form class="forms-sample" method="POST" action="{{url('modifier_Compte',Auth::user()->id)}}" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        


                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="photo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="{{ Auth::user()->photo }}" name="image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Modifier</button>
                          </span>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputName1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ Auth::user()->name }}" placeholder="{{ Auth::user()->name }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputCity1">Email</label>
                        <input type="email" class="form-control" id="exampleInputCity1" placeholder="{{ Auth::user()->email }}" value="{{ Auth::user()->email }}" name="email" disabled>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Téléphone</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" name="tel" value="{{ Auth::user()->tel }}" placeholder="{{ Auth::user()->tel }}">
                      </div>

                      @if(Auth::user()->role == 1)
                      <div class="form-group">
                        <label for="exampleTextarea1"></label>
                        <br>
                        <a type="button" class="" id="ForEdit" data-toggle="modal" data-target="#Edit" data-id="{{ Auth::user()->id }}">
                            <label class="badge badge-primary">
                              Changer votre mot de passe
                            </label>
                        </a>
                      </div>
                      @endif

                      <div class="form-group">
                        <label for="exampleInputPassword4">Cin</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" value="{{ Auth::user()->cin }}" name="cin" disabled>
                      </div>
                      
                      
                      
                      
                      @if(Auth::user()->role == 2)
                      <h1>Votre adresse :</h1><br>
                        
                          <div class="form-group">
                            <label>Région</label>
                            
                              <select class="form-control" name="region">
                                <option value="{{$fournisseur->region }}" selected>{{$fournisseur->region }}</option>
                                <option value="Bizerte">Bizerte</option>
                                                <option value="Tunis">Tunis</option>
                                                <option value="Ariana">Ariana</option>
                                                <option value="Manouba">Manouba</option>
                                                <option value="Ben Arous">Ben Arous</option>
                                                <option value="Zaghouan">Zaghouan</option>
                                                <option value="Nabeul">Nabeul</option>
                                                <option value="Jendouba">Jendouba</option>
                                                <option value="Béja">Béja</option>
                                                <option value="Le Kef">Le Kef</option>
                                                <option value="Siliana">Siliana</option>
                                                <option value="Sousse">Sousse</option>
                                                <option value="Monastir">Monastir</option>
                                                <option value="Mahdia">Mahdia</option>
                                                <option value="Kairouan">Kairouan</option>
                                                <option value="Kasserine">Kasserine</option>
                                                <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                <option value="Sfax">Sfax</option>
                                                <option value="Gabès">Gabès</option>
                                                <option value="Médenine">Médenine</option>
                                                <option value="Tataouine">Tataouine</option>
                                                <option value="Gafsa">Gafsa</option>
                                                <option value="Tozeur">Tozeur</option>
                                                <option value="Kébili">Kébili</option>

                              </select>
                            
                          </div>
                      
                        
                       
                          <div class="form-group">
                            <label>Ville</label>
                            
                              <input type="text" class="form-control" name="ville" value="{{$fournisseur->ville }}" />
                              
                            
                          </div>
                        
                        
                      


                      
                        
                          <div class="form-group">
                            <label>Adresse</label>
                            
                              <input type="text" class="form-control" name="adresse" value="{{$fournisseur->adresse }}" />
                            
                          </div>
                        
                        
                        
                          <div class="form-group">
                            <label>Code postale</label>
                            
                              <input type="text" class="form-control" name="postal" value="{{$fournisseur->postal }}" />
                              
                            
                          </div>
                        
                        
                      
                      @endif

                      
                      <br><br>
                      <center>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Modifier</button>
                      
                    </center>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>






<!-- Modal Edit -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Changer votre mot de passe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{ url('/Changer_mot_de_passe')}}">
          <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Actuel</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputMobile" name="old" value="" placeholder="Actuel mot de passe">
                        </div>
          </div>

          <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nouveau</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputMobile" name="new" value="" placeholder="Nouveau mot de passe">
                        </div>
          </div>

          <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nouveau</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputMobile" name="confirm" value="" placeholder="Nouveau mot de passe">
                        </div>
          </div>
          <div class="form-group">

            
            <input type="hidden" class="form-control" id="recipient-name" name="user_id" value="">
          </div>
        
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
  $(document).on("click", "#ForEdit", function () {
     var id = $(this).data('id');
     $(".modal-body #recipient-name").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

<script>
  $(document).on("click", "#ForEditImage", function () {
     var id = $(this).data('id');
     $(".modal-body #user").val( id );
});
</script>
@endsection