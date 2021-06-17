@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
        {{--<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">edit</i>
                    </div>
                    <div class="card-content">
                        @include('admin.includes.message')
                        <h4 class="card-title align:cen">Change Password</h4>

                        <form action="{{ route('update.password') }}"></form>
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" name="old-password">
                        </div>

                        <div class="form-group">
                            <label for="old_password">New Password</label>
                            <input type="password" class="form-control" name="old-password">
                        </div>

                        <div class="form-group">
                            <label for="old_password">Confirm Password</label>
                            <input type="password" class="form-control" name="old-password">
                        </div>
                        </form>
                    </div>
                </div>
            </div>--}}

        {{--<div class="wrapper wrapper-full-page">--}}
        {{--<div class="full-page login-page" filter-color="black" data-image="{{ URL::asset('img/login.jpg') }}">--}}
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top: -60px;">
                        @include('admin.includes.message')
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="post" action="{{ route('update.password') }}">
                                {{ csrf_field() }}
                                <div class="card card-login card-hidden" ;>
                                    <div class="card-header text-center" data-background-color="rose">
                                        <h4 class="card-title">Change Password </h4>

                                        <div class="social-line">

                                        </div>
                                    </div>
                                    <p class="category text-center">
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_open</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Old Password</label>
                                                <input type="password" name="old_password" class="form-control" autofocus >
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">New Password</label>
                                                <input type="password" name="new_password" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">
                                            Change
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    </div>
@endsection
