@extends('frontend.layout.master')
@section('styles')
    <style>
        .slider-text {
            position: absolute;
            top: 0;
            left: 20%;
            width: 60%;
            padding-top: 5%;
            text-align: center;
            margin-top: 5%;
        }

        .slider-area {
            background: #eeeeee;
            padding-top: 45px;
        }

        .index-image {
            padding-right: 0;
            background-image: url('../../frontend/img/slider/cheers1.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .discount-border-left {
            border-left: 10px solid #e12c2c;
        }

        .discount-border-right {
            border-right: 10px solid #e12c2c;
        }

        .ad-popup {
            width: 80%;
            align-items: center;
            justify-content: center;
            margin-left: 10%;
            margin-top: 50px;
        }

        .outline {
            border: 2px solid #dddddd;
            /* border-radius: 15px;
            padding: 20px; */
        }

        .dotted-border {
            border: 2px dotted#cccccc;
            height: 100%;
            text-align: center;
        }

        .dotted-border h2 {
            font-size: 50px;
            padding-top: 20px;
        }

        .dotted-border h6 {
            color: #777777;
            margin-top: -10px;
            font-size: 20px;
        }

        .form-inside {
            margin-top: 70px;
        }

        .form-inside input {
            width: 80%;
            margin-left: 10%;
            border-radius: 0;
        }

        .form-inside button {
            width: 80%;
            border-radius: 0;
            margin-top: 10px;
            background-color: #69a423;
            color: white;
        }

        @media (max-width: 767px) {
            .slider-text {
                top: 0;
                position: absolute;
                width: 100%;
                left: 0;
                margin-top: 5%;
                text-align: center;
                z-index: 999;
            }

            .login-btn {
                position: absolute;
                right: 0;
                top: 0;
            }

            .index-image {
                min-height: 300px;
            }

            .discount-border-left {
                border-left: none;
            }

            .discount-details-wrapper {
                text-align: left;
                width: 90%;
                margin-left: 10%;
            }

            .discount-border-right {
                border-right: none;
            }

        }
    </style>
@endsection
@section('content')
    @include('frontend.modals.productshow')
    <div class="modal fade ad-popup" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="outline ">
                    <div class="row " style="margin:0; background-color: white;">
                        <div class="col-md-6 " style="background-color: #69a423; ">
                            <img src="https://pbs.twimg.com/profile_images/844831700047691777/Pl0exke2_400x400.jpg " alt=" ">
                        </div>
                        <div class="col-md-6 " style="padding: 20px; ">
                            <div class="dotted-border ">
                                <h2><strong>Take <span style="color: #69a423; ">15%</span> off</strong></h2>
                                <h6> On Your First Purchase</h6>

                                <div class="form-inside ">
                                    <p>Enter your email below to get started.</p>
                                    <input type="text " name=" " id=" " class="form-control " placeholder="Enter your Email here.... ">
                                    <button class="btn ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-area">
        <div class="slider-active owl-carousel">
            <div class="single-slider-4 slider-height-6 bg-img"
                 style="background-image: url({{ asset($contents[0]['image2']) }})"></div>
            <div class="single-slider-4 slider-height-6 bg-img"
                 style="background-image: url({{ asset($contents[0]['image1']) }})"></div>
        </div>
        <div class="clippath" style="z-index: 999"></div>
        <div class="clippath-reverse" style="z-index: 999"></div>
        <div class="container slider-text" style="">
            <div class="slider-content-5 fadeinup-animated">
                <h2 class="animated"><strong>{{ $contents[0]['heading1'] }}</strong></h2>
                <p class="animated" style="text-align: center">{{ $contents[0]['heading2'] }}</p>
                <form action="{{ route('location') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="location" placeholder="Enter Delivery Address to Shop"
                               id="location" required>
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit" style="height: 100%">Search</button>
                        </div>
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- services area start -->
    <div class="services-area wrapper-padding-4 gray-bg pt-80 pb-60">
        <div class="container-fluid">
            <div class="services-wrapper">
                <div class="col-md-4 single-services mb-40">
                    <div class="services-img">
                        {{--                        <i class="fa fa-paypal" ></i>--}}
                        <img src="{{ asset($contents[1]['image1']) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ $contents[1]['heading1'] }}</h4>
                        <p>{{ $contents[1]['content1'] }}</p>
                    </div>

                </div>
                <div class="col-md-4 single-services mb-40">
                    <div class="services-img">
                        <img src="{{ asset($contents[1]['image2']) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ $contents[1]['heading2'] }}</h4>
                        <p>{{ $contents[1]['content2'] }}</p>
                    </div>
                </div>
                <div class="col-md-4 single-services mb-40">
                    <div class="services-img">
                        <img src="{{ asset($contents[1]['image3']) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ $contents[1]['heading3'] }}</h4>
                        <p>{{ $contents[1]['content3'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services area end -->
    <!-- discount area left image start -->
    <div class="discount-area ptb-60 discount-border-left">
        <div class="container-fluid" style="padding-left: 0">
            <div class="row">
                <div class="col-md-6 index-image" style="background-image: url({{ asset($contents[2]['image1']) }})">
                    <div class="discount-img" style=""></div>
                </div>
                <div class="col-md-6 ptb-60 " style="padding-left: 0;">
                    <div class="discount-details-wrapper">
                        <h5>{{ $contents[2]['heading1'] }}</h5>
                        <h2 style="color: #e12c2c">{{ $contents[2]['heading2'] }}<br>{{ $contents[2]['heading3'] }}</h2>
                        <p class="discount-peragraph">{{ $contents[2]['content1'] }}</p>
                        <a class="discount-btn btn-hover" href="{{ route('products') }}">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- discount area end -->
    <!-- discount area right image start -->
    <div class="discount-area ptb-80 gray-bg discount-border-right">
        <div class="container-fluid" style="padding-left: 0">
            <div class="row">
                <div class="col-md-6 ptb-80 " style="padding-right: 0;">
                    <div class="discount-details-wrapper ">
                        <h3 style="color: #e12c2c">{{ $contents[3]['heading1'] }} <br>{{ $contents[3]['heading2'] }}</h3>
                        <p class="discount-peragraph">{{ $contents[3]['content1'] }}</p>
                        <a class="discount-btn btn-hover" href="{{ route('products') }}">Buy Now</a>
                    </div>
                </div>
                <div class="col-md-6" style="padding-left: 0; border-right:none; padding-right:0;">
                    <div class="discount-img" style="height: 100%; ">
                        <img src="{{ asset($contents[3]['image1']) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- discount area end -->
    <!-- product area start -->
    <div class="popular-product-area wrapper-padding-3 pt-80 pb-115">
        <div class="container-fluid">
            <div class="section-title-6 text-center mb-50">
                <h2>Popular Product</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text</p>
            </div>
            <div class="product-style">
                <div class="popular-product-active owl-carousel">
                    @foreach ($products as $product)
                        <div class="product-fruit-wrapper mb-60">
                            <div class="product-fruit-img">
                                <img src="{{ URL::asset($product->image) }}" alt="">
                                <div class="product-furit-action">
                                    <a class="furit-animate-left" title="View"
                                       href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-fruit-content text-center">
                                <h4>
                                    <a href="{{ route('product.show', ['category' => $product->category->id, 'product' => $product->id]) }}">{{$product->name}}</a>
                                </h4>
                                <span>Rs. {{ $product->minPrice() }} - {{ $product->maxPrice() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- product area end -->
    <!-- premium area start -->
    <div class="premium-banner-area ">
        <div class="discount-wrapper">
            <img src="{{ asset($contents[4]['image1']) }}" alt="">
            <div class="discount-content">
                <h2>{{ $contents[4]['heading1'] }}<br>{{ $contents[4]['heading2'] }}</h2>
                <a href="{{ route('products') }}">Learn More</a>
            </div>
        </div>
    </div>
    <!-- premium area end -->
    <!-- product area start -->
    {{--    <div class="product-style-area pt-120">--}}
    {{--        <div class="coustom-container-fluid">--}}
    {{--            <div class="section-title-7 text-center">--}}
    {{--                <h2>All Products</h2>--}}
    {{--                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the--}}
    {{--                    industry's standard dummy text</p>--}}
    {{--            </div>--}}
    {{--            <div class="product-tab-list text-center mb-65 nav" role="tablist">--}}
    {{--                @foreach ($categories as $category)--}}
    {{--                    <a class="{{ $loop->first ? 'active' : '' }}" href="#{{ $category->title }}{{ $category->id }}"--}}
    {{--                       data-toggle="tab" role="tab">--}}
    {{--                        <h4>{{ $category->title }} </h4>--}}
    {{--                    </a>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--            <div class="tab-content">--}}
    {{--                @foreach ($categories as $category)--}}
    {{--                    <div class="tab-pane {{ $loop->first ? 'active show ' : '' }}fade"--}}
    {{--                         id="{{ $category->title }}{{ $category->id }}"--}}
    {{--                         role="tabpanel">--}}
    {{--                        <div class="row">--}}
    {{--                            @foreach ($category->products as $product)--}}
    {{--                                <div class="col-lg-2 col-md-3">--}}
    {{--                                    <div class="product-fruit-wrapper mb-60">--}}
    {{--                                        <div class="product-fruit-img">--}}
    {{--                                            <img src="{{ URL::asset($product->image)}}" alt="">--}}
    {{--                                            <form action="{{ route('cart.store') }}" id="cart-store{{ $product->id }}"--}}
    {{--                                                  style="display:inline-block" method="post">--}}
    {{--                                                @csrf--}}
    {{--                                                <input type="hidden" name="id" value="{{ $product->id }}">--}}
    {{--                                                <input type="hidden" name="quantity" value="1">--}}
    {{--                                            </form>--}}
    {{--                                            <div class="product-furit-action">--}}
    {{--                                                <a data-id="{{ $product->id }}" class="furit-animate-left cart-add" title="Add To Cart"--}}
    {{--                                                   type="submit" style="color: white">--}}
    {{--                                                    <i class="pe-7s-cart"></i>--}}
    {{--                                                </a>--}}
    {{--                                                <a class="furit-animate-right" title="Quick View"--}}
    {{--                                                   data-toggle="modal"--}}
    {{--                                                   data-target="#productModal" href="#"--}}
    {{--                                                   data-id="{{ $product->id }}"--}}
    {{--                                                   data-name="{{ $product->name }}"--}}
    {{--                                                   data-price="{{ $product->price }}"--}}
    {{--                                                   data-image="{{ asset($product->image) }}"  >--}}
    {{--                                                    <i class="pe-7s-look"></i>--}}
    {{--                                                </a>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="product-fruit-content text-center">--}}
    {{--                                            <h4><a href="product-details.html">{{$product->name}}</a></h4>--}}
    {{--                                            <span>Rs. {{$product->price}}</span>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            @endforeach--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--            <div class="view-all-product text-center">--}}
    {{--                <a href="{{ route('products') }}">View All Product</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- product area end -->
    <!-- services area start -->
    <div class="services-area wrapper-padding-4 gray-bg pt-120 pb-80">
        <div class="container">
            <div class="services-wrapper">
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Whisky</h4>
                        <ul>
                            <li>Scotch</li>
                            <li>Single Malt</li>
                        </ul>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Vodka</h4>
                        <ul>
                            <li>Imported Vodka</li>
                            <li>Desi Vodka</li>
                            <li>Ruslan Vodka</li>
                            <li>Russian Vodka</li>
                            <li>German Vodka</li>
                        </ul>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Wine</h4>
                        <ul>
                            <li>Sweet Red</li>
                            <li>Blue Wine</li>
                            <li>White Wine</li>
                            <li>Rose Wine</li>
                        </ul>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Others</h4>
                        <ul>
                            <li>Taquela</li>
                            <li>Gin</li>
                        </ul>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Rum</h4>
                        <ul>
                            <li>Imported Rum</li>
                            <li>Desi Rum</li>
                        </ul>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-content">
                        <h4>Extras</h4>
                        <ul>
                            <li>Ice & Party Supplies</li>
                            <li>Soda</li>
                            <li>Mixers</li>
                            <li>Fruit & Garnishes</li>
                            <li>Bitters & Syrups</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services area end -->
    <!-- testimonials area start -->
    <div class="testimonials-area bg-img pt-130 pb-125" style="background-image: url('../../frontend/img/bg/7.jpg')">
        <div class="container">
            <div class="testimonials-active owl-carousel">
                <div class="single-testimonial-2 text-center">
                    <img src="{{URL::asset('frontend/img/team/1.png')}}" alt="">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation.</p>
                    <img src="{{URL::asset('frontend/img/team/2.png')}}" alt="">
                    <h4>tayeb rayed</h4>
                    <span>uiux Designer</span>
                </div>
                <div class="single-testimonial-2 text-center">
                    <img src="{{URL::asset('frontend/img/team/7.png')}}" alt="">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation.</p>
                    <img src="{{URL::asset('frontend/img/team/2.png')}}" alt="">
                    <h4>tayeb rayed</h4>
                    <span>uiux Designer</span>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonials area end -->
    <!-- subscribe area start -->
    <div class="newsletter-area pt-105 pb-105 gray-bg-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="newsletter-content">
                        <h2>Get All Updates.</h2>
                        <p>There are many variations of passages of available, but the majority have suffered alteration
                            in some form,</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter-style-4">
                        <div id="mc_embed_signup" class="subscribe-form-4 pr-70">
                            <form
                                action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input type="email" value="" name="EMAIL" class="email"
                                           placeholder="Enter Mail Address" required>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div class="mc-news" aria-hidden="true"><input type="text"
                                                                                   name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef"
                                                                                   tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe"
                                                              id="mc-embedded-subscribe" class="button"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- subscribe area end -->
@endsection

@section('scripts')
    <script>
        var placeSearch, autocomplete, types = ['establishment']
        var coordinate = {}

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type  {!HTMLInputElement} */(document.getElementById('location')),
                {types: types, componentRestrictions: {country: "NP"}});
            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            document.getElementById('lat').value = place.geometry.location.lat()
            document.getElementById('lng').value = place.geometry.location.lng()
        }

        $(document).on("keypress", "form", function (event) {
            return event.keyCode != 13;
        });
    </script>
    <script type="text/javascript"
            src="{{ 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_API_KEY') . '&libraries=places&callback=initAutocomplete' }}"
            async defer>
    </script>

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
