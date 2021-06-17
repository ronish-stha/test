@extends('frontend.layout.master')
@section('styles')
    <style>
        .profile-card{
            min-height: 100px;
            padding: 30px 30px 30px 30px;
        }
        .profile-card img{
            width: 100%
        }
        .vendor-customer-detail{
            position: absolute;
            right: 0;
            width: 50%;
            padding: 40px 20px;
            top: 0;
        }
        .vendor-detail{
            width: 50%; 
            padding-top:40px;
            height:100%;
            border-bottom: none;
            border-right: 1px solid #22222250;
        }
        .vendor-bread-comb ul{
            width: 100%;
            position: absolute;
            list-style: none;
        }
        .vendor-bread-comb ul li{
            display: inline;
        }
        @media (max-width: 767px) {
            .vendor-customer-detail{
                width: 100%;
                padding: 40px 20px;
                position: relative;
            }
            .vendor-detail{
                width: 100%;
                height: auto;
                border-right: none;
                padding-bottom: 20px;
                border-bottom: 1px solid #22222250;
            }
        }
       
    </style>    
@endsection
@section('content')
    <div class="container-fluid ptb-15" style="background: #eeeeee">
        <div class="row">
            <div class="vendor-bread-comb text-center" style="height:20px">
                <ul style="">
                    <li><a href="">Home </a> / </li>
                    <li><a href="">Vendor</a> / </li>
                    <li><a href="">Vendor 1</a></li>
                </ul>
            </div>
        </div>
    </div>
   <div class="container-fluid" >
    <div class="container pt-50">
        <div class="card profile-card">
        <div class="row">
                <div class="col-sm-3">
                    <img src="https://previews.123rf.com/images/iamcitrus/iamcitrus1610/iamcitrus161000046/67826192-hand-drawn-whiskey-logo-typography-monochrome-hipster-vintage-label-for-flayer-poster-or-t-shirt-pri.jpg" alt="">
                </div>
                <div class="col-sm-9">
                    <ul class="vendor-detail">
                        <li><h5><strong>Jack Daniels Pvt. Ltd.</strong></h5></li>
                        <li><p><strong>Anamnager, Kathmandu Nepal</strong></p></li>
                        {{-- <li>stars</li> --}}
                        <li><strong>Phone:</strong>+977 01 4484650</li>
                        <li><strong>Email: </strong> test@vendor.com</li>
                        <li> <strong>Social Meida:</strong> Facebook, Instagram, Twitter</li>
                    </ul>
                    <ul class="vendor-customer-detail">
                        <li><p><strong>NO. OF ITEM AVAILABLE:</strong> 50</p></li>
                        <li><p><strong>NO. OF SATISFIED COSTUMERS:</strong> 20</p></li>
                        <li style="text-align: justify"><strong>ABOUT VENDOR:</strong> <span style="font-size: 12px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, commodi. Vero optio quis, iste libero pariatur soluta recusandae odio aperiam, expedita illum, error non ullam nesciunt. Ullam a non odit.</span></li>

                    </ul>
                </div>    
            </div>
        </div>
    </div>
    <div class="container pt-80">
        <div class="row">
            <p class="dash-title"><span class="dash-title-text">Whisky</span></p>
                <a href="" class=" view-more">View More</a>
                    @foreach ($products as $product)
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
                    @endforeach
        </div>
        <hr>
    
    </div>
   </div>

@endsection