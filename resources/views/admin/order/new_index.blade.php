@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">credit_card</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">New Orders</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($orders) == 0 )
                                No new order available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Total</th>
                                            {{--<th class="text-center">Discount</th>--}}
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">{{ $order->id }}</td>
                                                <td class="text-center">{{ $order->created_at->toDateString() }}</td>
                                                <td class="text-center">{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                                                <td class="text-center">{{ $order->total }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('order.show', $order->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                    @if ($order->status == 'unchecked' || $order->status == 'unapproved')
                                                        <a href="{{ route('order.deliver', $order->id) }}" type="button"
                                                           class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                                           rel="tooltip" data-placement="bottom" title="Deliver">
                                                            <i class="material-icons">done</i>
                                                        </a>
                                                    @endif
                                                    @if ($order->status == 'on delivery')
                                                        <a href="{{ route('order.approve', $order->id) }}" type="button"
                                                           class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                                           rel="tooltip" data-placement="bottom" title="Approve">
                                                            <i class="material-icons">done</i>
                                                        </a>
                                                    @endif
                                                    <button class="btn btn-danger btn-raised btn-fab btn-fab-mini"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            data-id="{{ $order->id }}">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
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
                var ordersId = $(e.relatedTarget).data('id');
                var url = '{{ route("sales.destroy", ":id") }}';
                url = url.replace(':id', ordersId);
                $('#deleteForm').attr('action', url);
            })
        })
    </script>
@endsection
