@extends('frontend.layout.master')
@section('styles')
    <style>
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
            background: #ffffff;
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
    @include('frontend.modals.locationfind')
    <div class="product-details pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-sm-12 pt-60">
                    <div class="product-details-img-content">
                        <img src="{{ URL::asset($product->image)}}" alt="" style="width:100%; height:auto;">

                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12 pt-60">
                    <div class="product-details-content">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating-number">
                            <div class="quick-view-rating">
                                <i class="pe-7s-star red-star"></i>
                                <i class="pe-7s-star red-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                            </div>
                            <div class="quick-view-number">
                                <span>2 Rating (S)</span>
                            </div>
                        </div>
                        <div class="vendor-list row">
                            <ul>
                                @foreach ($volumes as $volume)
                                    <li>
                                        <a class="bottle-type volume-button" href="Javascript:void(0);"
                                           style="cursor: pointer;" data-volume-id="{{ $volume->id }}">
                                            <strong>{{ $volume->quantity }}x </strong><span class="">{{ $volume->volume }} bottle</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                        <div class="details-price">
                            <span>Starts from - Rs. {{ $product->price }}</span>
                        </div>
                        {{--<div class="product-details-cati-tag ">
                            <ul>
                                <li class="categories-title">Volume :</li>
                                <li><a href="#">{{ $product->volume }}ml</a></li>
                            </ul>
                        </div>--}}
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Category :</li>
                                <li><a href="#">{{ $product->category->title }}</a></li>
                            </ul>
                        </div>
                        @if ($product->brand)
                            <div class="product-details-cati-tag mtb-10">
                                <ul>
                                    <li class="categories-title">Brand :</li>
                                    <li><a href="#">{{ $product->brand }}</a></li>
                                </ul>
                            </div>
                        @endif
                        <div class="quickview-plus-minus pb-10">
                            <a class="btn btn-block btn-danger" data-toggle="modal" data-target="#LocationModal"
                               href="#" href="#">Check Location Availability</a>
                        </div>
                        {{--<div class="product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li>
                                    <a href="#">
                                        <i class="icofont icofont-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icofont icofont-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icofont icofont-social-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icofont icofont-social-flikr"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-sm-12 pt-60 pb-80 hidden" id="sellers"
                     style="border-left: 1px solid #dddddd; padding-left:0px">
                    <h4 style="padding-left: 20px"><strong>Available from these store</strong></h4>
                    {{--<nav class="pt-10">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                               role="tab" aria-controls="nav-home" aria-selected="true">Get it today</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                               role="tab" aria-controls="nav-profile" aria-selected="false">Get it later</a>
                        </div>
                    </nav>--}}
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <form action="{{ route('cart.store') }}"
                                  id="cart-store{{ $product->id }}"
                                  style="display:inline-block" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                            </form>
                            <div id="loader" class="hidden">
                                <div class="loadingio-spinner-eclipse-9q8qyi90b05">
                                    <div class="ldio-95hznz8mq3">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <div id="seller-products">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            No content here
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="product-description-review-area pb-90">
        <div class="container">
            <div class="product-description-review text-center">
                <div class="description-review-title nav" role=tablist>
                    <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                        Description
                    </a>
                    <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                        Reviews (0)
                    </a>
                </div>
                <div class="description-review-text tab-content">
                    <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                        <p>{{ $product->description ? $product->description : '-' }}</p>
                    </div>
                    <div class="tab-pane fade" id="pro-review" role="tabpanel">
                        <a href="#">Be the first to write your review!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product area start -->
    <div class="product-area pb-95">
        <div class="container">
            <div class="section-title-3 text-center mb-50">
                <h2>Related products</h2>
            </div>
            <div class="product-style">
                <div class="popular-product-active owl-carousel">
                    @foreach ($products as $relatedProduct)
                        <div class="product-fruit-wrapper mb-60">
                            <div class="product-fruit-img">
                                <img src="{{ URL::asset($relatedProduct->image)}}" alt="">
                                <div class="product-furit-action">
                                    <a class="furit-animate-left" title="View"
                                       href="{{ route('product.show', ['category' => $relatedProduct->category->id, 'product' => $relatedProduct->id]) }}">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-fruit-content text-center">
                                <h4>
                                    <a href="{{ route('product.show', ['category' => $relatedProduct->category->id, 'product' => $relatedProduct->id]) }}">
                                        {{$relatedProduct->name}}
                                    </a>
                                </h4>
                                <span>Rs. {{ $relatedProduct->minPrice() }} - {{ $relatedProduct->maxPrice() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- product area end -->
@endsection

@section('scripts')
    <script>
        let productId = {{ $product->id }};

        $('.volume-button').on('click', function () {
            volumeId = $(this).data('volume-id');
            url = '{{ route("product.vendor", ["productId" => ":productId", "volumeId" => ":volumeId"]) }}';
            url = url.replace(':productId', productId);
            url = url.replace(':volumeId', volumeId);
            console.log('url', url);
            $.ajax({
                type: 'GET',
                url: url,
                beforeSend: function () {
                    $('#seller-products').empty();
                    $('#loader').removeClass('hidden');
                },
                success: function (res) {
                    if (res.status) {
                        if ($('#sellers').hasClass('hidden'))
                            $('#sellers').removeClass('hidden');
                        $('#loader').addClass('hidden');
                        $('#seller-products').html(res.html);
                    } else {
                        console.log('error');
                    }
                }
            })
        });
    </script>
@endsection
