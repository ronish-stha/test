@extends('frontend.layout.master')
@section('content')
    <div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
        style=" height: 200px; background-image: url(../../frontend/img/banner/breadcumb.jpg)">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h2>Products</h2>
                <ul>
                    <li><a href="{{ route('index') }}">home</a></li>
                    <li><a href="{{ route('products') }}">products</a></li>

                </ul>
            </div>
        </div>
    </div>
    @include('frontend.modals.locationfind')
    <div class="product-details pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3 col-sm-12 pt-100">
                    <div class="product-details-img-content">
                        <img src="" alt="" style="width:100%; height:auto;">

                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12 ptb-80">
                    <div class="product-details-content">
                        <h3>Jack Denials</h3>
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
                        <div class=" vendor-list">
                            <ul>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                                <li><a class="bottle-type" href="#"><strong>12x</strong> <span class="">12ox bottle</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-sm-12 pt-60 pb-80"
                    style="border-left: 1px solid #dddddd; padding-left:0px">
                    <h4 style="padding-left: 20px"><strong>Available from these store</strong></h4>
                    <nav class="pt-10">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                role="tab" aria-controls="nav-home" aria-selected="true">Get it today</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Get it later</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="product-details-content pt-20 vendor-detail">
                                <ul>
                                    <li>
                                        <h5><strong>$450</strong></h5>
                                    </li>
                                    <li> <button class="btn btn-outline-dark btn-sm disabled"
                                            style="padding: 0px 5px; height:20px; width:32px; border-radius: 5px; line-height:20px">4.5</button>
                                        <strong>Nepal Liquor House</strong> | 2k products</li>
                                    <li>$49.99 minimum | $4.99 Delivery fee</li>
                                    <li><span><i class="fa fa-clock"></i><strong> 10:00am - 11:00pm</strong> | Delivery
                                            Time</span></li>
                                    <li class="pt-10 pb-20">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button">
                                                Add to Cart
                                            </button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li>1</li>
                                                    <li>2</li>
                                                    <li>3</li>
                                                </ul>
                                            </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-details-content pt-20 vendor-detail">
                                <ul>
                                    <li>
                                        <h5><strong>$450</strong></h5>
                                    </li>
                                    <li> <button class="btn btn-outline-dark btn-sm disabled"
                                            style="padding: 0px 5px; height:20px; width:32px; border-radius: 5px; line-height:20px">4.5</button>
                                        <strong>Nepal Liquor House</strong> | 2k products</li>
                                    <li>$49.99 minimum | $4.99 Delivery fee</li>
                                    <li><span><i class="fa fa-clock"></i><strong> 10:00am - 11:00pm</strong> | Delivery
                                            Time</span></li>
                                    <li class="pt-10 pb-20">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button">
                                                Add to Cart
                                            </button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li>1</li>
                                                    <li>2</li>
                                                    <li>3</li>
                                                </ul>
                                            </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-details-content pt-20 vendor-detail">
                                <ul>
                                    <li>
                                        <h5><strong>$450</strong></h5>
                                    </li>
                                    <li> <button class="btn btn-outline-dark btn-sm disabled"
                                            style="padding: 0px 5px; height:20px; width:32px; border-radius: 5px; line-height:20px">4.5</button>
                                        <strong>Nepal Liquor House</strong> | 2k products</li>
                                    <li>$49.99 minimum | $4.99 Delivery fee</li>
                                    <li><span><i class="fa fa-clock"></i><strong> 10:00am - 11:00pm</strong> | Delivery
                                            Time</span></li>
                                    <li class="pt-10 pb-20">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button">
                                                Add to Cart
                                            </button>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li>1</li>
                                                    <li>2</li>
                                                    <li>3</li>
                                                </ul>
                                            </div>
                                    </li>
                                </ul>
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
                        {{-- <p>{{ $product->description ? $product->description : '-' }}</p> --}}
                    </div>
                    <div class="tab-pane fade" id="pro-review" role="tabpanel">
                        <a href="#">Be the first to write your review!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
