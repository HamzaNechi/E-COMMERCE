<script src="{{URL::asset('/js/app.js')}}"></script>
<script src="{{URL::asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{URL::asset('assets/js/off-canvas.js')}}"></script>
<script src="{{URL::asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{URL::asset('assets/js/misc.js')}}"></script>
<script src="{{URL::asset('assets/js/file-upload.js')}}"></script>
<script src="{{URL::asset('assets/js/todolist.js')}}"></script>
<script src="{{URL::asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.js')}}"></script>
<script src="{{URL::asset('assets/vendors/jquery-steps/jquery.steps.min.js')}}"></script>
<script src="{{URL::asset('assets/js/wizard.js')}}"></script>
<script type="text/javascript">
    

    $( document ).ready(function() {
        $("#notificationDropdown").on("click", function () {
        var url="{{ url('/markAsRead')}}";
        $('#cnt').removeClass('bg-danger');
        $('#msgtest').html('');
        $.get(url);
        });
    });
</script>


<!-- plugin editeur text -->
    <script src="{{URL::asset('assets/vendors/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/editorDemo.js')}}"></script>
<!-- plugin js editeur text -->

<!--plugin validate form--->
    <script src="{{URL::asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/validate.js')}}"></script>
<!--End validate form-->
    