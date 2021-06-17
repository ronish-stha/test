@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">add</i>
                        </div>
                        <div class="card-content">
                            @include('admin.includes.message')
                            <h4 class="card-title align:cen">Edit Category</h4>

                            <form action="{{ route('category.update', $subCategory->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label>Category</label>
                                            <select class="form-control category" name="category" id="category">
                                                @if(count($categories) == 0)
                                                    <option value=null>No category available</option>
                                                @else
                                                    <option value="">Select a category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{ $category->title }}</option>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                   value="{{ old('title') }}">
                                        </div>
                                    </div>
                                </div>

                                <div align="center">
                                    {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                                    {{Form::reset('Reset', ['class' => 'btn btn-danger'])}}
                                    <a href="admin/dashboard" class="btn btn-info">Go Back</a>
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
    <script>
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
        })
    </script>
@endsection