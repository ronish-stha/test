<!doctype html>
<html class="no-js" lang="en">
<head>
    <script>
        var assetBaseURL = "{{ asset('') }}";
    </script>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Liquor Store @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--CSS--}}
    @include('frontend.includes.style')
    @yield('styles')
</head>
<body>
    {{--header--}}
    @include("frontend.includes.headernew")
    {{--content starts--}}
    @yield('content')
    {{--footer--}}
    @include('frontend.includes.footer')
    <!-- all js here -->
    @include('frontend.includes.script')
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#popupModal').modal('show');
        });
    </script>
    <script>
        $('#closemodal').click(function(e) {
            $('#popupModal').modal('hide');
        });
    </script>
    @yield('scripts')
</body>
</html>
