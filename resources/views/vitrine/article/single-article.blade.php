<!-- Header Area Start -->
@extends('layouts.app_page_vitrine')
@section('content')
<!-- Header Area End -->
<!-- Begin Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container-fluid h-100">
        <div class="breadcrumb-content h-100">
            <h2 class="breadcrumb-title">{{$article->title}}</h2>
            <ul>
                <li><a href="{{ url('/articles')}}">Articles</a></li>
                <li class="active">{{$article->title}}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End Here -->
<!-- Blog Area Start Here -->
<div class="blog-area-wrapper blog-left-sidebar-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1 order-1 order-lg-2"></div>
            <div class="col-lg-10 order-1 order-lg-2">
                <div class="row">
                    <div class="col-lg-12 pb-80">
                        <div class="blog-wrapper">
                            <div class="blog-inner-box shadow-none">
                                <div class="blog-thumbnail">
                                    <a class="hover-style" href="/blog-single-post">
                                        <img class="img-fluid" src="{{asset('img/articles/l/'.$article->image)}}" alt="mgana's blog post">
                                        <span class="date-post">
                                            <span class="day-post">{{ $article->created_at->format('d') }}</span>
                                            <span class="month-post">{{ $article->created_at->format('M') }}</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="blog-content text-left">
                                    <div class="blog-meta mt-15">
                                        <a href="{{ url('/')}}">VIORE</a>
                                    </div>
                                    <div class="blog-title">
                                        <h4><a class="pl-0 mt-15" href="#1">{{$article->title}}</a></h4>
                                    </div>
                                    <div class="desc-content">
                                        <?php echo $article->content; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="blog-wrapper">
                            <div class="blog-inner-box shadow-none">
                                <div class="blog-thumbnail hover-style">
                                    <a href="/blog-single-post">
                                        <img class="img-fluid" src="vitrine_assets/images/blog/medium-size/11.jpg" alt="mgana's blog post">
                                    </a>
                                    <div class="blog-thumb-video">
                                        <div class="popup-video d-flex justify-content-center">
                                            <a class="popup-vimeo" href="https://player.vimeo.com/video/172601404?autoplay=1">
                                                <i class="lastudioicon lastudioicon-triangle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-content text-left">
                                    <div class="blog-title pt-50 pb-20">
                                        <h6>7 Reasons To Stay At The Peninsula Paris</h6>
                                    </div>
                                    <div class="desc-content">
                                        <p>All the rumors have finally died down and many skeptics have tightened their lips, the iPod does support video format now on its fifth generation. While the iPod is not the first to come up with this, it has certainly made its stature as the greatest in the market and can be dubbed as the best multimedia portable player available.</p><br>
                                        <p>With its popularity and iconesque standing, the iPod has made sharing videos easier. You don’t need to be lugging around different equipments for your music, your notes, your photos and your videos. You can have the standard where every other portable multimedia players are gauged to and not need anything else. Video playback capabilities have made it a complete multi media equipment, but not all formats are supported just yet. So if you want to put your videos in your iPod you have to make sure that they are in a supported format.</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        @if(!empty($article->quote))
                        <div class="blog-wrapper blog-thumbnail-quote">
                            <div class="blog-inner-box shadow-none">
                                <div class="blog-thumbnail">
                                    <div class="blog-thumb-content position-relative">
                                        <div class="format-content">
                                            <p class="quote-content">{{$article->quote}}</p>
                                            <span class="quote-author">{{$article->author}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="blog-content text-left">
                                    <div class="desc-content">
                                        <p>All the rumors have finally died down and many skeptics have tightened their lips, the iPod does support video format now on its fifth generation. While the iPod is not the first to come up with this, it has certainly made its stature as the greatest in the market and can be dubbed as the best multimedia portable player available.</p><br>
                                        <p>With its popularity and iconesque standing, the iPod has made sharing videos easier. You don’t need to be lugging around different equipments for your music, your notes, your photos and your videos. You can have the standard where every other portable multimedia players are gauged to and not need anything else. Video playback capabilities have made it a complete multi media equipment, but not all formats are supported just yet. So if you want to put your videos in your iPod you have to make sure that they are in a supported format.</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        @endif
                        <div class="social-link with-color with-radius border-top border-bottom pt-0 pb-10">
                            <ul class="pt-10">
                                <li class="facebook">
                                    <a href="https://www.facebook.com/vioretunisie" data-toggle="tooltip" target="_blank" title="" data-original-title="Facebook">
                                        <i class="lastudioicon-b-facebook"></i>
                                    </a>
                                </li>
                                
                                <li class="instagram">
                                    <a href="https://www.instagram.com/vioretunisie/?hl=fr" data-toggle="tooltip" target="_blank" title="" data-original-title="Instagram" aria-describedby="tooltip172507">
                                        <i class="lastudioicon-b-instagram"></i>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="nav-post-link">
                            @if (!empty($previous))
                            <div class="nav-previous">
                                <a class="nav-post-title" href="{{url('/single-article/'.$previous->id)}}">{{$previous->title}}</a>
                                <a class="nav-post-button" href="{{url('/single-article/'.$previous->id)}}">Article précédent</a>
                            </div>
                            @endif
                            @if (!empty($next))
                            @if (empty($previous))
                            <div class="nav-previous"></div>
                            @endif
                            <div class="nav-next text-right">
                                <a class="nav-post-title" href="{{url('/single-article/'.$next->id)}}">{{$next->title}}</a>
                                <a class="nav-post-button" href="{{url('/single-article/'.$next->id)}}">Article suivant</a>
                            </div>
                            @endif
                        </div>
                        <!-- <ul class="blog-feedback_area">
                            <h2 class="heading mb-0">This post has 4 comments</h2>
                            <li class="user-body">
                                <div class="user-pic">
                                    <img src="vitrine_assets/images/testimonial/avatar1.png" alt="User Picture">
                                </div>
                                <div class="user-content">
                                    <h3 class="user-name mb-0"><a href="#">A WordPress Commenter</a> <span class="user-meta">26 Dec 2020</span></h3>
                                    <p class="user-feedback mb-0">“Theme is very flexible and easy to use. Perfect for us. Customer support has been excellent and answered every question we’ve thrown at them with 12 hours.”</p>
                                    <div class="reply-btn_wrap">
                                        <a class="reply-btn" href="#"><span class="lastudioicon-voice-recognition"></span>Reply</a>
                                    </div>
                                </div>
                            </li>
                            <li class="user-body sub-user_body">
                                <div class="user-pic">
                                    <img src="vitrine_assets/images/testimonial/avatar1.png" alt="User Picture">
                                </div>
                                <div class="user-content">
                                    <h3 class="user-name mb-0"><a href="#">Support Agency</a> <span class="user-meta">26 Dec 2020</span></h3>
                                    <p class="user-feedback mb-0">“This theme is indeed a great purchase. Support center is also helpful and quick to answer. No issues so far.”</p>
                                    <div class="reply-btn_wrap">
                                        <a class="reply-btn" href="#"><span class="lastudioicon-voice-recognition"></span>Reply</a>
                                    </div>
                                </div>
                            </li>
                            <li class="user-body">
                                <div class="user-pic">
                                    <img src="vitrine_assets/images/testimonial/avatar1.png" alt="User Picture">
                                </div>
                                <div class="user-content">
                                    <h3 class="user-name mb-0"><a href="#">David Louis</a> <span class="user-meta">26 Nov 2020</span></h3>
                                    <p class="user-feedback mb-0">“Exceptional service, beautiful and straightforward theme! Can’t recommend enough.”</p>
                                    <div class="reply-btn_wrap">
                                        <a class="reply-btn" href="#"><span class="lastudioicon-voice-recognition"></span>Reply</a>
                                    </div>
                                </div>
                            </li>
                            <li class="user-body">
                                <div class="user-pic">
                                    <img src="vitrine_assets/images/testimonial/avatar1.png" alt="User Picture">
                                </div>
                                <div class="user-content">
                                    <h3 class="user-name mb-0"><a href="#">John Snow</a> <span class="user-meta">26 Dec 2020</span></h3>
                                    <p class="user-feedback mb-0">“Highly customizable. Excellent design. Customer services has exceeded my expectation. They are quick to answer and even when they don’t know the answer right away. They’ll work with you towards a solution.”</p>
                                    <div class="reply-btn_wrap">
                                        <a class="reply-btn" href="javascript:void(0)"><span class="lastudioicon-voice-recognition"></span>Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="review-body">
                            <div class="user-feedback">
                                <h3 class="heading">Laisser une réponse</h3>
                                <form class="feedback-form" action="#">
                                    <div class="comment-field">
                                        <textarea name="commnet" spellcheck="false" class="textarea-field"></textarea>
                                    </div>
                                    <div class="group-input">
                                        <div class="name-field">
                                            <label class="label-field mb-0">Nom*</label>
                                            <input type="text" name="name" class="input-field input-name">
                                        </div>
                                        <div class="email-field">
                                            <label class="label-field mb-0">Email*</label>
                                            <input type="text" name="email" class="input-field input-email">
                                        </div>
                                    </div>
                                    <div class="comment-btn_wrap">
                                        <a class="mgana-btn" href="#">soumettre</a>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 order-2 order-lg-1">
                    <div class="sidebar-area ml-lg-2 pb-75">
                        <div class="widgets-area">
                            <div class="search-box text-center">
                                <form class="mc-form ml-auto mr-auto">
                                    <input type="Text" class="text-box" placeholder="Search entire store…" name="Text">
                                    <button class="search-btn" type="submit"><i class="lastudioicon-zoom-1"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="widgets-area pt-60">
                            <h2 class="heading"><span>CATEGORIES</span></h2>
                            <ul class="widgets-blog-category">
                                <li>
                                    <a href="#">Lifestyle <span>(2)</span></a>
                                </li>
                                <li>
                                    <a href="#">Photography <span>(3)</span></a>
                                </li>
                                <li>
                                    <a href="#">Technology <span>(4)</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="widgets-area pt-50">
                            <h2 class="heading"><span>Popular Posts</span></h2>
                            <div class="widgets-blog-post-area">
                                <div class="single-sidebar-post">
                                    <div class="sidebar-post-img">
                                        <a href="/blog-details-fullwidth"><img src="vitrine_assets/images/blog/blog-post-sidebar/1.jpg" alt=""></a>
                                    </div>
                                    <div class="sidebar-post-content">
                                        <a href="/blog-details-fullwidth" title="My Favorite White Sneakers From Splurge To Save">My Favorite White Sneakers From Splurge..</a>
                                        <span>October 30, 2020 </span>
                                    </div>
                                </div>
                                <div class="single-sidebar-post">
                                    <div class="sidebar-post-img">
                                        <a href="/blog-details-fullwidth"><img src="vitrine_assets/images/blog/blog-post-sidebar/2.jpg" alt=""></a>
                                    </div>
                                    <div class="sidebar-post-content">
                                        <a href="/blog-details-fullwidth" title="The Unexpected Summer Piece You Can Transition Into Fall">The Unexpected Summer Piece You Can Transition..</a>
                                        <span>October 30, 2020 </span>
                                    </div>
                                </div>
                                <div class="single-sidebar-post">
                                    <div class="sidebar-post-img">
                                        <a href="/blog-details-fullwidth"><img src="vitrine_assets/images/blog/blog-post-sidebar/3.jpg" alt=""></a>
                                    </div>
                                    <div class="sidebar-post-content">
                                        <a href="/blog-details-fullwidth" title="7 Reasons To Stay At The Peninsula Paris ">7 Reasons To Stay At The Peninsula Paris</a>
                                        <span>October 30, 2020 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widgets-area pt-60">
                            <h2 class="heading"><span>Archives</span></h2>
                            <div class="archives-area">
                                <select class="myniceselect nice-select wide">
                                    <option value="1">Select Month</option>
                                    <option value="2">December 2020</option>
                                    <option value="3">November 2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="widgets-area mt-50">
                            <h2 class="heading"><span>Tags</span></h2>
                            <div class="widgets-tags-2">
                                <ul>
                                    <li><a href="#">Computer,</a></li>
                                    <li><a href="#">Design,</a></li>
                                    <li><a href="#">Technology,</a></li>
                                    <li><a href="#">Beauty,</a></li>
                                    <li><a href="#">Demo-01,</a></li>
                                    <li><a href="#">Lifestyle,</a></li>
                                    <li><a href="#">Motion Design,</a></li>
                                    <li><a href="#">Photography,</a></li>
                                    <li><a href="#">Travel</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widgets-area pt-60">
                            <div class="widgets-banner img-zoom_effect">
                                <div class="widgets-banner_img">
                                    <a href="#">
                                        <img class="w-100" src="vitrine_assets/images/banner/shop-banner/shop-1.jpg" alt="Sidebar Image">
                                    </a>
                                </div>
                                <div class="widgets-banner_text">
                                    <span>Ad Banner</span>
                                    <span class="banner-text">https://hasthemes.com/</span>
                                </div>
                            </div>
                        </div>
                        <div class="widgets-area pt-60">
                            <div class="search-box search-newsletter text-center">
                                <form id="mc-form" class="mc-form ml-auto mr-auto">
                                    <input type="email" id="mc-email" class="text-box" placeholder="Email for Newsletter" name="EMAIL">
                                    <button id="mc-submit" class="search-btn" type="submit"><i class="lastudio-subscribe-form__submit-icon lastudioicon lastudioicon-letter"></i></button>
                                </form>
                                <!-- mailchimp-alerts Start -->
            <div class="mailchimp-alerts text-centre">
                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
            </div><!-- mailchimp-alerts end -->
        </div>
    </div>
    <!-- <div class="widgets-area pt-60">
        <h2 class="heading">
            <span>Instagram</span>
        </h2>
        <div class="instagram-area row">
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/1-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>4</span>
                    </div>
                </div>
            </div>
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/2-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>5</span>
                    </div>
                </div>
            </div>
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/3-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>4</span>
                    </div>
                </div>
            </div>
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/4-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>4</span>
                    </div>
                </div>
            </div>
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/5-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>4</span>
                    </div>
                </div>
            </div>
            <div class="instagram-item instagram-sub-col-2">
                <div class="instagram-img">
                    <a href="#">
                        <img class="w-100" src="vitrine_assets/images/instagram/6-1.jpg" alt="Instagram Image">
                    </a>
                    <div class="add-action">
                        <i class="dlicon ui-3_heart"></i>
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<!-- </div> -->
</div>
@if(count($articles))
<div class="row mb-70">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 wow fadeInUp">
        <div class="blog-post-title">
            <h2 class="heading">
                <span>Autres articles</span>
            </h2>
        </div>
        <div class="mgana-element-carousel single-blog-post-carousel arrow-style-10" data-slick-options='{
                    "slidesToShow": 3,
                    "slidesToScroll": 1,
                    "infinite": false,
                    "arrows": true,
                    "dots": false
                    }' data-slick-responsive='[
                    {"breakpoint": 1200, "settings": {
                    "slidesToShow": 3
                    }},
                    {"breakpoint": 992, "settings": {
                    "slidesToShow": 2
                    }},
                    {"breakpoint": 576, "settings": {
                    "slidesToShow": 1
                    }}
                ]'>
            @foreach ($articles as $item)
            <div class="blog-post-wrapper">
                <div class="post-inner-box">
                    <div class="post-thumbnail">
                        <a class="hover-style" href="{{url('/single-article/'.$item->id)}}">
                            <img class="img-fluid" src="{{asset('img/articles/m/'.$item->image)}}" alt="mgana's blog post">
                            <span class="date-post">
                                <span class="day-post">{{ $article->created_at->format('d') }}</span>
                                <span class="month-post">{{ $article->created_at->format('M') }}</span>
                            </span>
                        </a>
                    </div>
                    <div class="post-content text-center">
                        <div class="post-meta">
                            <a></a>
                            <a></a>
                        </div>
                        <div class="post-title">
                            <h4><a href="{{url('/single-article/'.$item->id)}}">{{$item->title}}</a></h4>
                        </div>
                        <div class="read-more pb-25"><a href="{{url('/single-article/'.$item->id)}}">Ouvrir</a></div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endif
</div>
</div>
<!-- Blog Area End Here -->

<!-- Footer Area Start Here -->
@endsection
<!-- Footer Area End -->