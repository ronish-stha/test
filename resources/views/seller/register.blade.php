<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:19 GMT -->
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href=""/>
    <link rel="icon" type="image/png" href=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Liquor Store | Seller Center | Register</title>
    <link href="{{ URL::asset('css/admin/bootstrap.min.css') }}" rel="stylesheet"/>
    <!--  Material Dashboard CSS    -->
    <link href="{{ URL::asset('css/admin/material-dashboard.css') }}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project  -->
    <!--     Fonts and icons     -->
    <link href="{{ URL::asset('css/admin/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/google-roboto-300-700.css') }}" rel="stylesheet"/>
    <style>
        a {
            color: rgb(244, 67, 54);
        }
        .form-group.is-focused .form-control {
            background-image: linear-gradient(rgb(244, 67, 54), rgb(244, 67, 54)), linear-gradient(#D2D2D2, #D2D2D2);
        }
        .checkbox input[type=checkbox]:checked + .checkbox-material .check {
            background: rgb(244, 67, 54);
        }
    </style>
</head>

<body>
<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">Liquor Store | Seller Center</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="{{ route('index') }}">
                        <i class="material-icons">home</i> Home
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('seller.register') }}">
                        <i class="material-icons">person_add</i>
                        Register
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('seller.login') }}">
                        <i class="material-icons">fingerprint</i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black"
         data-image="{{ URL::asset('frontend/img/slider/9.jpg') }}">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top: -60px;">
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="card card-signup">
                            <h2 class="card-title text-center">Register</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <br>
                                    @include('seller.includes.message')
                                </div>
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="card-content">
                                        <div class="info info-horizontal">
                                            <div class="icon icon-rose">
                                                <i class="material-icons">timeline</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Marketing</h4>
                                                <p class="description">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info info-horizontal">
                                            <div class="icon icon-primary">
                                                <i class="material-icons">local_bar</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Products</h4>
                                                <p class="description">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="material-icons">group</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Build Audience</h4>
                                                <p class="description">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <form class="form" method="post" action="{{ route('seller.register.store') }}">
                                        {{ csrf_field() }}
                                        <div class="card-content">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark_border</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="text" class="form-control" name="first_name"
                                                           placeholder="First Name" autofocus required
                                                           value="{{ old('first_name') }}">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="text" class="form-control" name="last_name"
                                                           placeholder="Last Name" required
                                                           value="{{ old('last_name') }}">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">store</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="text" class="form-control" name="store_name"
                                                           placeholder="Store Name" required
                                                           value="{{ old('store_name') }}">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="email" class="form-control" placeholder="Email"
                                                           name="email" value="{{ old('email') }}" required>
                                                    <span class="material-input"></span></div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="number" class="form-control" placeholder="Contact Number"
                                                           name="phone1" value="{{ old('phone1') }}" required>
                                                    <span class="material-input"></span></div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="password" placeholder="Password" name="password"
                                                           required class="form-control">
                                                    <span class="material-input"></span></div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="password" placeholder="Confirm Password"
                                                           name="confirm_password" required class="form-control">
                                                    <span class="material-input"></span></div>
                                            </div>

                                            <!-- If you want to add a checkbox to this form, uncomment this code -->

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes">
                                                    I agree to the <a href="#something">terms and conditions</a>.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="footer text-center">
                                            <button type="submit" class="btn btn-danger btn-round">Get Started</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
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
</body>
<script src="{{URL::asset('js/admin/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/admin/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/admin/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/admin/material.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/admin/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{URL::asset('js/admin/jquery.validate.min.js')}}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{URL::asset('js/admin/moment.min.js')}}"></script>
<!--  Plugin for the Wizard -->
<script src="{{URL::asset('js/admin/jquery.bootstrap-wizard.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{URL::asset('js/admin/bootstrap-notify.js')}}"></script>
<!--   Sharrre Library    -->
<script src="{{URL::asset('js/admin/jquery.sharrre.js')}}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{URL::asset('js/admin/bootstrap-datetimepicker.js')}}"></script>
<script src="{{URL::asset('js/admin/nouislider.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<!--<script src="{{URL::asset('js/admin/jquery.select-bootstrap.js')}}"></script>-->
<!-- Select Plugin -->
<script src="{{URL::asset('js/admin/jquery.select-bootstrap.js')}}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{URL::asset('js/admin/jquery.datatables.js')}}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{URL::asset('js/admin/sweetalert2.js')}}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{URL::asset('js/admin/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{URL::asset('js/admin/fullcalendar.min.js')}}"></script>
<!-- TagsInput Plugin -->
<script src="{{URL::asset('js/admin/jquery.tagsinput.js')}}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{URL::asset('js/admin/material-dashboard.js')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{URL::asset('js/admin/demo.js')}}"></script>
<script type="text/javascript">
    $().ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

<script>
    /*var $validator = $('#login-form').validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true
            }
        },

        errorPlacement: function (error, element) {
            $(element).parent('div').addClass('has-error');
        }
    });*/
</script>

</html>
