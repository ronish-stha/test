@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <a href="{{ route('category.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="orange">
                                <i class="material-icons">view_list</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Categories</p>
                                <h3 class="card-title">{{ count($categories) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="purple">
                                <i class="material-icons">shopping_basket</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Products</p>
                                <h3 class="card-title">{{ count($products) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('sales.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="rose">
                                <i class="material-icons">credit_card</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Sales</p>
                                <h3 class="card-title">{{ count($sales) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customer.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="blue">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Users</p>
                                <h3 class="card-title">{{ count($customers) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
                {{--<a href="{{ route('banner.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="material-icons">insert_photo</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Banners</p>
                                <h3 class="card-title">{{ count($banners) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('review.index') }}">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="red">
                                <i class="material-icons">star</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Total Reviews</p>
                                <h3 class="card-title">{{ count($reviews) }}</h3>
                            </div>
                        </div>
                    </div>
                </a>--}}
            </div>
        </div>
    </div>
@endsection
