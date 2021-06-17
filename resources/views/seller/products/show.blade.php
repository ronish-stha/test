@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs" data-background-color="rose">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="active">
                                            <a href="#profile" data-toggle="tab">
                                                <i class="material-icons">assignment</i> Details
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#messages" data-toggle="tab">
                                                <i class="material-icons">description</i> Other Specifications
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>

                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Name</b></p>
                                                <p>{{ $product->name ? $product->name : '-'}}</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Brand</b></p>
                                                <p>{{ $product->brand ? $product->brand : '-'}}</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Code</b></p>
                                                <p>{{ $product->code ? $product->code : '-'}}</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Price</b></p>
                                                <p><b>Rs. </b>{{ $product->price ? $product->price : '-'}}</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Quantity</b></p>
                                                <p>{{ $product->quantity ? $product->quantity : '-'}} pcs</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Product Discount</b></p>
                                                <p>{{ $product->discount ? $product->discount . ' %' : '-'}}</p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="messages">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Colors</b></p>
                                                @if ($product->color)
                                                    <div class="row">
                                                        @foreach (json_decode($product->color) as $color)
                                                            <div style="height:15px;width:15px;background-color:{{ $color }};display:inline-block"></div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Sizes</b></p>
                                                @if ($product->size)
                                                   <div class="row">
                                                       @foreach (json_decode($product->size) as $size)
                                                           <div style="display:inline-block"> {{ strtoupper($size) }}</div>
                                                       @endforeach
                                                   </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Featured</b></p>
                                                <p>{{ !$product->featured ? 'no' : 'yes' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Available</b></p>
                                                <p>{{ !$product->available ? 'yes' : $product->available }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>

                                                    </label>
                                                </div>
                                            </td>
                                            <td><p><b>Description</b></p>
                                                <p>{{ $product->description ? $product->description : '-' }}</p></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div align="center">
                            <a href="{{ route('seller-product.edit',$product->id) }}" class="btn btn-success"><i
                                        class="">Edit</i></a>
                            <a href="{{ route('seller-product.index') }}" class="btn btn-outline-primary "><i
                                        class="">Go Back</i></a>
                        </div>
                    </div>

                </div>


                <div class="col-md-5 col-sm-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">collections</i>
                        </div>
                        {{--<div class="container">--}}
                        <div class="card-content">
                            <h4 class="card-title">Images</h4>
                            {{--<div id="customSkinMap" class="map">--}}
                            <img src="{{URL::asset($product->cover_image)}}" height="auto"
                                 width="100%">
                            <br>
                            <hr>
                            @foreach ($product->images as $image)
                                <img src="{{URL::asset($product->id . '/' . $image->image)}}"
                                     style="height:100px;
                                         width:110px;">
                            @endforeach
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
