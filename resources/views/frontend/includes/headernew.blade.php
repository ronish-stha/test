@section('styles')
    <style>

    </style>
@endsection
<div class="notification-section notification-section-padding-2 notification-img-3">
    <div class="container-fluid">
        <div class="notification-wrapper">
            <div class="notification-pera-graph-3 hide-on-sm">
                <p>Get your Liquors on your Doorsteps from your own vendor. </p>
            </div>
            <div class="notification-btn-close">
                <div class="notification-btn-3">
                    <a href="{{ route('seller.login')}}">Become a Partner</a>
                </div>
            </div>
            <div class="notification-btn-close login-btn">
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
<nav class="navbar navbar-expand-lg navbar-dark justify-content-between text-white" style="background-color: white;">
    <a class="navbar-brand" href={{ route('index') }}#"><img src="{{URL::asset('frontend/img/logo/logo.png')}}"
                                                             alt="logo"
                                                             style="height: 30px;padding-left: 40px;"></a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown01">
        <ul class="navbar-nav ">
            <!--dropdown item of menu-->
            <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
            @foreach ($allCategories as $category)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('category.product', $category->id) }}"
                       id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ $category->title }} </a>
                    @if (count($category->categories) != 0)
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="inner-menu">
                                @if ($category->id == 5)
                                    <a href="{{ route('category.product', $category->id) }}"><h6>BEER VARIETALS <span>View all Beers</span>
                                        </h6></a>
                                    <ul>
                                        @foreach ($category->categories as $subCategory)
                                            <li>
                                                <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul style="">
                                        @foreach ($category->categories as $subCategory)
                                            <li>
                                                <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif ($category->id == 1)
                                    <a href="{{ route('category.product', $category->id) }}"><h6>LIQUOR VARIETALS <span>View all Liquors</span>
                                        </h6></a>
                                    @php $childCategoryParents = $nonChildCategoryParents = []; @endphp
                                    @foreach ($category->categories as $subCategory)
                                        @php count($subCategory->categories) != 0 ? $childCategoryParents[] = $subCategory : $nonChildCategoryParents[] = $subCategory; @endphp
                                    @endforeach
                                    @foreach ($childCategoryParents as $subCategory)
                                        <ul>
                                            <a href="{{ route('category.product', $subCategory->id) }}">
                                                <h6>{{ $subCategory->title }}</h6></a>
                                            @foreach ($subCategory->categories as $childCategory)
                                                <li>
                                                    <a href="{{ route('category.product', $childCategory->id) }}">{{ $childCategory->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                    <ul>
                                        @foreach ($nonChildCategoryParents as $subCategory)
                                            <li>
                                                <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    @foreach ($category->categories as $subCategory)
                                        <ul>
                                            <a href="{{ route('category.product', $subCategory->id) }}">
                                                <h6>{{ $subCategory->title }}</h6></a>
                                            @foreach ($subCategory->categories as $childCategory)
                                                <li>
                                                    <a href="{{ route('category.product', $childCategory->id) }}">{{ $childCategory->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
            {{--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"> Dropdown 01 </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="inner-menu">
                        <ul>
                            <h6>This is Test header</h6>
                            <li><a href="">test 1</a></li>
                        </ul>
                        <ul>
                            <h6>This is Test header 2</h6>
                            <li><a href="">test 2</a></li>
                        </ul>
                    </div>
                </div>
            </li>--}}

        </ul>
        <form class="form-inline" action="{{ route('product.search') }}" method="post">
            {{ csrf_field() }}
            <input style="border-radius: 0" name="search_field" class="form-control" type="search"
                   placeholder="Search beer, wine, liquor and extras" required/>
            <button class="btn my-2 my-sm-0" type="submit"
                    style="height: 45px; border-radious:5px; border: 1px solid #22222230; cursor: pointer;"><i class=" fa fa-search"></i>
            </button>
        </form>
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
                        <h4>Rs.{{ Session::get('total') ? Session::get('total') : Cart::subtotal() }}</h4>
                    </div>
                </li>
                <li class="cart-btn-wrapper">
                    <a class="cart-btn btn-hover" href="{{ route('cart.index') }}">view cart</a>
                    <a class="cart-btn btn-hover" href="{{ route('checkout') }}">checkout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
