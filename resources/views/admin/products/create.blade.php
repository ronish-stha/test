@extends('admin.layouts.master')

@section('styles')
    <link href="{{ URL::asset('css/admin/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">add</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Add Product</h4>

                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">article</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name
                                                    <small>*</small>
                                                </label>
                                                <input name="name" type="text" class="form-control"
                                                       value="{{ old('name') }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Brand
                                                </label>
                                                <input name="brand" type="text" class="form-control"
                                                       value="{{ old('brand') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">receipt</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Code
                                                </label>
                                                <input name="code" type="text" class="form-control"
                                                       value="{{ old('code') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">money</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Price
                                                    <small>*</small>
                                                </label>
                                                <input name="price" type="integer" class="form-control"
                                                       value="{{ old('price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">view_comfy</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Quantity
                                                </label>
                                                <input name="quantity" type="integer" class="form-control"
                                                       value="{{ old('quantity') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Discount (in %)
                                                </label>
                                                <input name="discount" type="text" class="form-control"
                                                       value="{{ old('discount') }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">category</i>
                                            </span>
                                            <div class="form-group">
                                                <select class="form-control category" name="category" id="category"
                                                        required>
                                                    @if(count($categories) == 0)
                                                        <option value="">No category available</option>
                                                    @else
                                                        <option value="">Category *</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{$category->id}}">{{ $category->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">local_drink</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Volume (in ml)
                                                    <small>*</small>
                                                </label>
                                                <input name="volume" type="integer" class="form-control"
                                                       value="{{ old('volume') }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1" id="subcategory-div-1" style="display: none">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">category</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label>SubCategory 1</label>
                                                <select class="form-control" name="subcategory_1" id="subcategory_1">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" id="subcategory-div-2" style="display: none">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label>SubCategory 2</label>
                                                <select class="form-control" name="subcategory_2" id="subcategory_2">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-5 col-lg-offset-1">
                                        <div class="input-group col-md-12">
                                            <div class="form-group">
                                                <div class="form-group is-empty is-fileinput">
                                                    <input type="file" name="cover_image" id="inputFile4" multiple="">
                                                    <div class="input-group col-md-12">
                                                     <span class="input-group-addon">
                                                        <i class="material-icons">image</i>
                                                     </span>
                                                        <input type="text" readonly="" class="form-control"
                                                               placeholder="Cover Image">
                                                        <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-5 col-lg-offset-1">
                                        <div class="input-group col-md-12">
                                            <div class="form-group">
                                                <div class="form-group is-empty is-fileinput">
                                                    <input type="file" name="image[]" id="inputFile4" multiple="">
                                                    <div class="input-group col-md-12">
                                                     <span class="input-group-addon">
                                                        <i class="material-icons">image</i>
                                                     </span>
                                                        <input type="text" readonly="" class="form-control"
                                                               placeholder="Display Images (max image: 4, max size: 2mb)">
                                                        <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-10 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">description</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label>Description</label>
                                                <textarea class="form-control" name="" id=""
                                                          id="article-ckeditor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <span>
                                {{--<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Name *</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Brand</label>
                                            <input type="text" class="form-control" name="brand" id="brand"
                                                   value="{{ old('brand') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Code</label>
                                            <input type="text" class="form-control" name="code" id="code"
                                                   value="{{ old('code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Price *</label>
                                            <input type="number" class="form-control" name="price" id="price"
                                                   value="{{ old('price') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity"
                                                   value="{{ old('quantity') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Discount (in %)</label>
                                            <input type="number" class="form-control" name="discount" id="discount"
                                                   value="{{ old('discount') }}">
                                        </div>
                                    </div>
                                </div>--}}

                                    {{--<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label>Category *</label>
                                                <select class="form-control category" name="category" id="category"
                                                        required>
                                                    @if(count($categories) == 0)
                                                        <option value="">No category available</option>
                                                    @else
                                                        <option value="">Select a category</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{$category->id}}">{{ $category->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="subcategory-div-1" style="display: none">
                                            <div class="form-group label-floating">
                                                <label>SubCategory 1</label>
                                                <select class="form-control" name="subcategory_1" id="subcategory_1">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="subcategory-div-2" style="display: none">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label>SubCategory 2</label>
                                                <select class="form-control" name="subcategory_2" id="subcategory_2">

                                                </select>
                                            </div>
                                        </div>
                                    </div>--}}
                                    {{--<div class="form-group">
                                        <label for="available">Available</label> : &nbsp&nbsp
                                        <input type="radio" name="available" value="yes" checked> Yes
                                        &nbsp&nbsp&nbsp
                                        <input type="radio" name="available" value="no"> No
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="">Feature Product</label> : &nbsp&nbsp
                                        <input type="checkbox" name="featured" value="1"> Feature &nbsp&nbsp&nbsp
                                    </div>--}}
                                    {{--                                <br>--}}
                                    {{--<div class="container">
                                        <label for="">Cover Image</label>
                                        <input type="file" name="cover_image">
                                    </div>
                                    <hr>
                                    <p><strong><b>Images for display</b></strong></p>
                                    <label id="fileupload-example-3-label" for="fileupload-example-3">Image</label>
                                    <div id="display-image-div">
                                        <div class="display-image">
                                            <div class="input-group col-lg-4">
                                                <input type="file" name="image[]" class="display-image" multiple/> (max
                                                image: 4, max size: 2mb)
                                                --}}{{--<span class="input-group-btn">
                                                    <button class="btn btn-success" id="add">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                 <button class="btn btn-danger" id="remove" style="display: none">
                                                        <i class="material-icons">remove</i>
                                                    </button>
                                                </span>--}}{{--
                                            </div>
                                        </div>
                                    </div>--}}
                            </span>
                                <br>
                                <br>
                                <hr>
                                <div align="center">
                                    <input type="submit" class="btn btn-success">
                                    <input type="reset" class="btn btn-danger">
                                    <a href="{{ route('products.index') }}" class="btn btn-info">Go Back</a>
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

@section('scripts')
    <script src="{{ URL::asset('js/admin/spectrum.js') }}"></script>

    <script>
        $(".basic").spectrum({
            color: "#f00",
            change: function (color) {
                $("#basic-log").text("change called: " + color.toHexString());
                console.log('ok');
                console.log(color.toHexString());
                $('#custom-color').val(color.toHexString());
            }
        });
        $(document).ready(function () {
            if ($("input[name='set_size']").val() == 'yes') {
                $('#size-div').css('display', '');
            } else {
                $('#size-div').css('display', 'none');
            }

            if ($("input[name='set_color']").val() == 'yes') {
                $('#color-div').css('display', '');
            } else {
                $('#color-div').css('display', 'none');
            }
        });
        $(document).on('change', '#category', function () {
            categoryId = $(this).val();
            options = '';
            div = $(this).parent();
            $.ajax({
                type: 'GET',
                url: '/admin/subcategory/' + categoryId,
                success: function (data) {
                    options += '<option value="0" selected disabled>Select Subcategory</option>';
                    data.forEach(function (element) {
                        options += '<option value="' + element.id + '">' + element.title + '</option>';
                    });
                    $('#subcategory-div-1').css('display', '');
                    // $('#subcategory').html(options);
                    $('#subcategory_1').html("");
                    $('#subcategory_2').html("");
                    $('#subcategory_1').append(options);
                }, error: function (data) {
                    console.log('error');
                }
            })
        })

        $(document).on('change', '#subcategory_1', function () {
            subCategoryId = $(this).val();
            options = '';
            $.ajax({
                type: 'GET',
                url: '/admin/subcategory/' + subCategoryId,
                success: function (data) {
                    console.log('reached');
                    options += '<option value="0" selected disabled>Select Subcategory</option>';
                    data.forEach(function (element) {
                        options += '<option value="' + element.id + '">' + element.title + '</option>';
                        $('#subcategory-div-2').css('display', '');
                        // $('#subcategory').html(options);
                        $('#subcategory_2').html("");
                        $('#subcategory_2').append(options);
                    });
                }, error: function (data) {
                    console.log('error');
                }
            })
        });

        $("input[name='set_color']").change(function () {
            console.log($(this).val());
            if ($(this).val() == 'yes') {
                $('#color-div').css('display', '');
            } else {
                console.log('exited');
                $('#color-div').css('display', 'none');
            }
        });

        $("input[name='set_custom_color']").change(function () {
            console.log($(this).val());
            if ($(this).val() == 'yes') {
                $('#custom-color-div').css('display', '');
            } else {
                $('#custom-color-div').css('display', 'none');
            }
        });

        $("input[name='set_size']").change(function () {
            if ($(this).val() == 'yes') {
                $('#size-div').css('display', '');
            } else {
                $('#size-div').css('display', 'none');
            }
        });

        /*$('#add').on('click', function (e) {
            e.preventDefault();
            console.log($('.display-image').length);
            if ($('.display-image').length > 5) {
                $('#add').hide();
            } else {
                $('#display-image-div').append(
                    '<div class="display-image">' +
                    '<input type="file" name="image[]"/>' +
                    '</div>'
                );
            }

            $('#remove').css('display', '');
        });

        $('#display-image-div').on('click', '#remove', function (e) {
            e.preventDefault();
            $('.display-image').last().css('display', 'none').remove();
            console.log($('.display-image').length);

            $('#add').show();

            if ($('.display-image').length === 2) {
                $('#remove').hide();
            }
        })*/
    </script>
@endsection
