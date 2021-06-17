@extends('seller.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">star</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $review->user->first_name . ' ' . $review->user->last_name }}</h4>
                            <div class="material-datatables">
                                <p><strong>Product</strong> :
                                    <a style="text-decoration: none;"
                                       href="{{ route('products.show', $review->product->id) }}">
                                        {{ $review->product->name }}
                                    </a>
                                </p>
                                <p><strong>User</strong> :
                                    {{ $review->user->first_name . ' ' . $review->user->last_name }}
                                </p>
                                <p><strong>Rating</strong><br>
                                    @for($i = 1; $i <= $review->rating; $i++)
                                        <i class="material-icons" style="color: #FFD700">star</i>
                                        @if (($i == $review->rating) && ($review->rating < 5))
                                            @php
                                                $remainingStars = 5 - $review->rating;
                                            @endphp
                                            @for ($j = 1; $j <= $remainingStars; $j++)
                                                <i class="material-icons"
                                                   style="color: #c0c0c0">star</i>
                                            @endfor
                                        @endif
                                    @endfor
                                </p>
                                <p><strong>Description</strong><br> {{ $review->description }}</p>
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
