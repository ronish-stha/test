@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">credit_card</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">
                                {{ $sale->status != 'approved' ? 'Order' : 'Sale' }} Details
                            </h4>
                            <br>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Name </strong>{{ $sale->user->first_name }} {{ $sale->user->last_name }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email </strong>{{ $sale->user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Address </strong>{{ $sale->user->address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Apartment </strong>{{ $sale->user->apartment ? $sale->user->apartment : '-' }}
                                        </p>~
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Location </strong>{{ $sale->user->location ? $sale->user->location : '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Post
                                                Code </strong>{{ $sale->user->post_code ? $sale->user->post_code : '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Phone</strong>{{ $sale->user->phone1 }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Phone2 </strong>{{ $sale->user->phone2 ? $sale->user->phone2 : '-'}}
                                        </p>
                                    </div>
                                </div>

                                <p><strong>Purchase Date </strong>{{ $sale->created_at }}</p>

                                @if ($sale->description)
                                    <p><strong>Description </strong>{{ $sale->description }}</p>
                                @endif
                            </div>
                            @if ($sale->status != 'approved')
                                <div class="pull-right">
                                    <a href="{{ route('order.approve', $sale->id) }}" type="button"
                                       class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                       rel="tooltip" data-placement="bottom" title="Approve">
                                        <i class="material-icons">done</i>
                                    </a>
                                </div>
                            @endif
                            <hr>
                            <div class="material-datatables col-md-offset-1 col-md-9">
                                <h4 class="text-center">Product Details</h4>
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                       cellspacing="0" width="100%" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Product Id</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">SubTotal</th>
                                        {{--<th class="text-center">Discount</th>--}}
                                    </tr>
                                    </thead>
                                    @foreach ($sale->saleDetails as $productDetail)
                                        <tr>
                                            <td class="text-center">{{ $productDetail->product->id }}</td>
                                            <td class="text-center"><a
                                                        href="{{ route('products.show', $productDetail->product->id) }}">
                                                    {{ $productDetail->product->name }}
                                                </a></td>
                                            <td class="text-center">{{ $productDetail->quantity }}</td>
                                            <td class="text-center">{{ $productDetail->product->price }}</td>
                                            <td class="text-center">{{ $productDetail->price }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">{{ $sale->total }}</th>
                                    </tr>
                                </table>
                                <br>
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
@endsection
