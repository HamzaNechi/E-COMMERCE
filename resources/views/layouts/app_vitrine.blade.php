<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.hasthemes.com/mgana-preview/mgana/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Mar 2021 00:46:24 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<!--head-->
@include('vitrine.layout.head')
@yield('css')
<body>

    <!--===== Pre-Loading area Start =====-->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!--==== Pre-Loading Area End ====-->


    <!-- Header Area Start -->
    @include('vitrine.layout.header')
        @yield('content')
    <!-- Header Area End -->
    <!-- Begin Slider Area One -->
    

    <!-- Footer Area Start Here -->
    @include('vitrine.layout.footer')
    <!-- Footer Area End -->

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="lastudioicon-up-arrow"></i>
    </a>
    <!-- Scroll to Top End -->

    <!--script-->
    @include('vitrine.layout.script')
        @yield('js')

</body>


<!-- Mirrored from htmldemo.hasthemes.com/mgana-preview/mgana/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Mar 2021 00:47:33 GMT -->
</html>