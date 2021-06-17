@extends('frontend.layout.master')
@section('content')
    <div class="row ptb-40">
        <div class="col-md-5">
            <div class="container">
                <nav class="pt-10">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login"
                           role="tab" aria-controls="nav-login" aria-selected="true">Login</a>
                        <a class="nav-item nav-link" id="nav-signup-tab" data-toggle="tab" href="#nav-signup"
                           role="tab" aria-controls="nav-signup" aria-selected="false">Register</a>
                    </div>
                </nav>
                <div class="tab-content " id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-login" role="tabpanel"
                         aria-labelledby="nav-login-tab">
                        <div class="login">
                            <div class="login-form-container">
                                <h4><strong>Login</strong></h4>
                                <div class="login-form">
                                    @include('frontend.includes.message')
                                    <form action="{{ route('customer.login') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="email" name="email" placeholder="Email" required autofocus>
                                        <input type="password" name="password" placeholder="Password" required>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                            <button type="submit" class="default-btn floatright pointer">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab">
                        <div class="login">
                            <div class="login-form-container">
                                <h4><strong>Fill the form to Register</strong></h4>
                                <div class="login-form">
                                    @include('frontend.includes.message')
                                    <form action="{{ route('customer.signup') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                                               placeholder="First Name *">
                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                                               placeholder="Last Name *">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               placeholder="Email *">
                                        <input type="password" name="password" placeholder="Password *">
                                        <input type="password" name="confirm_password" placeholder="Confirm Password *">
                                        <input type="text" name="address" value="{{ old('address') }}"
                                               placeholder="Address *">
                                        <input type="text" name="" value="{{ old('') }}"
                                               placeholder="APT/ Floor / Company">
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                               placeholder="Phone *">
                                        <input type="date" name="dob" value="{{ old('dob') }}" placeholder="DOB">
                                        <div class="button-box">
                                            <button type="submit" class="default-btn floatright">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-30">
            <img src="{{URL::asset('frontend/img/pub.png')}}" alt="" style="height: auto; width:100%;">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //redirect to specific tab
        $(document).ready(function () {
            $('#nav-tab a[href="#{{ old('tab') }}"]').tab('show')
        });
    </script>
@endsection
