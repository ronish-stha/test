@extends('admin.layouts.master')

@section('styles')
    <link href="{{ URL::asset('css/admin/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">edit</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Edit Content</h4>
                            <form action="{{ route('content.update', $content->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-lg-10 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">article</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Title
                                                    <small>*</small>
                                                </label>
                                                <input name="name" type="text" disabled class="form-control"
                                                       value="{{ old('title', $content->title) }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Heading 1 *
                                                </label>
                                                <input name="heading1" type="text" class="form-control"
                                                       value="{{ old('heading1', $content->heading1) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Heading 2 *
                                                </label>
                                                <input name="heading2" type="text" class="form-control"
                                                       value="{{ old('heading2', $content->heading2) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($content->id === 2 || $content->id === 3)
                                        <div class="col-lg-5 col-md-offset-1">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Heading 3 *
                                                    </label>
                                                    <input name="heading3" type="text" class="form-control"
                                                           value="{{ old('heading3', $content->heading3) }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>


                                @if ($content->id !== 1 && $content->id !== 5)
                                    <div class="row">
                                        <div class="col-lg-10 col-md-offset-1">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">receipt</i>
                                            </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Content 1 *
                                                    </label>
                                                    <textarea class="form-control" name="content1" id=""
                                                              id="article-ckeditor">{{ old('content1', $content->content1) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($content->id === 2)
                                        <div class="row">
                                            <div class="col-lg-10 col-md-offset-1">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">receipt</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Content 2 *
                                                        </label>
                                                        <textarea class="form-control" name="content2" id=""
                                                                  id="article-ckeditor">{{ old('content2', $content->content2) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 col-md-offset-1">
                                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">receipt</i>
                                            </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Content 3 *
                                                        </label>
                                                        <textarea class="form-control" name="content3" id=""
                                                                  id="article-ckeditor">{{ old('content3', $content->content3) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <hr>
                                @php
                                    $height = '200px';
                                    $width = '250px';
                                    switch($content->id) {
                                        case 2:
                                            $height = '100px';
                                            $width = '150px';
                                            break;
                                        case 3:
                                            $height = '200px';
                                            $width = '300px';
                                            break;
                                        case 4:
                                            $height = '200px';
                                            $width = '300px';
                                            break;
                                        case 5:
                                            $height= '200px';
                                            $width = '450px';
                                            break;
                                    }
                                @endphp
                                <div class="row">
                                    <div class="alert alert-warning col-md-10 col-md-offset-1" data-notify="container">
                                        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span data-notify="message">Note: Make to sure to upload images of the right resolution. Images with incompatible resolution might disrupt the view/layout.</span>
                                    </div>
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group col-md-12">
                                            <div class="form-group">
                                                <div class="form-group is-empty is-fileinput">
                                                    <input type="file" name="image1" id="inputFile4" multiple="">
                                                    <div class="input-group col-md-12">
                                                         <span class="input-group-addon">
                                                            <i class="material-icons">image</i>
                                                         </span>
                                                        <input type="text" readonly="" class="form-control"
                                                               placeholder="Image 1 *">
                                                        <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <img src="{{URL::asset($content->image1)}}" style="height:{{ $height }};
                                                    width:{{ $width }};">
                                            </div>
                                        </div>
                                    </div>
                                    @if ($content->id === 1 || $content->id === 2)
                                        <div class="col-lg-5">
                                            <div class="input-group col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group is-empty is-fileinput">
                                                        <input type="file" name="image2" id="inputFile4" multiple="">
                                                        <div class="input-group col-md-12">
                                                         <span class="input-group-addon">
                                                            <i class="material-icons">image</i>
                                                         </span>
                                                            <input type="text" readonly="" class="form-control"
                                                                   placeholder="Image 2 *">
                                                            <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($content->image2)
                                                <img src="{{ URL::asset($content->image2) }}" style="height:{{ $height }};
                                                        width:{{ $width }};">
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @if ($content->id === 2)
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-5 col-lg-offset-1">
                                            <div class="input-group col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group is-empty is-fileinput">
                                                        <input type="file" name="image3" id="inputFile4" multiple="">
                                                        <div class="input-group col-md-12">
                                                         <span class="input-group-addon">
                                                            <i class="material-icons">image</i>
                                                         </span>
                                                            <input type="text" readonly="" class="form-control"
                                                                   placeholder="Image 3 *">
                                                            <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($content->image3)
                                                <div class="col-lg-offset-1">
                                                    <img src="{{URL::asset($content->image3)}}" style="height:{{ $height }};
                                                width:{{ $width }};">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <hr>
                                <br>
                                <br>
                                <div align="center">
                                    <input type="submit" class="btn btn-success">
                                    <a href="{{ route('content.index') }}" class="btn btn-info">Go Back</a>
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
