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
                    <h4 class="card-title"></h4>
                    <p class="card-description"> </p>
                    <form method="POST" action="{{ url('/edit-product',$productDetail->id )}}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label for="exampleInputName1">Type*</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="type" value="{{ $productDetail['type'] }}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Nom*</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Nom produit" name="nom" value="{{ $productDetail['nom'] }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Code*</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" name="code" placeholder="Code produit" value="{{ $productDetail['code'] }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectGender">Catégorie</label>
                        <select class="form-control" id="exampleSelectGender" name="cat_id">
                          <option value="0">Séléctionnez catégorie</option>
                          <?php echo $cat_dropdown; ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword4">Couleur</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Couleur de produit" name="couleur" value="{{ $productDetail['couleur'] }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputCity1">Prix</label>
                        <input type="text" class="form-control" id="exampleInputCity1" name="prix" placeholder="Prix produit" value="{{ $productDetail['prix'] }}">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputCity1">Prix en gros</label>
                        <input type="text" class="form-control" id="exampleInputCity1" name="prix_gros" placeholder="Prix produit" value="{{ $productDetail['prix_gros'] }}">
                      </div>


                      <div class="form-group">
                        <label for="exampleInputCity1">Quantité totale</label>
                        <input type="text" class="form-control" id="exampleInputCity1" name="total_stock" placeholder="Quantité totale de produit" value="{{ $productDetail['total_stock'] }}">
                      </div>
                      
                      <div class="form-group">
                        <label>Image*</label>
                        <input type="file" name="image" class="file-upload-default" value="{{ $productDetail['image'] }}" >
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" placeholder="{{ $productDetail['image'] }}">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Modifier</button>
                          </span>
                        </div>
                      </div>
                      
                      <!-- <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" rows="4" name="description">
                          {{ $productDetail['description'] }}
                        </textarea>
                      </div> -->

                      
                        <div class="col-lg-12">
                            <div class="card">
                                <input type="hidden" id="description" name="description">
                                <div class="card-body">
                                    <label>Description</label>
                                    <div id="summernoteExample">
                                      <?php echo $productDetail['description']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      


                      <!-- <button type="submit" class="btn btn-gradient-primary mr-2">Modifier</button> -->
                      <a class="btn btn-gradient-primary mr-2" href="javascript:{}" onclick="document.getElementById('description').value=document.getElementsByClassName('note-editable')[0].innerHTML;document.getElementById('submit').click();">Modifier</a>
                      <button type="submit" id="submit" style="display:none;"></button>
                      <button class="btn btn-light" type="reset">Annuler</button>
                    </form>
                  </div>
                </div>
</div>

<!-- <script>
$(document).on("keyon","#summernoteExample",function(e){
    var note=e.target.value;
    console.log(note);
    // if (tva > 0) {
    //   $("#timbre").val( 0.600 );
    // }else{
    //   $("#timbre").val(0);
    // }
  });
  
</script> -->
@endsection