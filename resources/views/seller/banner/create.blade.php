@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">add</i>
                        </div>
                        <div class="card-content">
                            @include('admin.includes.message')
                            <h4 class="card-title align:cen">Add Banner</h4>

                            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group label-floating">
                                        <label>Type</label>
                                        <select class="form-control category" name="type" id="type" required>
                                            <option value="" disabled selected>Select type</option>
                                            <option value="slider">Slider</option>
                                            {{--<option value="beauty product">Beauty Product</option>--}}
                                            {{--<option value="boutique">Boutique</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="title">Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form group label-floating">
                                        <label class="control-label" for="">Caption</label>
                                        <input type="text" name="caption" class="form-control">
                                    </div>
                                </div>

                                <label id="fileupload-example-3-label" for="fileupload-example-3">Image</label>
                                <div id="display-image-div">
                                    <div class="display-image">
                                        <div class="input-group col-lg-4">
                                            <input type="file" name="image" class="display-image" required/> (max
                                            size: 2mb)
                                            {{--<span class="input-group-btn">
                                                <button class="btn btn-success" id="add">
                                                    <i class="material-icons">add</i>
                                                </button>
                                             <button class="btn btn-danger" id="remove" style="display: none">
                                                    <i class="material-icons">remove</i>
                                                </button>
                                            </span>--}}
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div align="center">
                                    {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                                    {{Form::reset('Reset', ['class' => 'btn btn-danger'])}}
                                    <a href="{{ route('banner.index') }}" class="btn btn-info">Go Back</a>
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
