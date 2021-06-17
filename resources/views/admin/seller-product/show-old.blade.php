@extends('admin.layouts.master')

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
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">sports_bar</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <form action="{{ route('admin.seller-product.accept-old', $sellerProduct->id) }}"
                                  method="post"
                                  enctype="multipart/form-data" id="acceptRejectForm">
                                {{ csrf_field() }}
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
                                                <p>{{ $product->name }}</p>
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
                                                <p>{{ $product->brand }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="material-datatables col-md-10 col-md-offset-1">
                                        @if (count($productVariants) > 0)
                                            <hr>
                                            <table id="datatables"
                                                   class="table table-no-bordered table-hover"
                                                   cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Volume</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Image</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productVariants as $productVariant)
                                                    <tr>
                                                        <td class="text-center">
                                                            <a href="{{route('seller-product.show', $productVariant->id) }}">
                                                        <span class="label label-info">
                                                        {{ $productVariant->name }}
                                                        </span>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">{{ $productVariant->parentVolume->volume }}
                                                            ml
                                                        </td>
                                                        <td class="text-center">{{ $productVariant->parentVolume->quantity }}
                                                        </td>
                                                        <td class="text-center">
                                                        <span class="label label-success">
                                                            Rs. {{ $productVariant->price }}
                                                        </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div id="imageDiv{{ $productVariant->id }}">
                                                                @if ($productVariant->parentVolume->image)
                                                                    <div class="col-md-7">
                                                                        <div id="imageDiv{{ $productVariant->id }}">
                                                                            <img class="thumbnail img-responsive"
                                                                                 src="{{URL::asset($productVariant->parentVolume->image) }}"
                                                                                 alt="" style="height:110px; width:100px; display: block;
                                                                             margin-left: auto;
                                                                             margin-right: auto;"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-2">
                                                                    <button type="button"
                                                                            class="btn btn-success uploadButton"
                                                                            id="uploadbutton{{ $productVariant->id }}"
                                                                            data-id="{{ $productVariant->id  }}">Upload
                                                                        New
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div id="uploadDiv{{ $productVariant->id }}"
                                                                 style="display: none"
                                                                 align="center">
                                                                <div class="col-md-7 col-md-offset-1">
                                                                    <div class="input-group col-md-12"
                                                                         id="uploadDiv{{ $productVariant->id }}">
                                                                        <div class="form-group">
                                                                            <div
                                                                                class="form-group is-empty is-fileinput">
                                                                                <input type="file"
                                                                                       name="images[{{ $productVariant->id }}]">
                                                                                <div class="input-group col-md-12">
                                                                                <span class="input-group-addon">
                                                                                    <i class="material-icons">image</i>
                                                                                </span>
                                                                                    <input type="text" readonly=""
                                                                                           class="form-control"
                                                                                           placeholder="Image (Max: 2mb)">
                                                                                    <span
                                                                                        class="input-group-btn input-group-sm">
                                                                                    <button type="button"
                                                                                            class="btn btn-fab btn-fab-mini">
                                                                                    <i class="material-icons">attach_file</i>
                                                                                    </button>
                                                                                </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button"
                                                                            class="btn btn-default cancelButton"
                                                                            data-id="{{ $productVariant->id }}"
                                                                            id="cancelButton{{ $productVariant->id }}">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            No Product Variants Available
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div align="right">
                                    <button class="btn btn-success" type="submit" name="type" value="accept">Accept
                                    </button>
                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#rejectionModal">Reject
                                    </button>
                                    <input type="hidden" name="rejectionMessage" id="rejectionMessage">
                                    <input type="hidden" name="type" id="type" value="accept">
                                </div>
                            </form>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog"
                     aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="material-icons">clear</i>
                                </button>
                                <h4 class="modal-title">Add Rejection Message</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group label-floating"><label>Rejection Message</label>
                                            <textarea class="form-control" id="rejectionModalMessage"
                                                      name="rejection_message"
                                                      id="article-ckeditor"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-simple" id="rejectButton">Reject</button>
                                <button type="button" class="btn btn-danger btn-simple"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card">
                        <div class="card-content">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="">
                            @endif
                            <br>
                            <br>
                            <h6 class="category text-gray" style="text-align: left">
                                <i class="material-icons">assignment_ind</i>
                                <span class="label label-success" rel="tooltip" data-placement="bottom"
                                      data-original-title="Seller">{{ $sellerProduct->seller->first_name }} {{ $sellerProduct->seller->last_name }}</span>
                            </h6>
                            <h6 class="category text-gray" style="text-align: left">
                                <i class="material-icons">category</i>
                                <span class="label label-info" rel="tooltip" data-placement="bottom"
                                      data-original-title="Category">{{ $product->category->title }}</span>
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

@section('scripts')
    <script>
        $('.uploadButton').on('click', function () {
            id = $(this).attr('data-id');
            console.log('id', id);
            $('#imageDiv' + id).css('display', 'none');
            $('#uploadDiv' + id).css('display', '');
        })

        $('.cancelButton').on('click', function () {
            id = $(this).attr('data-id');
            $('#uploadDiv' + id).css('display', 'none');
            $('#imageDiv' + id).css('display', '');
        })

        $('#rejectButton').on('click', function () {
            $('#rejectionMessage').val($('#rejectionModalMessage').val());
            $('#type').val('reject');
            $('#acceptRejectForm').submit();
        })
    </script>
@endsection
