@include('sweetalert::alert')

<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="{{ asset('admin-templates') }}/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- slimscroll js -->
<script src="{{ asset('admin-templates') }}/js/jquery.mCustomScrollbar.concat.min.js "></script>

<!-- menu js -->
<script src="{{ asset('admin-templates') }}/js/pcoded.min.js"></script>
<script src="{{ asset('admin-templates') }}/js/vertical/vertical-layout.min.js "></script>
{{-- Toast --}}
<script src="{{ asset('admin-templates') }}/plugins/toastr/dist/jquery.toast.min.js"></script>
<script type="text/javascript" src="{{ asset('admin-templates') }}/js/script.js "></script>
<script type="text/javascript">
    var APP_URL = "{!!  url('/') !!}";

</script>

@yield('pageScript')
</body>

</html>
