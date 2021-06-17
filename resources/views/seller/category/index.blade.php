@extends('seller.layouts.master')
@section('content')
    <div class="content">
        @include('admin.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">view_list</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Subcategories
                                <button class="btn btn-success btn-raised btn-fab btn-fab-mini" data-toggle="modal"
                                        data-target="#createModal">
                                    <i class="material-icons">add</i>
                                </button>
                            </h4>

                            <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                                 aria-labelledby="createModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
                                            <h4 class="modal-title">Create Subcategory</h4>
                                        </div>
                                        <form action="{{ route('category.store') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group is-empty">
                                                    <label class="control-label">Category</label>
                                                    <select class="form-control category" name="category" id="category">
                                                        @if(count($mainCategories) == 0)
                                                            <option value=null>No category available</option>
                                                        @else
                                                            <option value="">Select a category</option>
                                                            @foreach($mainCategories as $mainCategory)
                                                                <option value="{{$mainCategory->id}}">{{ $mainCategory->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group is-empty" id="subcategory-div-1" style="display:none">
                                                    <label class="control-label">Subcategory</label>
                                                    <select class="form-control" name="subcategory_1" id="subcategory_1">
                                                    </select>
                                                </div>

                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" name="title" class="form-control" required>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-simple">Create</button>
                                                <button type="button" class="btn btn-danger btn-simple"
                                                        data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                @if (count($subCategories) == 0)
                                    No subcategory available
                                @else
                                    <table class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Title</th>
                                            <th class="disabled-sorting">Actions</th>
                                        </tr>
                                        </thead>
                                        @foreach ($subCategories as $subCategory)
                                            <tr>
                                                <td>{{ $subCategory->id }}</td>
                                                <td>{{ $subCategory->title }}</td>
                                                <td>
                                                    <a href="{{ route('category.show', $subCategory->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                    <button class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                                            data-toggle="modal"
                                                            data-target="#editModal"
                                                            data-id="{{ $subCategory->id }}"
                                                            data-title="{{ $subCategory->title }}">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            data-id="{{ $subCategory->id }}">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->

                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                         aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    <h4 class="modal-title" id="modal-title">Edit Category</h4>
                                </div>
                                <form action="" id="editForm" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div class="modal-body">
                                        <div class="form-group is-empty">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title" id="category-title" class="form-control"
                                                   required>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-simple">Update</button>
                                        <button type="button" class="btn btn-danger btn-simple"
                                                data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-small ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                class="material-icons">clear</i></button>
                                </div>
                                <form id="deleteForm" action="" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="modal-body text-center">
                                        <h5>Are you sure you want to do this?</h5>
                                        <h5><span style="color: red">Warning</span>: All the products associated with this
                                            category will be deleted as well</h5>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-simple" data-dismiss="modal">No
                                        </button>
                                        <button type="submit" class="btn btn-success btn-simple">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col-md-12 -->
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">view_list</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Main Categories
                            </h4>
                            <div class="material-datatables">
                                @if (count($mainCategories) == 0)
                                    No category available
                                @else
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                       {{-- <tr>
                                            <th>S.N</th>
                                            <th>Title</th>
                                        </tr>--}}
                                        </thead>
                                        @foreach ($mainCategories as $mainCategory)
                                            <tr>
                                                {{--<td>{{ $mainCategory->id }}</td>--}}
                                                <td>{{ $mainCategory->title }}</td>
                                                <td> <a href="{{ route('category.show', $mainCategory->id) }}"
                                                            class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                    <i class="material-icons">search</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#editModal').on('show.bs.modal', function (e) {
                $('#category-title').val($(e.relatedTarget).data('title'));
                var categoryId = $(e.relatedTarget).data('id');
                var url = '{{ route("category.update", ":id") }}';
                url = url.replace(':id', categoryId);
                $('#editForm').attr('action', url);
            });
        });

        $(function () {
            $('#deleteModal').on('show.bs.modal', function (e) {
                var categoryId = $(e.relatedTarget).data('id');
                var url = '{{ route("category.destroy", ":id") }}';
                url = url.replace(':id', categoryId);
                $('#deleteForm').attr('action', url);
            })
        });

        $(document).on('change', '#category', function () {
            categoryId = $(this).val();
            console.log(categoryId);
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
                    $('#subcategory_1').append(options);
                }, error: function (data) {
                    console.log('error');
                }
            })
        });
    </script>
@endsection
