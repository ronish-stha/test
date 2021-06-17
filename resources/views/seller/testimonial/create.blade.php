@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-design">Add</i>
                        </div>
                        <div class="card-content">
                            @include('admin.includes.message')
                            <h4 class="card-title align:cen"> product Form</h4>

                            {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{Form::label('name', ' Name')}}
                                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Product name here.'])}}
                            </div>

                            <div class="container">
                                {{Form::label('cover_image', 'Select Cover Image')}}
                                {{Form::file('cover_image')}}
                            </div>
                            <hr>

                            <div class="form-group">
                                {{Form::label('description', 'Products Description')}}
                                {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter Content here.'])}}
                            </div>
                            <br>
                            <br>
                            <hr>
                            <div align="center">
                                {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                                {{Form::reset('Reset', ['class' => 'btn btn-danger'])}}
                                <a href="admin/dashboard" class="btn btn-info">Go Back</a>
                            </div>
                            {!! Form::close() !!}
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
