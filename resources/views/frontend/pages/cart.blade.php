@extends('frontend.layout.master')
@section('styles')
    <style>
        .order-summary {
            margin-top: 30px;
        }

        .order-summary td {
            text-align: right
        }

        .cart-table tr {
            border-bottom: 1px solid #22222240
        }

        .cart-page-total {
            padding-top: 0;
            margin-top: -44px;
            margin-right: 40px;
        }
    </style>
@endsection
@section('content')
    {{--    @include('frontend.includes.breadcumb')--}}
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
         style=" height: 200px; background-image: url(../../frontend/img/banner/breadcumb.jpg)">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2> cart</h2>
                <ul>
                    <li><a href="#">home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-95 pb-100" style="background: #eeeeee">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"
                 style="background: white; padding: 50px 50px; margin-top: -35px;">
                <h1 class="cart-heading">Cart</h1>

                @if (count(Cart::instance('cart')->content()) == 0)
                    <p>Your cart is empty</p>
                @else
                    {{--                        <form action="#">--}}
                    <div class="table-content table-responsive">
                        <table class="cart-table">

                            <tbody>
                            @foreach (Cart::instance('cart')->content() as $productVariant)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            @if ($productVariant->model->parentVolume->image)
                                                <img src="{{ URL::asset($productVariant->model->parentVolume->image) }}"
                                                     alt="">
                                            @else
                                                <img src="{{ URL::asset($productVariant->model->product->image) }}"
                                                     alt="">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <ul>
                                            <li><a href="#">{{ $productVariant->model->name }}</a></li>
                                            <li>
                                                <form action="{{ route('cart.destroy', $productVariant->rowId) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="button-no-style" type="submit" style="color:#e12121">
                                                        Remove
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="product-quantity">
                                        <input value="{{ $productVariant->qty }}" type="number" readonly>
                                    </td>
                                    <td class="product-subtotal">
                                        Rs.{{ $productVariant->price * $productVariant->qty }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="cart-page-total" style="right: 0; position: absolute;">
                            <a href="{{ route('checkout') }}">Proceed to checkout</a>
                        </div>

                    </div>
                @endif
            </div>
            <div class="col-md-4" style="padding-right: 35px; padding-left:30px" id="orderSummaryDiv">
                <h4><strong>Order Summary</strong></h4>
                <table style="width: 100%" class="order-summary">
                    <tbody style="width: 100%">
                    <tr>
                        <th>Product Subtotal</th>
                        <td>Rs. {{ Cart::subtotal() }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>Rs. {{ $discount ? $discount : 0 }}</td>
                    </tr>
                    <tr>
                        <th>Service Charge</th>
                        <td>Rs. {{ $serviceCharge ? $serviceCharge : 'Rs. 0' }} (10%)</td>
                    </tr>
                    </tbody>
                </table>
                <p style="text-align: justify; margin-top: 30px; border-bottom: 1px solid #22222240">Please consider
                    giving your driver a big thank you and a thoughtful tip for their extra hard work during this
                    time.</p>
                <h5 style="float: right; margin-bottom:20px;"><strong>Total :
                        <span>{{ $total }}</span></strong></h5>
                <div class="coupon-all">
                    <div class="coupon">
                        <form action="{{ route('coupon.redeem') }}" method="post" id="couponForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input class="input-text" name="code" id="couponCode" value=""
                                   placeholder="Coupon code" type="text" style="width: 40%">
                            <input class="button" name="apply_coupon" value="Apply coupon"
                                   type="submit" style="width: 50%" id="couponButton">
                        </form>
                    </div>
                    <br>
                    <br>
                    <br>
                    <h6 style="color: #e12c2c" id="alertMessage"></h6>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#couponButton').on('click', function (e) {
            e.preventDefault();
            $('#alertMessage').empty();
            let url = $('#couponForm').attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "_token": $('#token').val(),
                    'code': $('#couponCode').val()
                },
                beforeSend: function () {

                },
                success: function (res) {
                    if (res.status) {
                        location.reload();
                    } else {
                        $('#alertMessage').text(res.msg);
                    }
                },
                error: function () {
                    console.log('error')
                    $('#alertMessage').text('Offer could not be redeemed at the moment')
                }
            })
        });
    </script>
@endsection
