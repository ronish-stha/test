@extends('frontend.layout.master')
@section('styles')
    <style>
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
                    <li><a href="{{ route('products') }}">products</a></li>
                    @if (isset($selectedCategory))
                        <li>{{ $selectedCategory->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @include('frontend.modals.productshow')
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar mr-50">
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Search Products</h3>
                            <div class="sidebar-search">
                                <form action="#">
                                    <input placeholder="Search Products..." type="text">
                                    <button><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="#">{{ $category->title }}
                                                <span>{{ count($category->products) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{--                        <div class="sidebar-widget mb-50">--}}
                        {{--                            <h3 class="sidebar-title">Top rated products</h3>--}}
                        {{--                            <div class="sidebar-top-rated-all">--}}
                        {{--                                <div class="sidebar-top-rated mb-30">--}}
                        {{--                                    <div class="single-top-rated">--}}
                        {{--                                        <div class="top-rated-img">--}}
                        {{--                                            <a href="#"><img src="assets/img/product/sidebar-product/2.jpg" alt=""></a>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="top-rated-text">--}}
                        {{--                                            <h4><a href="#">Flying Drone</a></h4>--}}
                        {{--                                            <div class="top-rated-rating">--}}
                        {{--                                                <ul>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                </ul>--}}
                        {{--                                            </div>--}}
                        {{--                                            <span>$140.00</span>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="sidebar-top-rated mb-30">--}}
                        {{--                                    <div class="single-top-rated">--}}
                        {{--                                        <div class="top-rated-img">--}}
                        {{--                                            <a href="#"><img src="assets/img/product/sidebar-product/3.jpg" alt=""></a>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="top-rated-text">--}}
                        {{--                                            <h4><a href="#">Flying Drone</a></h4>--}}
                        {{--                                            <div class="top-rated-rating">--}}
                        {{--                                                <ul>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                </ul>--}}
                        {{--                                            </div>--}}
                        {{--                                            <span>$140.00</span>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="sidebar-top-rated mb-30">--}}
                        {{--                                    <div class="single-top-rated">--}}
                        {{--                                        <div class="top-rated-img">--}}
                        {{--                                            <a href="#"><img src="assets/img/product/sidebar-product/4.jpg" alt=""></a>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="top-rated-text">--}}
                        {{--                                            <h4><a href="#">Flying Drone</a></h4>--}}
                        {{--                                            <div class="top-rated-rating">--}}
                        {{--                                                <ul>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                    <li><i class="pe-7s-star"></i></li>--}}
                        {{--                                                </ul>--}}
                        {{--                                            </div>--}}
                        {{--                                            <span>$140.00</span>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop-product-wrapper res-xl res-xl-btn">
                        <div class="shop-bar-area">
                            <div class="shop-bar pb-60">
                                <div class="shop-found-selector">
                                    <div class="shop-found">
                                        <p><span>{{ count($products) }}</span> Products Found{{-- of <span>50</span>--}}
                                        </p>
                                    </div>
                                    {{--<div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select name="select">
                                            <option value="">Default</option>
                                            <option value="">A to Z</option>
                                            <option value=""> Z to A</option>
                                            <option value="">In stock</option>
                                        </select>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="shop-product-content tab-content">
                                <div id="grid-sidebar1" class="tab-pane fade active show">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-6 col-md-6 col-xl-3">
                                                <div class="product-fruit-wrapper mb-60">
                                                    <div class="product-fruit-img">
                                                        <img src="{{ URL::asset($product->image)}}" alt="">
                                                        <div class="product-furit-action">
                                                            <a class="furit-animate-left" title="View"
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
                                                        <span>Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="pagination-style mt-30 text-center">
                        <ul>
                            <li><a href="#"><i class="ti-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">19</a></li>
                            <li class="active"><a href="#"><i class="ti-angle-right"></i></a></li>
                        </ul>
                    </div>--}}
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
    </script>
@endsection
