@extends('seller.layouts.master')

@section('content')
    <style>
        .formStyle {
            display: inline
        }
    </style>
    <div class="content">
        @include('admin.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">insert_photo</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Banners</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">

                            </div>
                        </div>
                        @if (count($banners) > 0)
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                   cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="text-center">S.N</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="text-center">{{ $banner->id }}</td>
                                        <td>
                                            @if ($banner->image)
                                                <img class="thumbnail img-responsive"
                                                     src="{{URL::asset('storage/banner/' . $banner->image) }}"
                                                     alt="" style="height:100px; width:100px; display: block;
                                                             margin-left: auto;
                                                             margin-right: auto;"
                                                />
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $banner->type }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('banner.show', $banner->id) }}"
                                               class="btn btn-info btn-raised btn-fab btn-fab-mini"
                                               style="color: white">
                                                <i class="material-icons">search</i>
                                            </a>
                                            <a href="{{ route('banner.edit', $banner->id) }}"
                                               class="btn btn-primary btn-raised btn-fab btn-fab-mini"
                                               style="color: white">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                    data-toggle="modal"
                                                    data-target="#deleteModal"
                                                    data-id="{{ $banner->id }}">
                                                <i class="material-icons">clear</i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            No Banner Available
                        @endif
                    </div>
                    <h4>Promotions</h4>
                    <br>
                    <div class="row">
                        @if (count($promotions) > 0)
                            @for ($i = 0; $i < count($promotions); $i++)
                                <div class="col-md-{{ $i + 3 }}">
                                    <div class="card card-product">
                                        <div class="card-image" data-header-animation="true">
                                            <a href="#pablo">
                                                <img class="img"
                                                     src="{{ URL::asset('storage/banner/' . $promotions[$i]->image) }}">
                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-actions">
                                                <a href="{{ route('banner.edit', $promotions[$i]->id) }}" type="button"
                                                   class="btn btn-success btn-simple" rel="tooltip"
                                                   data-placement="bottom" title="Edit">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </div>
                                            <h4 class="card-title">
                                                <a href="#pablo">Promotion {{ $i + 1 }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <p>No Promotion Available</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <!-- end content-->
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-small ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="material-icons">clear</i></button>
                </div>
                <form id="deleteForm" action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-body text-center">
                        <h5>Are you sure you want to do this?</h5>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-simple" data-dismiss="modal">No
                        </button>
                        <button type="submit" class="btn btn-success btn-simple">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#deleteModal').on('show.bs.modal', function (e) {
                var bannerId = $(e.relatedTarget).data('id');
                var url = '{{ route("banner.destroy", ":id") }}';
                url = url.replace(':id', bannerId);
                $('#deleteForm').attr('action', url);
            })
        })
    </script>
@endsection
