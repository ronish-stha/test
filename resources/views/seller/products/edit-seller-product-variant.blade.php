@extends('seller.layouts.master')

@section('content')
    <style>
        .formStyle {
            display: inline
        }
    </style>
    <div class="content">
        @include('seller.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">sports_bar</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $sellerProductVariant->name }}</h4>
                            <form
                                action="{{ route('seller-product.update-seller-product-variant', $sellerProductVariant->id) }}"
                                method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">article</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name
                                                </label>
                                                <input name="name" type="text" class="form-control"
                                                       value="{{ old('name', $sellerProductVariant->name) }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Brand
                                                </label>
                                                <h6>{{ $sellerProductVariant->sellerProduct->brand }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">local_drink</i>
                                            </span>
                                            <div class="form-group col-md-6 label-floating">
                                                <label class="control-label">Quantity</label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input name="quantity" type="number" class="form-control" required
                                                               value="{{ old('quantity', $sellerProductVariant->sellerVolume->quantity) }}">
                                                    </div>
                                                    <div class="col-md-1">x</div>
                                                </div>
                                                {{--<h6>{{ $sellerProductVariant->sellerVolume->quantity }}
                                                    x {{ $sellerProductVariant->sellerVolume->volume }}ml</h6>--}}
                                            </div>
                                            <div class="form-group col-md-6 label-floating">
                                                <label class="control-label">Volume</label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input name="volume" type="number" class="form-control" required
                                                               value="{{ old('volume', $sellerProductVariant->sellerVolume->volume) }}">
                                                    </div>
                                                    <div class="col-md-1">ml</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">money</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Price
                                                </label>
                                                <input name="price" type="number" class="form-control"
                                                       value="{{ old('price', $sellerProductVariant->price) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">{{ $sellerProductVariant->available ? 'check' : 'clear' }}</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Available
                                                </label>
                                                <input name="available"
                                                       type="radio"
                                                       {{ $sellerProductVariant->available ? 'checked' : '' }} value="1">
                                                Yes
                                                <input name="available"
                                                       type="radio"
                                                       {{ !$sellerProductVariant->available ? 'checked' : '' }} value="0">
                                                No
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">{{ $sellerProductVariant->status ? 'check' : 'access_time' }}</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Status
                                                </label>
                                                <span
                                                    class="label label-{{ $sellerProductVariant->status ? 'success' : 'info' }}">
                                                        {{ $sellerProductVariant->status ? 'Accepted' : 'Pending' }}
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($sellerProductVariant->sellerVolume->image)
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-offset-1">
                                            <img src="{{ URL::asset($sellerProductVariant->image) }}" style="height:110px;
                                         width:100px;">
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="row">
                                    <div class="col-lg-10 col-md-offset-1">
                                        <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">description</i>
                                                    </span>
                                            <div class="form-group label-floating"><label>Description</label>
                                                <h6>{{ $sellerProductVariant->sellerProduct->description }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if (!$sellerProductVariant->status)
                                    <div align="right">
                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-content">
                            @if ($sellerProductVariant->sellerProduct->image)
                                <img src="{{ asset($sellerProductVariant->sellerProduct->image) }}" alt="">
                            @endif
                            <br>
                            <br>
                            <h6 class="category text-gray" style="text-align: left">
                                <i class="material-icons">assignment_ind</i>
                                <span class="label label-success" rel="tooltip" data-placement="bottom"
                                      data-original-title="Seller">{{ $sellerProductVariant->sellerProduct->seller->first_name }} {{ $sellerProductVariant->sellerProduct->seller->last_name }}</span>
                            </h6>
                            <h6 class="category text-gray" style="text-align: left">
                                <i class="material-icons">sports_bar</i>
                                <span class="label label-danger" rel="tooltip" data-placement="bottom"
                                      data-original-title="Seller">{{ $sellerProductVariant->sellerProduct->name }}</span>
                            </h6>
                            <h6 class="category text-gray" style="text-align: left">
                                <i class="material-icons">category</i>
                                <span class="label label-info" rel="tooltip" data-placement="bottom"
                                      data-original-title="Category">{{ $sellerProductVariant->sellerProduct->category->title }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection

