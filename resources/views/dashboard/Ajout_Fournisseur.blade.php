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
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form id="example-form" method="POST" action="{{ url('/Ajout-F') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div>
                        <h3>Boutique</h3>
                        <section>
                          <div class="form-group">
                            <label for="userName">Matricule fiscale *</label>
                            <input type="text" class="form-control required" placeholder="Matricule fiscale" name="matricule">
                          </div>
                          <div class="form-group">
                            <label for="ville">Ville *</label>
                            <input type="text" class="form-control required" id="exampleInputEmail2" name="ville" placeholder="Ville">
                          </div>
                          <div class="form-group">
                            <label for="add">Adresse *</label>
                            <input type="text" class="form-control required" id="exampleInputUsername2" placeholder="Adresse" name="adresse">
                          </div>

                          <div class="form-group">
                            <label for="add">Région *</label>
                            <select class="form-control required" id="exampleSelectGender" name="region">
                              <option>Nabeul</option>
                              <option>Gafssa</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="add">Code postale *</label>
                            <input type="text" class="form-control required" id="exampleInputPassword2" placeholder="Code postal" name="postal">
                          </div>

                          <div class="form-group">
                            <label for="add">Logo *</label>
                            <input type="file" name="photo" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Logo de votre entreprise">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                                </span>
                              </div>
                          </div>
                        </section>

                        <h3>Compte</h3>
                        <section>
                          <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="exampleInputUsername2">Nom *</label>
                            
                              <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Nom fournisseur" name="name">
                            
                            @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                          </div>
                          <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail2">Email</label>
                            
                              <input type="email" class="form-control" id="exampleInputEmail2" name="email" value="{{ old('email') }}" placeholder="Email">
                            
                            @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail2">Téléphone *</label>
                            
                              <input type="text" class="form-control required" id="exampleInputEmail2" name="tel" placeholder="Téléphone">
                          </div>


                          <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail2">Mot de passe</label>
                              <div class="input-group">
                              <input type="text" class="form-control" placeholder="Mot de passe" aria-label="Recipient's username" aria-describedby="basic-addon2" name="password" id="password">
                              <div class="input-group-append">
                                <button class="btn btn-sm btn-gradient-primary" type="button" id="generate" onclick="generatePassword()"><i class="mdi mdi-sync"></i></button>
                              </div>
                              </div>
                              @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                            @endif
                          </div>


                          <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="exampleInputConfirmPassword2">Confirmer Mot de passe</label>
                            
                              <input type="text" class="form-control" name="password_confirmation" placeholder="Confirmer Mot de passe" id="confirmed">
                            
                            @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail2">CIN</label>
                              <input type="text" class="form-control" id="exampleInputEmail2" name="cin" placeholder="CIN" required>
                          </div>
                        </section>
                        
                      </div>
                      <button type="submit" style="display:none;" id="submitForm" class="btn btn-gradient-primary mr-2">Ajouter</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

<script type="text/javascript">
  function generatePassword(){
    data='AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn123456789/*)(-+';
    mdp='';
    
   for(let i=0; i<8 ;i++){
    n=Math.floor(Math.random() * data.length+1);
      mdp = mdp.concat(data.charAt(n));
    }
    document.getElementById('password').value=mdp;
    document.getElementById('confirmed').value=mdp;
  }
</script>

@endsection