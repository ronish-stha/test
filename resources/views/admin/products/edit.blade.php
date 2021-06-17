@extends('admin.layouts.master')

@section('styles')
    <link href="{{ URL::asset('css/admin/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">edit</i>
                        </div>
                        <div class="card-content">
                            @include('admin.includes.message')
                            <h4 class="card-title align:cen">Edit Product</h4>
                            <form action="{{ route('products.update', $product->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
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
                                                       value="{{ old('name', $product->name) }}" autofocus>
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
                                                       value="{{ old('brand', $product->brand) }}">
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
                                                       value="{{ old('code', $product->code) }}">
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
                                                       value="{{ old('price', $product->price) }}">
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
                                                       value="{{ old('quantity', $product->quantity) }}">
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
                                                       value="{{ old('discount', $product->discount) }}" autofocus>
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
                                                       value="{{ old('volume', $product->volume) }}" autofocus>
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
                                <div class="col-lg-offset-1">
                                    <img src="{{URL::asset($product->cover_image)}}" style="height:110px;
                                         width:100px;">
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
                                <div class="col-lg-offset-1">
                                    @foreach($product->images as $image)
                                        <img src="{{URL::asset($image->image)}}"
                                            style="height:110px;width:100px;">
                                    @endforeach
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
                                                          id="article-ckeditor">{{ old('description', $product->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <hr>
                                <div align="center">
                                    <input type="submit" class="btn btn-success">
                                    <input type="reset" class="btn btn-danger">
                                    <a href="admin/dashboard" class="btn btn-info">Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        $(document).on('change', '#category', function () {
            categoryId = $(this).val();
            options = '';
            div = $(this).parent();
            $.ajax({
                type: 'GET',
                url: '/admin/subcategory/' + categoryId,
                success: function (data) {
                    options += '<option value="0" selected disabled>Select Subcategory</option>';
                    options2 += '<option value="0" selected disabled>Select Subcategory</option>';
                    data.forEach(function (element) {
                        options += '<option value="' + element.id + '">' + element.title + '</option>';
                    });
                    // $('#subcategory').html(options);
                    $('#subcategory_1').html("");
                    $('#subcategory_2').html("");
                    $('#subcategory_1').append(options);
                    $('#subcategory_2').append(options2);
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
                        // $('#subcategory').html(options);
                        $('#subcategory_2').html("");
                        $('#subcategory_2').append(options);
                    });
                }, error: function (data) {
                    console.log('error');
                }
            })
        })

        $("input[name='set_color']").change(function () {
            console.log($(this).val());
            if ($(this).val() == 'yes') {
                console.log('entered');
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
    </script>
@endsection
