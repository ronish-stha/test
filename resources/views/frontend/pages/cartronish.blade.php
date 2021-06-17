@extends('frontend.layout.master')
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
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">Cart</h1>

                    @if (count(Cart::instance('cart')->content()) == 0)
                        <p>Your cart is empty</p>
                    @else
                        {{--                        <form action="#">--}}
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>remove</th>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (Cart::instance('cart')->content() as $productVariant)
                                    <tr>
                                        <td class="product-remove">
                                            <form action="{{ route('cart.destroy', $productVariant->rowId) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button-no-style" type="submit">
                                                    <i class="pe-7s-close"></i></button>
                                            </form>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{ URL::asset($productVariant->model->parentVolume->image) }}"
                                                             alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $productVariant->model->name }}</a></td>
                                        <td class="product-price-cart"><span
                                                class="amount">Rs.{{ $productVariant->model->price }}</span></td>
                                        <td class="product-quantity">
                                            <input value="{{ $productVariant->qty }}" type="number" readonly>
                                        </td>
                                        <td class="product-subtotal">Rs.{{ $productVariant->price * $productVariant->qty }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                               placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon"
                                               type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart total</h2>
                                    <ul>
                                        <li>Subtotal<span>{{ Cart::subtotal() }}</span></li>
                                        <li>Total<span>{{ Cart::subtotal() }}</span></li>
                                    </ul>
                                    <a href="{{ route('checkout') }}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                        {{--                        </form>--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
