@extends('seller.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Customers</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($customers) == 0 )
                                No customer available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Phone</th>
                                            {{--<th class="text-center">Discount</th>--}}
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td class="text-center">{{ $customer->id }}</td>
                                                <td class="text-center">{{ $customer->first_name . ' ' . $customer->last_name }}</td>
                                                <td class="text-center">{{ $customer->email }}</td>
                                                <td class="text-center">{{ $customer->address }}</td>
                                                <td class="text-center">{{ $customer->phone1 }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('customer.show', $customer->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                                        <i class="material-icons">search</i>
                                                    </a>
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

