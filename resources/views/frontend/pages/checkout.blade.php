@extends('frontend.layout.master')

@section('styles')
    <style>
        .order-button-payment a {
            background: #464646 none repeat scroll 0 0 !important;
            border: medium none !important;
            color: #fff !important;
            font-size: 17px;
            font-weight: 600;
            height: 50px;
            margin: 20px 0 0;
            padding: 0;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
            width: 100%;
            border: 1px solid transparent !important;
            cursor: pointer;
        }

        .order-button-payment a:hover {
            background: #e12c2c;
            border: 1px solid #e12c2c;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
         style=" height: 200px; background-image: url(../../frontend/img/banner/breadcumb.jpg)">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2>Products</h2>
                <ul>
                    <li><a href="{{ route('index') }}">home</a></li>
                    <li><a href="{{ route('checkout') }}">checkout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="coupon-accordion">
                        <!-- ACCORDION START -->
                        @if (!Auth::user())
                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                        @endif
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed
                                    est sit amet ipsum luctus.</p>
                                <form action="#">
                                    <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text"/>
                                    </p>
                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="text"/>
                                    </p>
                                    <p class="form-row">
                                        <input type="submit" value="Login"/>
                                        <label>
                                            <input type="checkbox"/>
                                            Remember me
                                        </label>
                                    </p>
                                    <p class="lost-password">
                                        <a href="#">Lost your password?</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <!-- ACCORDION END -->

                    </div>
                </div>
            </div>
            <form action="{{ route('post.checkout') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                {{--<div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Country <span class="required">*</span></label>
                                        <input type="text" value="Nepal" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input type="text" placeholder="" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" placeholder="" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input type="text" placeholder=""/>
                                    </div>
                                </div>--}}
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" name="address" value="Hattisar" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="city"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Province <span class="required">*</span></label>
                                        <input type="text" placeholder="" name="province"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>District <span class="required">*</span></label>
                                        <input type="text" name="district"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Zone <span class="required">*</span></label>
                                        <input type="text" placeholder="" name="zone"/>
                                    </div>
                                </div>
                                {{--<div class="col-md-12">
                                    <div class="checkout-form-list create-acc">
                                        <input id="cbox" type="checkbox"/>
                                        <label>Create an account?</label>
                                    </div>
                                    <div id="cbox_info" class="checkout-form-list create-account">
                                        <p>Create an account by entering the information below. If you are a returning
                                            customer please login at the top of the page.</p>
                                        <label>Account password <span class="required">*</span></label>
                                        <input type="password" placeholder="password"/>
                                    </div>
                                </div>--}}
                            </div>
                            {{--<div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox"/>
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Country <span class="required">*</span></label>
                                            <input type="text" value="Nepal" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input type="text" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="Town / City"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input type="text" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list mrg-nn">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10"
                                                  placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (Cart::instance('cart')->content() as $productVariant)
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                {{ $productVariant->model->name }}
                                                <strong class="product-quantity"> × {{ $productVariant->qty }}</strong>
                                            </td>
                                            <td class="product-total">
                                            <span
                                                class="amount">Rs.{{ $productVariant->price * $productVariant->qty }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">Rs. {{ Cart::subtotal() }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Discount</th>
                                        <td><span class="amount">Rs. {{ $discount ? $discountAmount . '(' . $discount . '%)' : 0 }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Service Charge</th>
                                        <td><span class="amount">Rs. {{ $serviceCharge ? $serviceCharge . '(10%)' : 0 }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">Rs. {{ $total }}</span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div class="panel-group" id="faq">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <input type="radio" name="payment_type" id="" value="paypal">
                                                    </div>
                                                    <h5 class="panel-title" style="display: flex; justify-content: center; align-items: center">
                                                        Paypal</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <input type="radio" name="payment_type" id="" value="cash on delivery">
                                                    </div>
                                                    <h5 class="panel-title" style="display: flex; justify-content: center; align-items: center">
                                                        Cash on Delivery</h5>
                                                </div>
                                            </div>
                                            <div id="payment-2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        @if (Auth::user())
                                            <input type="submit" value="Place order"/>
                                        @else
                                            <input type="button" value="Log in to continue" id="login"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#login').on('click', function () {
            console.log('clicked');
            location.href = '{{ route('login') }}';
        })
    </script>
@endsection
