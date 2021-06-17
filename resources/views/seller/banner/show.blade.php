@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">insert_photo</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Banner</h4>
                                <img src="{{URL::asset('storage/banner/' . $banner->image)}}" height="auto"
                                     width="100%">
                                <br><br>
                            <p><strong>Type</strong> : {{ $banner->type }}</p>
                            <p><strong>Title</strong> : {{ $banner->title ? $banner->title : '-' }}</p>
                            <p><strong>Caption</strong> : {{ $banner->caption ? $banner->caption : '-' }}</p>
                        </div>
                        <div align="center">
                            <a href="{{ route('banner.edit',$banner->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('banner.index') }}" class="btn btn-outline-primary ">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
