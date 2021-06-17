@extends('seller.layouts.master')
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
                            <h4 class="card-title">{{ $customer->first_name . ' ' . $customer->last_name }}</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <br>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Name </strong>{{ $customer->first_name }} {{ $customer->last_name }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email </strong>{{ $customer->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Address </strong>{{ $customer->address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Apartment </strong>{{ $customer->apartment ? $customer->apartment : '-' }}
                                        </p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Location </strong>{{ $customer->location ? $customer->location : '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Post
                                                Code </strong>{{ $customer->post_code ? $customer->post_code : '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Phone</strong>{{ $customer->phone1 }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Phone2 </strong>{{ $customer->phone2 ? $customer->phone2 : '-'}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="material-datatables col-md-offset-1 col-md-9">
                                    @if (count($customer->sales) != 0)
                                        <h4 class="text-center">Previous Transactions</h4>
                                        @foreach ($customer->sales as $sale)
                                            <li>
                                                <a href="{{ route('sales.show', $sale->id) }}">{{ $sale->created_at }}</a>
                                            </li>
                                        @endforeach

                                    @endif
                                    <br>
                                </div>
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
@endsection
