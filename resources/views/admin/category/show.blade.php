@extends('admin.layouts.master')
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
                            <h4 class="card-title">{{ $category->title }}
                            </h4>

                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                <ul>
                                    @if ($category->hasChildren())
                                        @foreach ($category->getChildren() as $children)
                                            <li>{{ $children->title }}</li>
                                            @if ($children->hasChildren())
                                                <ul>
                                                    @foreach($children->getChildren() as $grandChildren)
                                                        <li>{{ $grandChildren->title }}</li>
                                                        @if ($grandChildren->hasChildren())
                                                            <ul>
                                                                @foreach($grandChildren->getChildren() as $greatGrandChildren)
                                                                    <li>{{ $greatGrandChildren->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                                {{--<button class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        data-id="{{ $category->id }}"
                                        data-title="{{ $category->title }}">
                                    <i class="material-icons">build</i>
                                </button>--}}
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
                                        <h5><span style="color: red">Warning</span>: All the products associated with
                                            this
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
        })
    </script>
@endsection