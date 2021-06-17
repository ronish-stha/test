<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-quickview-width" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="qwick-view-left">
                    <div class="quick-view-learg-img">
                        <div class="quick-view-tab-content tab-content">
                            <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                <img id="product-image" src="" alt="">
                            </div>
                            {{--<div class="tab-pane fade" id="modal2" role="tabpanel">
                                <img  src="{{URL::asset('frontend/img/product/whisky/1.jpg')}}" alt="">
                            </div>
                            <div class="tab-pane fade" id="modal3" role="tabpanel">
                                <img  src="{{URL::asset('frontend/img/product/whisky/1.jpg')}}" alt="">
                            </div>--}}
                        </div>
                    </div>
                    <div class="quick-view-list nav" role="tablist">
                        {{--<a class="active" href="#modal1" data-toggle="tab" role="tab">
                            <img src="{{URL::asset('frontend/img/quick-view/s1.jpg')}}" alt="">
                        </a>
                        <a href="#modal2" data-toggle="tab" role="tab">
                            <img src="{{URL::asset('frontend/img/quick-view/s1.jpg')}}" alt="">
                        </a>
                        <a href="#modal3" data-toggle="tab" role="tab">
                            <img src="{{URL::asset('frontend/img/quick-view/s1.jpg')}}" alt="">
                        </a>--}}
                    </div>
                </div>
                <div class="qwick-view-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black">
                        <span class="pe-7s-close" aria-hidden="true"></span>
                    </button>
                    <div class="qwick-view-content">
                        <h3 id="product-name"></h3>
                        <div class="price">
                            <span class="new" id="product-price">Rs.</span>
                            {{--                            <span class="old">$120.00  </span>--}}
                        </div>
                        <div><span><strong>Brand: </strong></span> <span>Jack Denials</span></div>
                        <div><span><strong>Category: </strong></span> <span>Whisky</span></div>
                        <div><span><strong>Volume: </strong></span> <span>750ml</span></div>
                        <div><span><strong>Description: </strong></span><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></div>
                        {{--<div class="rating-number">
                            <div class="quick-view-rating">
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                            </div>
                            <div class="quick-view-number">
                                <span>2 Ratting (S)</span>
                            </div>
                        </div>--}}
                        <form action="{{ route('cart.store') }}" method="post" style="display:inline-block">
                            @csrf
                            <div class="quickview-plus-minus">
                                <input type="hidden" id="product-id" name="id" value="">
                                <div class="cart-plus-minus">
                                    <input type="text" value="1" name="quantity" class="cart-plus-minus-box">
                                </div>
                                <div class="quickview-btn-cart">
                                    <button class="btn-hover-black" style="color: white" type="submit">add to cart
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
