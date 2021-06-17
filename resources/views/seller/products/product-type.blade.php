@extends('seller.layouts.master')

@section('content')
    <style>
        .formStyle {
            display: inline
        }

        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f44336;
        }
    </style>
    <div class="content">
        @include('seller.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <ul class="nav nav-pills nav-pills-icons nav-pills-danger nav-stacked"
                                        role="tablist">
                                        <!--
                                            color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                        -->
                                        <li class="active">
                                            <a href="#dashboard-2" role="tab" data-toggle="tab">
                                                <i class="material-icons">dashboard</i>
                                                Select from existing products
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#schedule-2" role="tab" data-toggle="tab">
                                                <i class="material-icons">schedule</i>
                                                Add New Product
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-10">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="dashboard-2">
                                            @if (count($products) !== 0)
                                                <form action="{{ route('seller-product.add') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        @php $productCount = 0; @endphp
                                                        @foreach ($products as $product)
                                                            @if (!in_array($product->id, $sellerProductIds))
                                                                <div class="col-md-3">
                                                                    <label>
                                                                        <input type="radio" name="product_id"
                                                                               value="{{ $product->id }}"
                                                                               required>
                                                                        <img src="{{ asset($product->image) }}">
                                                                    </label>
                                                                    <h6 align="center">{{ $product->name }}</h6>
                                                                </div>
                                                                @php $productCount++; @endphp
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    @if ($productCount)
                                                        <hr>
                                                        <div align="right">
                                                            <button type="submit" class="btn btn-success">Next</button>
                                                        </div>
                                                    @else
                                                        <p>No Products Available</p>
                                                    @endif
                                                </form>
                                            @else
                                                <p>No products available</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="schedule-2" align="center">
                                            <div style="margin-top: 70px">
                                                <h6>Add a new product according to your specification</h6>
                                                <a href="{{ route('seller-product.create') }}"
                                                   class="btn btn-success" style="">Next</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </script>
@endsection
