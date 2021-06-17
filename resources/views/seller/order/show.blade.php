@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('seller.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">add_shopping_cart</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">
                                {{ $sellerOrder->status != 'approved' ? 'Order' : 'Sale' }} Details
                            </h4>
                            <br>
                            <div class="col-md-offset-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Name </strong>{{ $sellerOrder->order->user->first_name }} {{ $sellerOrder->order->user->last_name }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email </strong>{{ $sellerOrder->order->user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Address </strong>{{ $sellerOrder->order->user->address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $alert = null; @endphp
                                        @if ($sellerOrder->status)
                                            @switch ($sellerOrder->status)
                                                @case ('new')
                                                @php $alert = 'warning'; @endphp
                                                @break
                                                @case ('approved')
                                                @php $alert = 'info'; @endphp
                                                @break
                                                @case ('Complete')
                                                @php $alert = 'success'; @endphp
                                                @break
                                            @endswitch
                                        @endif
                                        <p>
                                            <strong>Status </strong> <span class="label label-{{ $alert }}"
                                                                           rel="tooltip">
                                                            {{ ucfirst($sellerOrder->status) }}</span>
                                        </p>
                                    </div>
                                </div>


                                {{--<div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Location </strong>{{ $sellerOrder->order->user->location ? $sellerOrder->order->user->location : '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Post
                                                Code </strong>{{ $sellerOrder->order->user->post_code ? $sellerOrder->order->user->post_code : '-' }}
                                        </p>
                                    </div>
                                </div>--}}

                                {{--<div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Phone</strong>{{ $sellerOrder->order->user->phone1 }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Phone2 </strong>{{ $sellerOrder->order->user->phone2 ? $sellerOrder->order->user->phone2 : '-'}}
                                        </p>
                                    </div>
                                </div>--}}

                                <p><strong>Purchase Date </strong>{{ Helper::getTime($sellerOrder->created_at) }}
                                    , {{ Helper::getFormattedDate($sellerOrder->created_at) }}</p>

                                @if ($sellerOrder->description)
                                    <p><strong>Description </strong>{{ $sellerOrder->description }}</p>
                                @endif
                            </div>
                            @if ($sellerOrder->status != 'approved')
                                <div class="pull-right">
                                    <form action="{{ route('seller-order.approve', $sellerOrder->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" rel="tooltip" data-placement="bottom" title="Approve"
                                                class="btn btn-success btn-raised btn-fab btn-fab-mini">
                                            <i class="material-icons">done</i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <hr>
                            <div class="material-datatables col-md-offset-2 col-md-8">
                                <h4 class="text-center">Order Details</h4>
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
                                    @foreach ($sellerOrder->orderDetails as $productDetail)
                                        <tr>
                                            <td class="text-center">{{ $productDetail->productVariant->id }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('seller-product.view-product-variant', $productDetail->productVariant->id) }}">
                                                    {{ $productDetail->productVariant->name }}
                                                </a></td>
                                            <td class="text-center">{{ $productDetail->quantity }}</td>
                                            <td class="text-center">{{ $productDetail->productVariant->price }}</td>
                                            <td class="text-center">Rs. {{ $productDetail->total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Rs. {{ $sellerOrder->discount ? $sellerOrder->discount : 0 }}</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Service Charge</th>
                                        <th class="text-center">Rs. {{ $sellerOrder->service_charge ? $sellerOrder->service_charge : 0 }}</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Rs. {{ $sellerOrder->total }}</th>
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
