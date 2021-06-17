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
                    @forelse ($products as $product)
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
                    @empty
                        <p>No Product Available for this Filter</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
