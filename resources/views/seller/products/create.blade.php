@extends('seller.layouts.master')

@section('styles')
    <link href="{{ URL::asset('css/admin/spectrum.css') }}" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        #loader {
            text-align: center;
        }

        @keyframes ldio-xempgkzug3e {
            0% {
                transform: rotate(0deg)
            }
            50% {
                transform: rotate(180deg)
            }
            100% {
                transform: rotate(360deg)
            }
        }

        .ldio-xempgkzug3e div {
            position: absolute;
            animation: ldio-xempgkzug3e 1s linear infinite;
            width: 160px;
            height: 160px;
            top: 20px;
            left: 20px;
            border-radius: 50%;
            box-shadow: 0 4px 0 0 #f44336;
            transform-origin: 80px 82px;
        }

        .loadingio-spinner-eclipse-ckwya8k6cj {
            width: 200px;
            height: 200px;
            display: inline-block;
            overflow: hidden;
            background: none;
        }

        .ldio-xempgkzug3e {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0; /* see note above */
        }

        .ldio-xempgkzug3e div {
            box-sizing: content-box;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @include('admin.includes.message')
                    <div class="alert alert-danger alert-with-icon hidden" data-notify="container" id="alert-div">
                        <i class="material-icons" data-notify="icon">notifications</i>
                        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
                            <i class="material-icons">close</i>
                        </button>
                        <span data-notify="message">
                            Please make sure to fill all data
                        </span>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">add</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Add Product</h4>
                            <form action="{{ route('seller-product.store') }}" method="post"
                                  enctype="multipart/form-data" id="productForm">
                                {{ csrf_field() }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control text-center" id="seller-id"
                                       name="seller_product_id" required value="">
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">article</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name
                                                    <small>*</small>
                                                </label>
                                                <input name="name" id="name" type="text" class="form-control"
                                                       value="{{ old('name') }}" autofocus>
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
                                                <input name="brand" id="brand" type="text" class="form-control"
                                                       value="{{ old('brand') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">category</i>
                                            </span>
                                            <div class="form-group">
                                                <select class="form-control category" name="category" id="category"
                                                        required>
                                                    @if(count($categories) == 0)
                                                        <option value="">No category available</option>
                                                    @else
                                                        <option value="">Category *</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">
                                                                {{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">local_drink</i>
                                            </span>
                                            <div class="form-group">
                                                <label for="">Volume <span style="font-size: 14px">(Select all volumes available for this product)</span>
                                                    <button type="button"
                                                            class="btn btn-success btn-raised btn-fab btn-fab-mini btn-xs"
                                                            id="newVolume" data-target="#volumeModal"
                                                            data-toggle="modal">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-2 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            </span>
                                            <div class="form-group">
                                                <input type="checkbox" name="volume[1]" value="330">
                                                <input type="hidden" name="quantity[1]" value="1">
                                                <label for="">1x330ml</label>
                                                <br>
                                                <input type="checkbox" name="volume[2]" value="500">
                                                <input type="hidden" name="quantity[2]" value="1">
                                                <label for="">1x500ml</label>
                                                <br>
                                                <input type="checkbox" name="volume[3]" value="650">
                                                <input type="hidden" name="quantity[3]" value="1">
                                                <label for="">1x650ml</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <div class="form-group">
                                                <input type="checkbox" name="volume[4]" value="700">
                                                <input type="hidden" name="quantity[4]" value="1">
                                                <label for="">1x700ml</label>
                                                <br>
                                                <input type="checkbox" name="volume[5]" value="750">
                                                <input type="hidden" name="quantity[5]" value="1">
                                                <label for="">1x750ml</label>
                                                <br>
                                                <input type="checkbox" name="volume[6]" value="1000">
                                                <input type="hidden" name="quantity[6]" value="1">
                                                <label for="">1x1000ml</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            </span>
                                            <div class="form-group" id="custom-volume">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div align="right">
                                    <button type="button" class="btn btn-success" id="next">Next</button>
                                </div>

                                <div id="loader" class="hidden">
                                    <div class="loadingio-spinner-eclipse-ckwya8k6cj" style="text-align: center">
                                        <div class="ldio-xempgkzug3e">
                                            <div></div>
                                        </div>
                                    </div>
                                </div>

                                <div id="product-variants">
                                </div>
                                <br>
                                <br>
                                <div align="right" id="formButtons" class="hidden">
                                    <hr>
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="volumeModal" tabindex="-1" role="dialog"
         aria-labelledby="volumeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                    <h4 class="modal-title">Add Custom Volume</h4>
                </div>
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Volume (in ml)</label>
                        <input type="integer" name="volume" id="new-volume" class="form-control" required>
                        <span class="material-input"></span>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Quantity</label>
                        <input type="integer" name="quantity" id="new-quantity" class="form-control" required>
                        <span class="material-input"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-simple" id="addVolumeButton">Add</button>
                    <button type="button" class="btn btn-danger btn-simple"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('js/admin/spectrum.js') }}"></script>

    <script>
        $(".basic").spectrum({
            color: "#f00",
            change: function (color) {
                $("#basic-log").text("change called: " + color.toHexString());
                console.log('ok');
                console.log(color.toHexString());
                $('#custom-color').val(color.toHexString());
            }
        });

        $(document).ready(function () {
            if ($("input[name='set_size']").val() == 'yes') {
                $('#size-div').css('display', '');
            } else {
                $('#size-div').css('display', 'none');
            }

            if ($("input[name='set_color']").val() == 'yes') {
                $('#color-div').css('display', '');
            } else {
                $('#color-div').css('display', 'none');
            }
        });

        $("input[name='volume']").change(function () {
            console.log($(this).val());
        });

        var sellerProductId = null;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#next').on('click', function () {
            name = $('#name').val();
            category = $('#category').val();
            brand = $('#brand').val();
            url = "{{ route('seller.product-volume-table') }}";
            data = $('#productForm').serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                beforeSend: function () {
                    $('#next').addClass('hidden');
                    $('#loader').removeClass('hidden');
                },
                success: function (res) {
                    if (res.status) {
                        $('#loader').addClass('hidden');
                        $('#seller-id').val(res.id);
                        $('#product-variants').html(res.html);
                        $('#formButtons').removeClass('hidden');
                    } else {
                        console.log('error')
                        $('#loader').addClass('hidden');
                        $('#next').removeClass('hidden');
                        $('#alert-div').removeClass('hidden');
                    }
                },
                error: function (res) {
                    console.log(res);
                    $('#loader').addClass('hidden');
                    $('#next').removeClass('hidden');
                    $('#alert-div').removeClass('hidden');
                }
            })
        });

        $("input[name='set_custom_color']").change(function () {
            console.log($(this).val());
            if ($(this).val() == 'yes') {
                $('#custom-color-div').css('display', '');
            } else {
                $('#custom-color-div').css('display', 'none');
            }
        });

        $("input[name='set_size']").change(function () {
            if ($(this).val() == 'yes') {
                $('#size-div').css('display', '');
            } else {
                $('#size-div').css('display', 'none');
            }
        });

        existingVolumes = [
            '1x330',
            '1x500',
            '1x650',
            '1x700',
            '1x750',
            '1x1000',
        ];

        volumeCounter = 6;

        $('#addVolumeButton').on('click', function () {
            volume = $('#new-volume').val();
            quantity = $('#new-quantity').val();
            if (volume && quantity && (volume > 50)) {
                quantityVolume = `${quantity}x${volume}`;
                volumeCounter++;
                if (!existingVolumes.includes(quantityVolume)) {
                    div = `<input type="checkbox" name="volume[${volumeCounter}]" value="${volume}">`;
                    div += `<input type="hidden" name="quantity[${volumeCounter}]" value="${quantity}">`;
                    div += `<label>${quantityVolume}ml</label>`;
                    div += `<br/>`;

                    existingVolumes.push(quantityVolume);
                    $('#custom-volume').append(div);
                    $('#volumeModal').modal('hide');
                }

            }
        });

        /*$('#add').on('click', function (e) {
            e.preventDefault();
            console.log($('.display-image').length);
            if ($('.display-image').length > 5) {
                $('#add').hide();
            } else {
                $('#display-image-div').append(
                    '<div class="display-image">' +
                    '<input type="file" name="image[]"/>' +
                    '</div>'
                );
            }

            $('#remove').css('display', '');
        });

        $('#display-image-div').on('click', '#remove', function (e) {
            e.preventDefault();
            $('.display-image').last().css('display', 'none').remove();
            console.log($('.display-image').length);

            $('#add').show();

            if ($('.display-image').length === 2) {
                $('#remove').hide();
            }
        })*/
    </script>
@endsection
