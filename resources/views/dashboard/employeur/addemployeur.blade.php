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
<div class="col-lg-12">
                <div class="card">
                  <div class="card-body">

                    
                    
                    <div class="nav-scroller">
                      <ul class="nav nav-tabs tickets-tab-switch" role="tablist">

                        <li class="nav-item">
                          <a class="nav-link rounded active" id="open-tab" data-toggle="tab" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="true">Profile<div class="badge"><i class="mdi mdi-account-off"></i></div></a>
                        </li>
                        <li class="nav-item">
                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link rounded" id="pending-tab" data-toggle="tab" href="#pending-tickets" role="tab" aria-controls="pending-tickets" aria-selected="false">Compte<div class="badge"><i class="mdi mdi-account"></i></div></a>
                        </li>
                        
                      </ul>
                    </div>
                    <form id="addEmployeeForm" class="form-sample" method="post" action="{{ url('/AjouterEmployer')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="tab-content border-0 tab-content-basic">
                      <div class="tab-pane fade show active" id="open-tickets" role="tabpanel" aria-labelledby="open-tickets">
                        <div class="tickets-date-group">Si tu veux lui donner l'accès à ce tableaux de bord << Cliquez sur compte >></div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nom</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" placeholder="Nom et prénom" name="nom" />

                                  @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Adresse</label>
                                <div class="col-sm-9">
                                  <input class="form-control" placeholder="Adresse" name="adresse" />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cin</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" placeholder="Cin" name="cin" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Salaire</label>
                                <div class="col-sm-9">
                                  <input class="form-control" placeholder="Salaire" name="salaire" />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Téléphone</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" placeholder="Téléphone" name="tel" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Photo</label>
                                <div class="col-sm-9">
                                  <input type="file" name="photo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Image de l'employeur">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                                  </span>
                                </div>
                                    </div>
                                  </div>
                            </div>
                          </div>


                          
                      </div>


                      <div class="tab-pane fade" id="pending-tickets" role="tabpanel" aria-labelledby="pending-tickets">
                        <div class="tickets-date-group"></div>

                          
                            <!-- <div class="col-md-6">
                          
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Utilisateur</label>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="id_user" id="user" value="0" checked> Non </label>
                                  </div>
                                </div>
                                <div class="col-sm-5">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="id_user" id="user" value="1"> Oui </label>
                                  </div>
                                </div>
                              </div>
                            </div> -->

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="email" class="form-control" placeholder="Email" name="email" />

                                  @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                                </div>
                              </div>
                            </div>
                          

                          
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mot de passe</label>
                                <div class="col-sm-9">
                                  <input type="password" class="form-control" placeholder="Mot de passe" name="password" />

                                  @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                  @endif
                                </div>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirmer</label>
                                <div class="col-sm-9">
                                  <input type="password" class="form-control" placeholder="Confirmer mot de passe" name="password_confirmation" />

                                  @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                            </div>
                          
                        
                        
                      </div>
                      <br><br>
                      <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-block btn-lg btn-gradient-primary mt-4">Ajouter</button>
                        </div>
                        <div class="col-md-4">
                        </div>
                      </div>
                      </form>
                    </div>
                   
                  </div>
                </div>
              </div>
  

<!--<div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Ajouter employeur</h4>
                    <form class="form-sample" method="post" action="{{ url('/AjouterEmployer')}}" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                      <p class="card-description"></p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nom</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Nom et prénom" name="nom" />

                              @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Utilisateur</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="id_user" id="user" value="0" checked> Non </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="id_user" id="user" value="1"> Oui </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cin</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Cin" name="cin" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control" placeholder="Email" name="email" />

                              @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        		@endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Téléphone" name="tel" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mot de passe</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" placeholder="Mot de passe" name="password" />

                              @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Adresse</label>
                            <div class="col-sm-9">
                              <input class="form-control" placeholder="Adresse" name="adresse" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirmer</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" placeholder="Confirmer mot de passe" name="password_confirmation" />

                              @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salaire</label>
                            <div class="col-sm-9">
                              <input class="form-control" placeholder="Salaire" name="salaire" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                              <input type="file" name="photo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Image de l'employeur">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                          </span>
                        </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                      </div>
                      <br><br>
                      <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        	<button type="submit" class="btn btn-block btn-lg btn-gradient-primary mt-4">Ajouter</button>
                        </div>
                        <div class="col-md-4">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>-->
@endsection