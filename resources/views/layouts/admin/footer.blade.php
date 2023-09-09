<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/2.8.0_Chart.min.js')}}"></script>
<script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
<script src="{{asset('js/simple-datatables.min.js')}}" ></script>
<script src="{{asset('js/datatables-simple-demo.js')}}"></script>
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
{{--datepicker--}}
    <script src="{{asset('datepicker/jquery-ui-1.13.2/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('datepicker/jquery-ui-1.13.2/jquery-ui.js')}}"></script>
<!-- include summernote css/js -->
<script src="{{asset('summernote-0.8.18/summernote.min.js')}}"></script>
{{--datepicker--}}
<script>
    $( function() {
        $( "#datepicker" ).datepicker();
        $('.summernote').summernote();
    } );
</script>
