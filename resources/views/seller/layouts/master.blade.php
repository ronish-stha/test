<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"/>--}}
{{--    <link rel="icon" type="image/png" href="../assets/img/favicon.png"/>--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Liquor Store | Seller Panel</title>
    <link href="{{ URL::asset('backend/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('backend/css/material-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('backend/css/demo.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('backend/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('backend/css/google-roboto-300-700.css') }}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('styles')
</head>

<body>
<div class="wrapper">
    @include('seller.layouts.sidebar')
    <div class="main-panel">
        @include('seller.layouts.header')
        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="{{ route('index') }}">LiquorStore</a>
                </p>
            </div>
        </footer>
    </div>
</div>

<script src="{{ URL::asset('backend/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/bootstrap-notify.js') }}"></script>
<script src="{{ URL::asset('backend/js/jquery.sharrre.js') }}"></script>
<script src="{{ URL::asset('backend/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ URL::asset('backend/js/jquery-jvectormap.js') }}"></script>
<script src="{{ URL::asset('backend/js/nouislider.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/jquery.select-bootstrap.js') }}"></script>
<script src="{{ URL::asset('backend/js/jquery.datatables.js') }}"></script>
<script src="{{ URL::asset('backend/js/sweetalert2.js') }}"></script>
<script src="{{ URL::asset('backend/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/jquery.tagsinput.js') }}"></script>
<script src="{{ URL::asset('backend/js/material-dashboard.js') }}"></script>
{{--<script src="{{ URL::asset('backend/js/demo.js') }}"></script>--}}
{{--<script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>--}}
@yield('scripts')

</body>
<!--   Core JS Files   -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:16 GMT -->
</html>
