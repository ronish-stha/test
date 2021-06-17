@extends('frontend.layout.master')
@section('styles')
    <style>
        .hidden {
            display: none;
        }

        .quickview-btn-cart > button {
            background-color: #050035;
            color: #fff;
            display: inline-block;
            font-weight: 600;
            letter-spacing: 0.08px;
            line-height: 1;
            padding: 17px 35px;
            position: relative;
            text-transform: uppercase;
            z-index: 5;
        }

        .animate-top {
            cursor: pointer;
        }

        a .animate-top:hover {
            color: black;
        }

        fieldset {
            overflow: hidden;
            border-bottom: 1px solid #22222240;
            padding-bottom: 30px;
        }

        .some-class {
            float: left;
            clear: none;
            margin-top: 10px;
            width: 100%
        }

        label {
            float: left;
            clear: none;
            display: block;
            line-height: 2.2;
            text-align: center;
            padding-left: 20px;
        }

        input[type=radio],
        input.radio {
            float: left;
            clear: none;
            margin: 2px 0 0 2px;
            width: auto;
            height: 30px;
        }

        input[type=checkbox],
        input.checkbox {
            float: left;
            clear: none;
            margin: 2px 0 0 2px;
            width: auto;
            height: 30px;
        }

        .filter-minus {
            line-height: 2;
            float: right;
            cursor: pointer;
        }

        .apply_input {
            width: 50px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #22222240;
            font-size: 10px;
            height: 20px;
        }

        .filter-stars {
            padding-left: 25px;
            font-size: 10px;
            margin-top: 6px;
        }

        fieldset ul li {
            display: inline-block;
            width: 100%;
        }

        #loader {
            text-align: center;
        }

        @keyframes ldio-95hznz8mq3 {
            0% {
                transform: rotate(0deg)
            }
            50% {
                transform: rotate(180deg)
            }
            100% {
                transform: rotate(360deg)
            }
        }

        .ldio-95hznz8mq3 div {
            position: absolute;
            animation: ldio-95hznz8mq3 1s linear infinite;
            width: 80px;
            height: 80px;
            top: 10px;
            left: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 0 0 #e12c2c;
            transform-origin: 40px 41px;
        }

        .loadingio-spinner-eclipse-9q8qyi90b05 {
            width: 100px;
            height: 100px;
            display: inline-block;
            overflow: hidden;
            /*background: #ffffff;*/
        }

        .ldio-95hznz8mq3 {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0; /* see note above */
        }

        .ldio-95hznz8mq3 div {
            box-sizing: content-box;
        }
    </style>
    <script>
        function price() {
            var x = document.getElementById("pricerangelist");
            if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("filterMinus").classList.add('fa-minus');
                document.getElementById("filterMinus").classList.remove('fa-plus');
            } else {
                x.style.display = "none";
                document.getElementById("filterMinus").classList.add('fa-plus');
                document.getElementById("filterMinus").classList.remove('fa-minus');
            }
        }

        function country() {
            var x = document.getElementById("countrylist");
            if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("filterMinus1").classList.add('fa-minus');
                document.getElementById("filterMinus1").classList.remove('fa-plus');
            } else {
                x.style.display = "none";
                document.getElementById("filterMinus1").classList.add('fa-plus');
                document.getElementById("filterMinus1").classList.remove('fa-minus');
            }
        }

        function volume() {
            var x = document.getElementById("volumelist");
            if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("filterMinus1").classList.add('fa-minus');
                document.getElementById("filterMinus1").classList.remove('fa-plus');
            } else {
                x.style.display = "none";
                document.getElementById("filterMinus1").classList.add('fa-plus');
                document.getElementById("filterMinus1").classList.remove('fa-minus');
            }
        }

        function rating() {
            var x = document.getElementById("ratinglist");
            if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("filterMinus2").classList.add('fa-minus');
                document.getElementById("filterMinus2").classList.remove('fa-plus');
            } else {
                x.style.display = "none";
                document.getElementById("filterMinus2").classList.add('fa-plus');
                document.getElementById("filterMinus2").classList.remove('fa-minus');
            }
        }
    </script>
@endsection
@section('content')
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
         style=" height: 200px; background-image: url(../../frontend/img/banner/breadcumb.jpg)">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2>Products</h2>
                <ul>
                    <li><a href="{{ route('index') }}">home</a></li>
                    <li><a href="{{ route('products') }}">products</a></li>
                    @if (isset($selectedCategory))
                        <li>{{ $selectedCategory->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @include('frontend.modals.productshow')
    <div id="loader" class="overlay hidden">
        <div class="loadingio-spinner-eclipse-9q8qyi90b05">
            <div class="ldio-95hznz8mq3">
                <div></div>
            </div>
        </div>
    </div>
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar mr-50">
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Search Products</h3>
                            <div class="sidebar-search">
                                <form action="{{ route('product.search') }}" method="post">
                                    {{ csrf_field() }}
                                    <input placeholder="Search Products" type="text" name="search_field" required>
                                    <button type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-50">
                            <button class="btn btn-block btn-default" onClick="country()">Country of Origin <i
                                    id="filterMinus" class="fa fa-minus filter-minus" aria-hidden="true"></i>
                            </button>
                            <div class="" id="countrylist">
                                <fieldset>
                                    <div class="some-class">
                                        <ul>
                                            @foreach ($countries as $country)
                                                <li>
                                                    <input type="checkbox" class="checkbox filterProduct" name="country"
                                                           value="{{ $country->id }}"/>
                                                    <label for="y">{{ $country->title }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        {{--<div class="sidebar-widget mb-50">
                            <button class="btn btn-block btn-default" onClick="price()">Price Range <i id="filterMinus"
                                                                                                       class="fa fa-minus filter-minus"
                                                                                                       aria-hidden="true"></i>
                            </button>
                            <div class="" id="pricerangelist">
                                <fieldset>
                                    <div class="some-class">
                                        <ul>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price"
                                                       value="500"/>
                                                <label for="y">Under Rs. 1000</label>
                                            </li>
                                            --}}{{--<li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price" value="1000"/>
                                                <label for="y">Rs. 500 to Rs. 1000</label>
                                            </li>--}}{{--
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price"
                                                       value="2000"/>
                                                <label for="y">Rs. 1000 to Rs. 2000</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price"
                                                       value="3000"/>
                                                <label for="y">Rs. 2000 to Rs. 3000</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price"
                                                       value="4000"/>
                                                <label for="y">Rs. 3000 to Rs. 4000</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="price"
                                                       value=5000"/>
                                                <label for="y">Rs. 4000 to Rs. 5000</label>
                                            </li>
                                        </ul>
                                    </div>
                                    from <input type="text" name="price_from" class="apply_input"> to <input type="text"
                                                                                                             name="price_to"
                                                                                                             class="apply_input">
                                    <a href="">Apply</a>
                                </fieldset>
                            </div>
                        </div>--}}
                        <div class="sidebar-widget mb-50">
                            <button class="btn btn-block btn-default" onClick="volume()">Volume <i id="filterMinus1"
                                                                                                   class="fa fa-minus filter-minus"
                                                                                                   aria-hidden="true"></i>
                            </button>
                            <div class="" id="volumelist">
                                <fieldset>
                                    <div class="some-class">
                                        <ul>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="volume"
                                                       value="500"/>
                                                <label for="y">less than 500ml</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="volume"
                                                       value="750"/>
                                                <label for="z">less than 750ml</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="volume"
                                                       value="1000"/>
                                                <label for="z">less than 1000ml</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="volume"
                                                       value="1500"/>
                                                <label for="z">less than 1500ml</label>
                                            </li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-50">
                            <button class="btn btn-block btn-default" onClick="store()">Store <i id="filterMinus1"
                                                                                                 class="fa fa-minus filter-minus"
                                                                                                 aria-hidden="true"></i>
                            </button>
                            <div class="" id="storelist">
                                <fieldset>
                                    <div class="some-class">
                                        <ul>
                                            @foreach ($sellers as $seller)
                                                <li>
                                                    <input type="checkbox" class="checkbox filterProduct" name="store"
                                                           value="{{ $seller->id }}"/>
                                                    <label for="y">{{ $seller->sellerDetail->store_name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="sidebar-widget mb-50">
                            <button class="btn btn-block btn-default" onClick="rating()">Rating <i id="filterMinus2"
                                                                                                   class="fa fa-minus filter-minus"
                                                                                                   aria-hidden="true"></i>
                            </button>
                            <div class="" id="ratinglist">
                                <fieldset>
                                    <div class="some-class">
                                        <ul>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="x"
                                                       value="y"/>
                                                <div class="product-rating-5 filter-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="checkbox filterProduct" name="x"
                                                       value="y"/>
                                                <div class="product-rating-5 filter-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"> & up</i>
                                                </div>
                                            </li>
                                            {{--<li>
                                                <input type="checkbox" class="checkbox filterProduct" name="x"
                                                       value="y"/>
                                                <div class="product-rating-5 filter-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"> & up</i>
                                                </div>
                                            </li>--}}
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    @if ($parentCategory)
                                        @foreach ($parentCategory->getDescendants() as $subCategory)
                                            <li>
                                                <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}
                                                    {{-- <span>{{ count($category->products) }}</span> --}}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach ($selectedCategory->getDescendants() as $subCategory)
                                            <li>
                                                <a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}
                                                    {{-- <span>{{ count($category->products) }}</span> --}}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @if (count($sellers) != 0)
                            <div class="sidebar-widget mb-45">
                                <h3 class="sidebar-title">Stores</h3>
                                <div class="sidebar-categories">
                                    <ul>
                                        @foreach ($sellers as $seller)
                                            <li>
                                                <a href="{{ route('store.product', $seller->id) }}">
                                                    {{ $seller->sellerDetail->store_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        {{-- <div class="sidebar-widget mb-50"> --}}
                        {{-- <h3 class="sidebar-title">Top rated products</h3> --}}
                        {{-- <div class="sidebar-top-rated-all"> --}}
                        {{-- <div class="sidebar-top-rated mb-30"> --}}
                        {{-- <div class="single-top-rated"> --}}
                        {{-- <div class="top-rated-img"> --}}
                        {{-- <a href="#"><img src="assets/img/product/sidebar-product/2.jpg" alt=""></a> --}}
                        {{-- </div> --}}
                        {{-- <div class="top-rated-text"> --}}
                        {{-- <h4><a href="#">Flying Drone</a></h4> --}}
                        {{-- <div class="top-rated-rating"> --}}
                        {{-- <ul> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- </ul> --}}
                        {{-- </div> --}}
                        {{-- <span>$140.00</span> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="sidebar-top-rated mb-30"> --}}
                        {{-- <div class="single-top-rated"> --}}
                        {{-- <div class="top-rated-img"> --}}
                        {{-- <a href="#"><img src="assets/img/product/sidebar-product/3.jpg" alt=""></a> --}}
                        {{-- </div> --}}
                        {{-- <div class="top-rated-text"> --}}
                        {{-- <h4><a href="#">Flying Drone</a></h4> --}}
                        {{-- <div class="top-rated-rating"> --}}
                        {{-- <ul> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- </ul> --}}
                        {{-- </div> --}}
                        {{-- <span>$140.00</span> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="sidebar-top-rated mb-30"> --}}
                        {{-- <div class="single-top-rated"> --}}
                        {{-- <div class="top-rated-img"> --}}
                        {{-- <a href="#"><img src="assets/img/product/sidebar-product/4.jpg" alt=""></a> --}}
                        {{-- </div> --}}
                        {{-- <div class="top-rated-text"> --}}
                        {{-- <h4><a href="#">Flying Drone</a></h4> --}}
                        {{-- <div class="top-rated-rating"> --}}
                        {{-- <ul> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- <li><i class="pe-7s-star"></i></li> --}}
                        {{-- </ul> --}}
                        {{-- </div> --}}
                        {{-- <span>$140.00</span> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-lg-9" id="filteredProduct">
                    <div class="shop-product-wrapper res-xl res-xl-btn">
                        {{-- <div class="filter">
                            <h3><strong>{{ $selectedCategory->title }}</strong></h3>
                            @if (count($subCategories) != 0)
                                <ul>
                                    @foreach ($subCategories as $subCategory)
                                        <li><a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div> --}}
                        <div class="shop-bar-area">
                            <div class="shop-bar pb-60">
                                <div class="shop-found-selector">
                                    {{-- <div class="shop-found">
                                        <p> --}}{{-- <span>{{ count($products) }}</span> --}}{{-- Products Found --}}{{-- of <span>50</span> --}}{{-- </p>
                                    </div> --}}
                                    {{-- <div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select name="select">
                                            <option value="">Default</option>
                                            <option value="">A to Z</option>
                                            <option value=""> Z to A</option>
                                            <option value="">In stock</option>
                                        </select>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="shop-product-content tab-content">
                                <div id="grid-sidebar1" class="tab-pane fade active show">
                                    <div class="row">
                                        @foreach ($selectedCategory->products as $product)
                                            <div class="col-lg-4 col-md-6 col-xl-3">
                                                <div class="product-fruit-wrapper mb-60">
                                                    <a
                                                        href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">
                                                        <div class="product-fruit-img">
                                                            <img src="{{ URL::asset($product->image) }}" alt="">
                                                        </div>
                                                    </a>
                                                    <div class="product-fruit-content text-center">
                                                        <h4><a
                                                                href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">{{ $product->name }}</a>
                                                        </h4>
                                                        <span>Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }}</span>
                                                        {{-- <span>Rs. {{ $product->productVariants->first()->price }} <p
                                                                 style="font-size: 10px;display:inherit">{{ $product->productVariants->first()->parentVolume->quantity }} Bottle</p></span>--}}
                                                        <div class="product-rating-5">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="pe-7s-star"></i>
                                                            <i class="pe-7s-star"></i>
                                                            30
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach ($subCategories as $subCategory)
                                            @foreach ($subCategory->products as $product)
                                                <div class="col-lg-4 col-md-6 col-xl-3">
                                                    <div class="product-fruit-wrapper mb-60">
                                                        <a
                                                            href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">
                                                            <div class="product-fruit-img">
                                                                <img src="{{ URL::asset($product->image) }}" alt="">
                                                            </div>
                                                        </a>
                                                        <div class="product-fruit-content text-center">
                                                            <h4><a
                                                                    href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <span>Rs. {{ $product->productVariants->first()->price }} <p
                                                                    style="font-size: 10px;display:inherit">{{ $product->productVariants->first()->parentVolume->quantity }} Bottle</p></span>
                                                            <div class="product-rating-5">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="pe-7s-star"></i>
                                                                <i class="pe-7s-star"></i>
                                                                30
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        {{-- @foreach ($products as $product)
                                             <div class="col-lg-6 col-md-6 col-xl-3">
                                                 <div class="product-fruit-wrapper mb-60">
                                                     <div class="product-fruit-img">
                                                         <img src="{{ URL::asset($product->image)}}" alt="">
                                                         <form action="{{ route('cart.store') }}"
                                                               id="cart-store{{ $product->id }}"
                                                               style="display:inline-block" method="post">
                                                             @csrf
                                                             <input type="hidden" name="id" value="{{ $product->id }}">
                                                             <input type="hidden" name="quantity" value="1">
                                                         </form>
                                                         <div class="product-furit-action">
                                                             <a data-id="{{ $product->id }}"
                                                                class="furit-animate-left cart-add" title="Add To Cart"
                                                                type="submit" style="color: white; cursor: pointer">
                                                                 <i class="pe-7s-cart"></i>
                                                             </a>
                                                             <a class="furit-animate-right" title="View"
                                                                href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">
                                                                 <i class="pe-7s-look"></i>
                                                             </a>
                                                         </div>
                                                     </div>
                                                     <div class="product-fruit-content text-center">
                                                         <h4>
                                                             <a href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">
                                                                 {{$product->name}}
                                                             </a>
                                                         </h4>
                                                         <span>Rs. {{$product->price}}</span>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endforeach --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="pagination-style mt-30 text-center">
                        <ul>
                            <li><a href="#"><i class="ti-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">19</a></li>
                            <li class="active"><a href="#"><i class="ti-angle-right"></i></a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#productModal').on('show.bs.modal', function (e) {
                $('#product-id').val($(e.relatedTarget).data('id'));
                $('#product-name').text($(e.relatedTarget).data('name'));
                $('#product-price').text('Rs.' + $(e.relatedTarget).data('price'));
                $('#product-image').attr('src', $(e.relatedTarget).data('image'));
            })
        })
        $('.cart-add').on('click', function () {
            let productId = $(this).attr('data-id');
            $('#cart-store' + productId).submit();
        })

        previousRadio = null;

        $('.filterProduct').on('change', function () {
            if (previousRadio) {
                previousRadio.prop('checked', false);
            }
            if ($(this).is(':checked')) {
                console.log('this', $(this));
                name = $(this).attr('name');
                value = $(this).val();
                console.log(name, value);
                url = '{{ route("product.filter") }}';
                console.log('url', url);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        'name': name,
                        'value': value,
                        '_token': "{{ csrf_token() }}",
                        'category_id': {{ $selectedCategory->id }},
                    },
                    beforeSend: function () {
                        $('#loader').removeClass('hidden');
                    },
                    success: function (res) {
                        if (res.status) {
                            $('#filteredProduct').empty();
                            $('#filteredProduct').html(res.html);
                            $(window).scrollTop(0);
                            $('#loader').addClass('hidden');
                        } else {
                            $('#loader').addClass('hidden');
                            console.log('error');
                        }
                    },
                    error: function () {
                        $('#loader').addClass('hidden');
                        console.log('error');
                    }
                })


                previousRadio = $(this);
            }
        })

    </script>
@endsection
