@extends('admin.layouts.master')

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
                            <i class="material-icons">star</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Reviews</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                @if(count($reviews)>0)
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Rating</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviews as $review)
                                            <tr>
                                                <td class="text-center">{{ $review->id }}</td>
                                                <td class="text-center">
                                                    {{ $review->user->first_name . ' ' . $review->user->last_name }}
                                                </td>
                                                <td class="text-center">
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
                                                 </td>
                                                <td class="text-center">
                                                    {!! $review->description? str_limit($review->description, $limit = 50, $end = '...') : '-' !!}
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                            class="label label-{{ $review->status == 'disapproved' ? 'warning' : 'success' }}">
                                                        {{ $review->status }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($review->status == 'disapproved')
                                                        <a href="{{ route('review.status', $review->id) }}"
                                                           class="btn btn-success btn-raised btn-fab btn-fab-mini">
                                                            <i class="material-icons">done</i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('review.status', $review->id) }}"
                                                           class="btn btn-warning btn-raised btn-fab btn-fab-mini">
                                                            <i class="material-icons">report</i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('review.show', $review->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                    <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            data-id="{{ $review->id }}">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    No Review Available
                                @endif
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
                var reviewId = $(e.relatedTarget).data('id');
                var url = '{{ route("review.destroy", ":id") }}';
                url = url.replace(':id', reviewId);
                $('#deleteForm').attr('action', url);
            })
        })
    </script>
@endsection