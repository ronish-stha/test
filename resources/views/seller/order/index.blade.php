@extends('seller.layouts.master')
@section('content')
    <div class="content">
        @include('seller.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">add_shopping_cart</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Orders</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($sellerOrders) == 0 )
                                No order available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Order Date</th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Status</th>
                                            {{--<th class="text-center">Discount</th>--}}
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        @foreach ($sellerOrders as $sellerOrder)
                                            <tr>
                                                <td class="text-center">{{ $sellerOrder->id }}</td>
                                                <td class="text-center">{{ Helper::getTime($sellerOrder->created_at) }}, {{ Helper::getFormattedDate($sellerOrder->created_at) }}</td>
                                                <td class="text-center">{{ $sellerOrder->order->user->first_name . ' ' . $sellerOrder->order->user->last_name }}</td>
                                                <td class="text-center">{{ $sellerOrder->total }}</td>
                                                <td class="text-center">
                                                    @php $alert = null; @endphp
                                                    @if ($sellerOrder->status)
                                                        @switch ($sellerOrder->status)
                                                            @case ('new')
                                                            @php $alert = 'warning'; @endphp
                                                            @break
                                                            @case ('approved')
                                                            @php $alert = 'info'; @endphp
                                                            @break
                                                            @case ('Complete')
                                                            @php $alert = 'success'; @endphp
                                                            @break
                                                        @endswitch
                                                    @endif
                                                    <span
                                                        class="label label-{{ $alert }}">
                                                        {{ $sellerOrder->status }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('seller-order.show', $sellerOrder->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                        <i class="material-icons">search</i>
                                                    </a>
                                                    @if ($sellerOrder->status == 'unchecked' || $sellerOrder->status == 'unapproved')
                                                        <a href="{{--{{ route('seller-order.deliver', $sellerOrder->id) }}--}}"
                                                           type="button"
                                                           class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                                           rel="tooltip" data-placement="bottom" title="Deliver">
                                                            <i class="material-icons">done</i>
                                                        </a>
                                                    @endif
                                                    @if ($sellerOrder->status == 'on delivery')
                                                        <a href="{{--{{ route('seller-order.approve', $sellerOrder->id) }}--}}"
                                                           type="button"
                                                           class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                                           rel="tooltip" data-placement="bottom" title="Approve">
                                                            <i class="material-icons">done</i>
                                                        </a>
                                                    @endif
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
@endsection

@section('scripts')
    <script>

    </script>
@endsection
