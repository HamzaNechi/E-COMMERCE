<!-- Header Area Start -->
@extends('layouts.app_page_vitrine')
@section('content')
<!-- Header Area End -->
<!-- Begin Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container-fluid h-100">
        <div class="breadcrumb-content h-100">
            <h2 class="breadcrumb-title">Articles</h2>
            <ul>
                <li><a href="{{url('/')}}">Acceuil</a></li>
                <li class="active">Article</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End Here -->
<!-- Blog Area Start Here -->
<div class="blog-area-wrapper blog-3-column-wrapper">
    <div class="container-fluid">
        <div class="row pb-40" id="articles-area">
            @foreach ($articles as $article)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-30">
                <div class="blog-wrapper">
                    <div class="blog-inner-box">
                        <div class="blog-thumbnail">
                            <a class="hover-style" href="{{url('/single-article/'.$article->id)}}">
                                <img class="img-fluid" src="{{asset('img/articles/m/'.$article->image)}}" alt="mgana's blog post">
                                <span class="date-post">
                                    <span class="day-post">{{ $article->created_at->format('d') }}</span>
                                    <span class="month-post">{{ $article->created_at->format('M') }}</span>
                                </span>
                            </a>
                        </div>
                        <div class="blog-content text-center">
                            <div class="blog-meta">
                                <a href="{{url('/')}}">VIORE</a>
                            </div>
                            <div class="blog-title">
                                <h4><a href="{{url('/single-article/'.$article->id)}}">{{$article->title}}</a></h4>
                            </div>
                            <div class="read-more"><a href="{{url('/single-article/'.$article->id)}}">Ouvrir</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12 wow slideInUp">
                <div class="paginatoin-area position-center">
                    {{$articles->links('vendor\pagination\front-pagination')}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area End Here -->

<!-- Footer Area Start Here -->
@endsection
<!-- Footer Area End -->