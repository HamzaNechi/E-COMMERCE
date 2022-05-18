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
<div class="col-md-1"></div>
<div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-description"> </p>
                    <form method="POST" action="{{ url('/add-attribute',$productDetails->id)}}" enctype="multipart/form-data">
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
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Prix</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ $productDetails->prix }}" name="code" placeholder="Prix de produit" disabled>
                        </div>
                      </div>


                      <div class="row clearfix">
                        <div class="col-xl-12">
                          <div class="form-group">
                            <label></label>
                            <div class="field_wrapper">
                                <div>
                                  <div class="row">
                                    <div class="col-xl-10">
                                      <div class="row">
                                        <div class="col-xl-3">
                                      <input type="text" name="stock[]" class="form-control" id="stock" placeholder="Quantité" />
                                      </div>
                                      <div class="col-xl-3">
                                      <input type="text" name="sku[]" class="form-control" id="sku" placeholder="SKU" />
                                      </div>
                                      <div class="col-xl-3">
                                      <input type="text" name="prix_at[]" placeholder="Prix" class="form-control" id="prix_at"/></div>
                                      <div class="col-xl-3">
                                      <input type="text" name="prix_gros[]" placeholder="Prix en gros" class="form-control" id="prix_gros"/></div>
                                      <div class="col-xl-3">
                                      <input type="text" name="taille[]" placeholder="Taille" class="form-control" id="taille" />
                                    </div>
                                     </div>
                                    </div>
                                    
                                    <a href="javascript:void(0);" class="add_button btn btn-default" title="Add field"><i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                    <!--<button class="btn btn-gradient-success btn-rounded btn-icon">
                                      <i class="mdi mdi-plus-circle-outline"></i>
                                    </button>-->
                                 
                                    </div>
                                </div>
                            </div>
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











<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row clearfix"><div class="col-xl-12"><div class="form-group"><label></label><div class="field_wrapper"><div><div class="row"><div class="col-xl-10"><div class="row"><div class="col-xl-3"><input type="text" name="stock[]" class="form-control" id="stock" placeholder="Quantité" /></div><div class="col-xl-3"><input type="text" name="sku[]" class="form-control" id="sku" placeholder="SKU" /></div><div class="col-xl-3"><input type="text" name="prix_at[]" placeholder="Prix" class="form-control" id="prix_at"/></div><div class="col-xl-3"><input type="text" name="prix_gros[]" placeholder="Prix en gros" class="form-control" id="prix_gros"/></div><div class="col-xl-3"><input type="text" name="taille[]" placeholder="Taille" class="form-control" id="taille" /></div></div></div><a href="javascript:void(0);" class="remove_button btn btn-default "><i class="mdi mdi-undo-variant"></i></a></div></div></div></div></div></div>'; //New input field html 
   /*fin test*/
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
@endsection