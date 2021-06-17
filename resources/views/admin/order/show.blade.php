@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">add_shopping_cart</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">
                                Order Details
                            </h4>
                            <br>
                            <div class="col-md-offset-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Name </strong>{{ $order->user->first_name }} {{ $order->user->last_name }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email </strong>{{ $order->user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Address </strong>{{ $order->user->address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $alert = null; @endphp
                                        @if ($order->status)
                                            @switch ($order->status)
                                                @case ('new')
                                                @php $alert = 'warning'; @endphp
                                                @break
                                                @case ('processing')
                                                @php $alert = 'warning'; @endphp
                                                @break
                                                @case ('approved')
                                                @php $alert = 'info'; @endphp
                                                @break
                                                @case ('complete')
                                                @php $alert = 'success'; @endphp
                                                @break
                                            @endswitch
                                        @endif
                                        <p>
                                            <strong>Status </strong> <span class="label label-{{ $alert }}"
                                                                           rel="tooltip">
                                                            {{ ucfirst($order->status) }}</span>
                                        </p>
                                    </div>
                                </div>


                                {{--<div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Location </strong>{{ $order->user->location ? $order->user->location : '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Post
                                                Code </strong>{{ $order->user->post_code ? $order->user->post_code : '-' }}
                                        </p>
                                    </div>
                                </div>--}}

                                {{--<div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Phone</strong>{{ $order->user->phone1 }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Phone2 </strong>{{ $order->user->phone2 ? $order->user->phone2 : '-'}}
                                        </p>
                                    </div>
                                </div>--}}

                                <p><strong>Purchase Date </strong>{{ Helper::getTime($order->created_at) }}
                                    , {{ Helper::getFormattedDate($order->created_at) }}</p>

                                @if ($order->description)
                                    <p><strong>Description </strong>{{ $order->description }}</p>
                                @endif
                            </div>
                            <hr>
                            <div class="material-datatables col-md-offset-2 col-md-8">
                                <h4 class="text-center">Order Details</h4>
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                       cellspacing="0" width="100%" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Product Id</th>
                                        <th class="text-center">Seller</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">SubTotal</th>
                                        {{--<th class="text-center">Discount</th>--}}
                                    </tr>
                                    </thead>
                                    @foreach ($order->orderDetails as $orderDetail)
                                        <tr>
                                            <td class="text-center">{{ $orderDetail->productVariant->id }}</td>
                                            <td class="text-center">{{ $orderDetail->productVariant->user->sellerDetail->store_name }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('products.show', $orderDetail->productVariant->id) }}">
                                                    {{ $orderDetail->productVariant->name }}
                                                </a></td>
                                            <td class="text-center">{{ $orderDetail->quantity }}</td>
                                            <td class="text-center">
                                                @php $alert = null; @endphp
                                                @if ($orderDetail->status)
                                                    @switch ($orderDetail->status)
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
                                                <span class="label label-{{ $alert }}" rel="tooltip">
                                                            {{ ucfirst($orderDetail->status) }}</span>
                                            <td class="text-center">Rs. {{ $orderDetail->productVariant->price }}</td>
                                            <td class="text-center">Rs. {{ $orderDetail->total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Rs. {{ $order->discount ? $order->discount : 0 }}</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Service Charge</th>
                                        <th class="text-center">Rs. {{ $order->service_charge ? $order->service_charge : 0 }}</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Rs. {{ $order->total }}</th>
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
