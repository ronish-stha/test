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

    {{-- row start here --}}
    <div class="container">
        <div class="filter ptb-40">
            <h3><strong>{{ $selectedCategory->title }}</strong></h3>
            @if (count($subCategories) != 0)
                <ul>
                    @foreach ($subCategories as $subCategory)
                        <li><a href="{{ route('category.product', $subCategory->id) }}">{{ $subCategory->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
        @if (count($subCategories) != 0)
            @foreach ($subCategories as $subCategory)
                @if (count($subCategory->products) != 0)
                    <p class="dash-title"><span class="dash-title-text">{{ $subCategory->title }}</span></p>
                    <a href="{{ route('category.product', $subCategory->id) }}" class=" view-more">View More</a>
                    <div class="row">
                        @foreach ($subCategory->products as $product)
                            <div class="col-lg-6 col-md-6 col-xl-3 product-margin">
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
                                        <span>Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }} {{--<p
                                                style="font-size: 10px;display:inherit">6 Canas</p>--}}</span>
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
                    </div>
                @endif
            @endforeach
        @endif
        @if (count($selectedCategory->products) != 0)
            <p class="dash-title"><span class="dash-title-text">{{ $selectedCategory->title }}</span></p>
            <div class="row">
                @foreach ($selectedCategory->products as $product)
                    <div class="col-lg-6 col-md-6 col-xl-3 product-margin">
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
                                <span>Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }} <p
                                        style="font-size: 10px;display:inherit">6 Canas</p></span>
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
            </div>
        @endif
        <hr>
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
