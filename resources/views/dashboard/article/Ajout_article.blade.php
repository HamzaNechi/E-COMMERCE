@extends('layouts.app1')
@section('content')


@if(Session::has('flash_message_error'))
<div class="toast" id="danger" data-autohide="true" data-delay="2300" style="background-color:#d42d2d;position:relative;margin-top: -20px; margin-left: 850px;">
    <div class="toast-header" style="background-color:#d42d2d;">
        <strong class="mr-auto">
            <h4 style="color:white;">Ouups !</h4>
        </strong>
        <small class="text-muted"></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body" style="color:white;">
        <img src="{{URL::asset('assets/images/dashboard/danger.png')}}" style="width:30px;height: 30px; float: left;">
        <p style="margin-left: 50px;">{!! session('flash_message_error') !!}</p>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#danger').toast('show');
    });
</script>
@endif


@if(Session::has('flash_message_success'))
<div class="toast" id="success" data-autohide="true" data-delay="2300" style="background-color:#1bcfb4;position:relative;margin-top: -20px; margin-left: 850px;">
    <div class="toast-header" style="background-color:#1bcfb4;">
        <strong class="mr-auto">
            <h4 style="color:white;">Succés</h4>
        </strong>
        <small class="text-muted"></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body" style="color:white;">
        <img src="{{URL::asset('assets/images/dashboard/success.png')}}" style="width:30px;height: 30px; float: left;">
        <p style="margin-left: 50px;">{!! session('flash_message_success') !!}</p>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#success').toast('show');
    });
</script>
@endif
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Ajouter article</h4> -->
            <form enctype="multipart/form-data" id="addArticleForm" class="form-sample" method="post" action="{{ url('/ajouter-article')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputCity1">Titre</label>
                            <input type="text" class="form-control" name="title" placeholder="Titre de l'article">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image*</label>
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Choisir une image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Choisir</button>
                                </span>
                            </div>
                            <input type="file" name="image" class="file-upload-default">
                        </div>
                    </div>
                    
                        <div class="col-lg-12">
                            <div class="card">
                                <input type="hidden" id="content" name="content">
                                <div class="card-body">
                                    <label>Contenu de l'article</label>
                                    <div id="summernoteExample">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col-md-12">
                        <label for="exampleInputCity1">Citation (“ ”)</label>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="author" placeholder="Auteur">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="quote" placeholder="Ajouter une citation si tu veut">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a type="submit" class="btn btn-gradient-primary mr-2">Ajouter</button> -->
                <a class="btn btn-gradient-primary mr-2" href="javascript:{}" onclick="document.getElementById('content').value=document.getElementsByClassName('note-editable')[0].innerHTML;document.getElementById('submit').click();">Ajouter</a>
                <button type="submit" id="submit" style="display:none;"></button>
            </form>
        </div>
    </div>
</div>
@endsection