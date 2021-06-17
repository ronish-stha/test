@php $variantCount = 0; @endphp
@forelse ($productVariants as $productVariant)
    @if ($productVariant->status && $productVariant->available)
        <div class="product-details-content pt-20 vendor-detail">
            <form action="{{ route('cart.store') }}" method="post">
                {{ csrf_field() }}
                <ul>
                    <li>
                        <h5><strong>Rs. {{ $productVariant->price }}</strong></h5>
                    </li>
                    <li> {{--<button class="btn btn-outline-dark btn-sm disabled"
                                                 style="padding: 0px 5px; height:20px; width:32px; border-radius: 5px; line-height:20px">4.5</button>--}}
                        <strong>{{ $productVariant->user->sellerDetail->store_name }}</strong> {{--| 2k products--}}
                    </li>
                    {{--<li>$49.99 minimum | $4.99 Delivery fee</li>--}}
                    <li><span><i class="fa fa-clock"></i><strong> 10:00am - 11:00pm</strong> | Delivery
                                            Time</span></li>
                    <li class="pt-10 pb-20">
                        <div class="btn-group">
                            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id }}">
                            <input type="hidden" id="quantity-field" name="quantity" value="1">
                            <button type="button" style="cursor: pointer;"
                                    class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><span id="span{{ $productVariant->id }}">1</span>
                                <span class="sr-only">Toggle Dropdown</span>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="1">1
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="2">2
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="3">3
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="4">4
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="5">5
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="6">6
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="7">7
                                        </li>
                                        <li class="quantity-selector" data-id="{{ $productVariant->id }}"
                                            style="cursor: pointer;" data-quantity="8">8
                                        </li>
                                    </ul>
                                </div>
                            </button>
                            <button class="btn btn-danger btn-sm cart-add"
                                    data-id="{{ $productVariant->id }}"
                                    type="submit" style="cursor: pointer">
                                Add to Cart
                            </button>

                        </div>
                    </li>
                </ul>
            </form>
        </div>
        @php $variantCount++; @endphp
    @endif
@empty
    @php $variantCount++; @endphp
    <p class="text-center">No Seller Available Currently</p>
@endforelse
@if (!$variantCount)
    <p class="text-center">No Seller Available Currently</p>
@endif


<script>
    $('.cart-add').on('click', function () {
        let productId = $(this).attr('data-id');
    })
    $('.quantity-selector').on('click', function () {
        quantity = $(this).data('quantity');
        productId = $(this).data('id');
        $('#quantity-field').val(quantity);
        $('#span' + productId).text(quantity);
    })
</script>
