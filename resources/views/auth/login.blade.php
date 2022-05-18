<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from www.bootstrapdash.com/demo/purple-admin-free/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Mar 2021 10:15:32 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Espace admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{URL::asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{URL::asset('assets/images/logo-mini.png')}}" style="width: 2px; height: 20px;" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-5 mx-auto">
              <div class="auth-form-light text-center p-5">
                <div class="brand-logo">
                  <img class="img-full" src="{{URL::asset('vitrine/assets/images/logo/viore.png')}}"  alt="Header Logo" style="width: 50%; height: auto;">
                </div>
                
                <form class="pt-3" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('cin') ? ' has-error' : '' }}">
                    <input type="text" class="form-control form-control-lg" id="cin" placeholder="Numéro de cin" name="cin" value="{{ old('cin') }}">
                    @if ($errors->has('cin'))
                      <span class="help-block">
                        <strong>{{ $errors->first('cin') }}</strong>
                      </span>
                    @endif
                  </div>


                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Mot de passe" name="password">

                    @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="remember" class="form-check-input"> Gardez-moi connecté </label>
                    </div>
                    
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">Connexion</button>
                  </div>
                  
                  
                </form>
                <!--<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>-->
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{URL::asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{URL::asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{URL::asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{URL::asset('assets/js/misc.js')}}"></script>
    <!-- endinject -->
  </body>

<!-- Mirrored from www.bootstrapdash.com/demo/purple-admin-free/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Mar 2021 10:15:32 GMT -->
</html>