@extends('frontend.layout.master')

@section('styles')
    <style>
        .bodycss {
            background: #eeeeee;
        }

        .invoice-container {
            background: white;
            box-shadow: 0px 5px 10px #88888860;
            padding: 50px 50px;
            min-height: 100vh;
            width: 22cm;
            padding-bottom: 100px;
            /* border: 3px solid #22222240;
            border-radius: 5px; */
        }

        ul {
            list-style: none;
            font-size: 12px;
            padding-left: 0;
        }

        tbody {
            min-height: 200px;
        }

        .table td, .table th {
            border-top: none;
            border-right: 1px solid #22222240;
            border-left: 1px solid #22222240;
        }

        .invoice {
            padding: 5px 5px;
            text-align: center;
            background-color: #dddddd;
            font-size: 20px;
        }

        .information {
            margin-top: 30px;
        }

        .logo img {
            float: right;
            height: 29px;
            margin-top: 20px;
            padding-right: 20px;
        }

        h4 {
            background: #dddddd;
            padding: 5px 5px;
            text-align: center;
            font-size: 14px;
            margin-bottom: 0;
        }

        .table td, .table th {
            padding: 0.3rem;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    {{--    @include('frontend.includes.breadcumb')--}}
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
         style=" height: 200px; background-image: url(../../frontend/img/banner/breadcumb.jpg)">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2> Thank You</h2>
                <ul>
                    <li><a href="{{ route('index') }}">home</a></li>
                    <li>Thank You</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container invoice-container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>Thank you for shopping with us</p>
                    <h3 class="invoice"><strong>Invoice</strong></h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="logo">
                                <img src="{{URL::asset('frontend/img/logo/2.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row information">
                        <div class="col-md-6" style="margin-top: -40px">
                            <ul>
                                <li><p><strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                                    </p></li>
                                <li>{{ auth()->user()->address }} <span>{{ auth()->user()->city }}</span></li>
                                <li>tel: {{ auth()->user()->phone }}</li>
                                <li>email: {{ auth()->user()->email }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6" style="text-align: right; margin-top:40px">
                            <ul>
                                <li><p><strong>Liquor Store</strong></p></li>
                                <li>email: test@liquorstore.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul>
                                <li><strong>Order ID: {{ $order->id }}</strong></li>
                                <li>Order Date: {{ $order->created_at->format('Y-m-d') }}</li>
                                <li>Delivery
                                    Date: {{ \Carbon\Carbon::parse($order->created_at)->addDays(1)->format('Y-m-d') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><strong>Invoice Detail</strong></h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Particulars</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td class="text-center">{{ $loop->count }}</td>
                                        <td class="text-center">{{ $orderDetail->productVariant->name }}</td>
                                        <td class="text-center">{{ $orderDetail->quantity }}</td>
                                        <td class="text-center">{{ $orderDetail->productVariant->price }}</td>
                                        <th class="text-center">{{ $orderDetail->total }}</th>
                                    </tr>
                                @endforeach
                                <tr style="border-top: 1px solid #22222240">
                                    <td colspan="4" style="text-align: right"><strong>Sub-Total</strong></td>
                                    <td><strong>{{ $order->total }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right"><strong>Discount</strong></td>
                                    <td><strong>Rs. {{ $order->discount ? $order->discount : 0 }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right"><strong>Service Charge</strong></td>
                                    <td><strong>Rs. {{ $order->service_charge ? $order->service_charge : 0 }}</strong></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #22222240">
                                    <td colspan="4" style="text-align: right"><strong>Total</strong></td>
                                    <td><strong>{{ $order->total }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
