<div class="notification-section notification-section-padding-2 notification-img-3">
    <div class="container-fluid">
        <div class="notification-wrapper">
            <div class="notification-pera-graph-3">
                <p>Get your Liquors on your Doorsteps from your own vendor. </p>
            </div>
            <div class="notification-btn-close">
                <div class="notification-btn-3">
                    <a href="{{ route('seller.login')}}">Become a Partner</a>
                </div>
            </div>
            <div class="notification-btn-close">
                <div class="notification-btn-3">
                    @if (!Auth::user())
                        <a href="{{ route('signup') }}">Signup</a>/<a href="{{ route('signup') }}">SignIn</a>
                    @else
                        @if (Auth::user()->user_type_id == 2)
                            <a href="{{ route('account') }}">My Account</a>
                        @elseif (Auth::user()->user_type_id == 3 && Auth::user()->status && Auth::user()->verified)
                            <a href="{{ route('store.product', Auth::user()->id) }}">My Store</a>
                        @else
                            <a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                        @endif
                        <a href="#" onclick="$('#logoutForm').submit();">Logout</a>
                        <form action="{{ route('customer.logout') }}" method="post"
                              id="logoutForm">{{ csrf_field() }}</form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <div class="header-top-furniture wrapper-padding-2 res-header-sm">
        <div class="container-fluid">
            <div class="header-bottom-wrapper">
                <div class="logo-2 furniture-logo ptb-30">
                    <a href="index.html">
                        <img src="{{URL::asset('frontend/img/logo/2.png')}}" alt="">
                    </a>
                </div>
                <div class="menu-style-2 furniture-menu menu-hover">
                    <nav>
                        <ul>
                            <li><a href="{{ route('index') }}">home</a></li>
                            @foreach ($allCategories as $category)
                                <li>
                                    <a href="{{ route('category.product', $category->id) }}">{{ $category->title }}</a>
                                    @if (count($category->categories) != 0)
                                        <ul class="single-dropdown">
                                            @foreach ($category->categories as $subCategory)
                                                <li>
                                                    <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            {{--<li><a href="#">Whisky</a>
                                <ul class="single-dropdown">
                                    <li><a href="">Premium Whisky</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Vodka</a>
                                <ul class="single-dropdown">
                                    <li><a href="">Premium Vodka</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Beer</a>
                                <ul class="single-dropdown">
                                    <li><a href="">Premium Beer</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Rum</a>
                                <ul class="single-dropdown">
                                    <li><a href="">Premium Rum</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Wine</a>
                                <div class="category-menu-dropdown shop-menu">
                                    <div class="category-dropdown-style category-common2 mb-30">
                                        <h4 class="categories-subtitle"> Red</h4>
                                        <ul>
                                            <li><a href="">Cabernet Sauvignon</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-dropdown-style category-common2 mb-30">
                                        <h4 class="categories-subtitle"> White</h4>
                                        <ul>
                                            <li><a href="">Sauvignon Blanc</a></li>
                                        </ul>
                                    </div>

                                    <div class="mega-banner-img">
                                        <a href="single-product.html">
                                            <img src="assets/img/banner/18.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">More</a>
                                <ul class="single-dropdown">
                                    <li><a href="">Taquela</a></li>
                                </ul>
                            </li>--}}
                            <li><a href="contact.html">contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-cart">
                    <a class="icon-cart-furniture" href="#">
                        <i class="ti-shopping-cart"></i>
                        <span class="shop-count-furniture green">{{ Cart::instance('cart')->count() }}</span>
                    </a>
                    <ul class="cart-dropdown">
                        @if (count(Cart::instance('cart')->content()) == 0)
                            <p>Your cart is empty</p>
                        @else
                            @foreach (Cart::instance('cart')->content() as $productVariant)
                                <li class="single-product-cart">
                                    <div class="cart-img">
                                        <a href="#"><img
                                                src="{{ URL::asset($productVariant->model->parentVolume->image) }}"
                                                alt=""></a>
                                    </div>
                                    <div class="cart-title">
                                        <h5><a href="#">{{ $productVariant->model->name }}</a></h5>
                                        <h6><a href="#">Qty: {{ $productVariant->qty }}</a></h6>
                                        <span>Price: Rs.{{ $productVariant->price }} x {{ $productVariant->qty }}</span>

                                    </div>
                                    <div class="cart-delete">
                                        <form action="{{ route('cart.destroy', $productVariant->rowId) }}" method="POST"
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button-no-style" type="submit"><i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach

                            <li class="cart-space">
                                <div class="cart-sub">
                                    <h4>Subtotal</h4>
                                </div>
                                <div class="cart-price">
                                    <h4>Rs.{{ Cart::subtotal() }}</h4>
                                </div>
                            </li>
                            <li class="cart-btn-wrapper">
                                <a class="cart-btn btn-hover" href="{{ route('cart.index') }}">view cart</a>
                                <a class="cart-btn btn-hover" href="{{ route('checkout') }}">checkout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="{{ route('index') }}">home</a></li>
                                @foreach ($allCategories as $category)
                                    <li>
                                        <a href="{{ route('category.product', $category->id) }}">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
