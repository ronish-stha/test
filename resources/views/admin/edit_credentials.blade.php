@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">edit</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Edit Credentials</h4>

                            <form action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ old('email', Auth::user()->email)  }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label>First Name</label>
                                            <input type="name" class="form-control" name="first_name"
                                                   value="{{ old('first_name', Auth::user()->first_name)  }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label>Last Name</label>
                                            <input type="last_name" class="form-control" name="last_name"
                                                   value="{{ old('last_name', Auth::user()->last_name)  }}">
                                        </div>
                                    </div>
                                </div>


                                <div align="center">
                                    {{Form::submit('Update', ['class' => 'btn btn-success'])}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
@endsection