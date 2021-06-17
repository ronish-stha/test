@extends('admin.layouts.master')

@section('content')
    <style>
        .formStyle {
            display: inline
        }
    </style>
    <div class="content">
        @include('admin.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">sports_bar</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Products
                                <div class="pull-right">
                                    <a href="{{ route('products.create') }}"
                                       class="btn btn-success btn-raised btn-just-icon pull-right" rel="tooltip"
                                       data-placement="bottom"
                                       data-original-title="Add Product">
                                        <i class="material-icons">add</i>
                                    </a>
                                </div>
                            </h4>
                            <div class="material-datatables">
                                @if (count($products) > 0)
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Brand</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Cover Image</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td class="text-center">{{ $product->id }}</td>
                                                <td class="text-center">
                                                    <a href="{{route('products.show',$product->id) }}">
                                                        <span class="label label-info">
                                                        {{ $product->name }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $product->brand }}</td>
                                                <td class="text-center">
                                                    <span class="label label-success">
                                                        Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($product->image)
                                                        <img class="thumbnail img-responsive"
                                                             src="{{URL::asset($product->image) }}"
                                                             alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                        />
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $product->category->title }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini"
                                                       style="color: white">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                       class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                                       style="color: white">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            data-id="{{ $product->id }}">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    No Product Available
                                @endif
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
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
@endsection

@section('scripts')
    <script>
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'order': [[0, 'desc']],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        var table = $('#datatables').DataTable();

        $('.card .material-datatables label').addClass('form-group');

        $(function () {
            $('#deleteModal').on('show.bs.modal', function (e) {
                var productId = $(e.relatedTarget).data('id');
                var url = '{{ route("products.destroy", ":id") }}';
                url = url.replace(':id', productId);
                $('#deleteForm').attr('action', url);
            })
        })
    </script>
@endsection
