@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">edit</i>
                        </div>
                        <div class="card-content">
                            @include('admin.includes.message')
                            <h4 class="card-title align:cen">
                                Edit @if ($banner->id != 1 && $banner->id != 2 && $banner->id != 3) Banner @else
                                    Promotion @endif</h4>

                            <form action="{{ route('banner.update', $banner->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                @if ($banner->id != 1 && $banner->id != 2 && $banner->id != 3)
                                    <div class="row">
                                        <div class="form-group label-floating">
                                            <label>Type</label>
                                            <select class="form-control category" name="type" id="type" required>
                                                <option value="" disabled>Select type</option>
                                                <option value="slider"
                                                        {{ $banner->type == 'slider' ? 'selected': ' ' }}>
                                                    Slider
                                                </option>
                                                {{--<option value="fashion"
                                                        {{ $banner->type == 'fashion' ? 'selected': ' ' }}>
                                                    Fashion
                                                </option>
                                                <option value="beauty product"
                                                        {{ $banner->type == 'beauty product' ? 'selected': ' ' }}>
                                                    Beauty Product
                                                </option>
                                                <option value="boutique"
                                                        {{ $banner->type == 'boutique' ? 'selected': ' ' }}>
                                                    Boutique
                                                </option>--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="title">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $banner->title }}">
                                        </div>
                                        <div class="form group label-floating">
                                            <label class="control-label" for="">Caption</label>
                                            <input type="text" name="caption" class="form-control" value="{{ $banner->caption }}">
                                        </div>
                                    </div>
                                @endif

                                <label id="fileupload-example-3-label" for="fileupload-example-3">Image</label>
                                <div id="display-image-div">
                                    <div class="display-image">
                                        <div class="input-group col-lg-4">
                                            <input type="file" name="image" class="display-image"/> (max
                                            size: 2mb)
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <img src="{{URL::asset('storage/banner/' . $banner->image)}}" style="height:100px;
                                         width:110px;">
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
