@extends('seller.layouts.master')

@section('content')
    <style>
        .formStyle {
            display: inline
        }
    </style>
    <div class="content">
        @include('seller.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">sports_bar</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Products
                                <div class="pull-right">
                                    <button
                                       class="btn btn-danger btn-raised btn-just-icon pull-right" rel="tooltip"
                                       data-placement="bottom"
                                       data-toggle="modal"
                                       data-target="#bulkDeleteModal"
                                       data-original-title="Bulk Delete">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    <a href="{{ route('seller-product.type') }}"
                                       class="btn btn-success btn-raised btn-just-icon pull-right" rel="tooltip"
                                       data-placement="bottom"
                                       data-original-title="Add Product">
                                        <i class="material-icons">add</i>
                                    </a>
                                </div>
                            </h4>
                            <div class="material-datatables">
                                @if ($counter != 0)
                                    <form action="{{ route('seller-product.delete-bulk') }}" method="post" id="bulkDeleteForm">
                                        {{ csrf_field() }}
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                               cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">S.N</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Parent Product</th>
                                                {{--                                            <th class="text-center">Brand</th>--}}
                                                <th class="text-center">Volume</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Image</th>
                                                {{--                                            <th class="text-center">Category</th>--}}
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($productVariants as $product)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="select[]" required
                                                                                   value="productvariant-{{ $product->id }}">
                                                    </td>
                                                    <td class="text-center">{{ $product->id }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-product-variant', $product->id) }}">
                                                        <span class="label label-info">
                                                        {{ $product->name }}
                                                        </span>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-product-variant', $product->product->id) }}">
                                                        <span class="label label-info">
                                                        {{ $product->product->name }}
                                                        </span>
                                                        </a>
                                                    </td>
                                                    {{--                                                <td class="text-center">{{ $product->sellerProduct->brand }}</td>--}}
                                                    <td class="text-center">{{ $product->parentVolume->volume }} ml</td>
                                                    <td class="text-center">
                                                    <span class="label label-success">
                                                        Rs. {{ $product->price }}
                                                    </span>
                                                    </td>
                                                    <td>
                                                        @if ($product->parentVolume->image)
                                                            <img class="thumbnail img-responsive"
                                                                 src="{{URL::asset($product->parentVolume->image) }}"
                                                                 alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                            />
                                                        @else
                                                            @if ($product->product->image)
                                                                <img class="thumbnail img-responsive"
                                                                     src="{{URL::asset($product->product->image) }}"
                                                                     alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                                />
                                                            @endif
                                                        @endif
                                                    </td>
                                                    {{--                                                <td class="text-center">{{ $product->sellerProduct->category->title }}</td>--}}
                                                    <td class="text-center">
                                                    <span
                                                        class="label label-{{ ($product->status ? 'success' : !$product->is_rejected) ? 'info' : 'danger' }}">
                                                        {{ ($product->status ? 'Accepted' : !$product->is_rejected) ? 'Pending' : 'Rejected' }}
                                                    </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-product-variant', $product->id) }}"
                                                           class="btn btn-info btn-raised btn-fab btn-fab-mini"
                                                           style="color: white">
                                                            <i class="material-icons">search</i>
                                                        </a>
                                                        <a href="{{ route('seller-product.edit-product-variant', $product->id) }}"
                                                           class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                                           style="color: white">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal"
                                                                data-type="productvariant"
                                                                data-id="{{ $product->id }}">
                                                            <i class="material-icons">clear</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach($sellerProductVariants as $product)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="select[]" required
                                                                                   value="sellerproductvariant-{{ $product->id }}">
                                                    </td>
                                                    <td class="text-center">{{ $product->id }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-seller-product-variant', $product->id) }}">
                                                        <span class="label label-info">
                                                        {{ $product->name }}
                                                        </span>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-seller-product-variant', $product->sellerProduct->id) }}">
                                                        <span class="label label-info">
                                                        {{ $product->sellerProduct->name }}
                                                        </span>
                                                        </a>
                                                    </td>
                                                    {{--                                                <td class="text-center">{{ $product->sellerProduct->brand }}</td>--}}
                                                    <td class="text-center">{{ $product->sellerVolume->volume }} ml</td>
                                                    <td class="text-center">
                                                    <span class="label label-success">
                                                        Rs. {{ $product->price }}
                                                    </span>
                                                    </td>
                                                    <td>
                                                        @if ($product->SellerVolume->image)
                                                            <img class="thumbnail img-responsive"
                                                                 src="{{ URL::asset($product->SellerVolume->image) }}"
                                                                 alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                            />
                                                        @else
                                                            @if ($product->sellerProduct->image)
                                                                <img class="thumbnail img-responsive"
                                                                     src="{{URL::asset($product->sellerProduct->image) }}"
                                                                     alt="" style="height:110px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                                />
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                    <span
                                                        class="label label-{{ ($product->status ? 'success' : !$product->is_rejected) ? 'info' : 'danger' }}">
                                                        {{ ($product->status ? 'Accepted' : !$product->is_rejected) ? 'Pending' : 'Rejected' }}
                                                    </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('seller-product.view-seller-product-variant', $product->id) }}"
                                                           class="btn btn-info btn-raised btn-fab btn-fab-mini"
                                                           style="color: white">
                                                            <i class="material-icons">search</i>
                                                        </a>
                                                        <a href="{{ route('seller-product.edit-seller-product-variant', $product->id) }}"
                                                           class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                                           style="color: white">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal"
                                                                data-type="sellerproductvariant"
                                                                data-id="{{ $product->id }}">
                                                            <i class="material-icons">clear</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
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
                    <input type="hidden" name="type" id="variant-type" value="">
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

    <div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-small ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="material-icons">clear</i></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Are you sure you want delete the products?</h5>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-simple" data-dismiss="modal">No
                    </button>
                    <button type="submit" class="btn btn-success btn-simple" id="confirmBulkDelete">Yes</button>
                </div>
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
                $('#variant-type').val($(e.relatedTarget).data('type'))
                var url = '{{ route("seller-product.destroy", ":id") }}';
                url = url.replace(':id', productId);
                $('#deleteForm').attr('action', url);
            })
        })

        $('#confirmBulkDelete').on('click', function () {
            $('#bulkDeleteForm').submit();
        })
    </script>
@endsection
