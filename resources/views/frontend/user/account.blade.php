@extends('frontend.layout.master')
@section('styles')
    <style>
        .personal-profile {
            padding: 30px 30px;
            min-height: 240px;
        }

        .personal-profile ul li {
            font-size: 12px;
        }

        .billing-address {
            position: absolute;
            right: 0;
            width: 50%;
            padding: 0 20px;
            margin-top: 30px;
        }

        .no-style {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        .footer-modal {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 15px;
            border-top: 1px solid #e0ecef;
        }

        .footer-modal > :not(:last-child) {
            margin-right: .25rem;
        }

        .footer-modal > :not(:first-child) {
            margin-left: .25rem;
        }

        .modal-header .close {
            padding: 1rem !important;
            margin: -1rem -1rem -1rem auto !important;
        }

        .close:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        .close {
            float: right !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            color: #939393 !important;
            text-shadow: 0 1px 0 #fff !important;
            opacity: .5;
        }

        button.close {
            padding: 0;
            background-color: transparent !important;
            border: 0;
        }

        .close:focus, .close:hover {
            color: #000 !important;
            text-decoration: none;
            opacity: .75;
        }
    </style>
@endsection
@section('content')
    <div class="contaier-fluid ptb-40" style="background: #eeeeee">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <p>Hello, {{ $user->first_name }} {{ $user->last_name }}</p>
                    <h5><strong>Manage my Account</strong></h5>
                    <ul style="padding-left: 30px">
                                <li><a href="{{ route('account') }}">Profile</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#editAddressModal">Change Delivery Address</a></li>
                    </ul>
                    <h5 class="pt-20"><strong>My Order</strong></h5>
                    <ul style="padding-left: 30px">
                        <li><a href="{{ route('orders') }}">Orders</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    @include('frontend.includes.message')
                    <h4><strong>Manage my account</strong></h4>
                    <div class="row ptb-30">
                        <div class="col-lg-4">
                            <div class="card personal-profile">
                                <h6><strong>Personal Profile</strong> | <span><a href="#"
                                                                                 data-target="#editProfileModal"
                                                                                 data-toggle="modal">edit</a></span>
                                </h6>
                                <ul>
                                    <li><p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                                    </li>
                                    <li><strong>Email:</strong> {{ $user->email }}</li>
                                    <li><strong>Phone:</strong> {{ $user->phone }}</li>
                                    {{--                                    <li><strong>Gender:</strong> Male</li>--}}
                                    {{--                                    <li><strong>DOB:</strong> 1996/02/09</li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card personal-profile">
                                <h6><strong>Address</strong> | <span><a href="#"
                                                                        data-target="#editAddressModal"
                                                                        data-toggle="modal">edit</a></span></h6>
                                <ul style="">
                                    {{--                                <ul style="width: 50%; border-right:1px solid #22222250; padding-right:10px">--}}
                                    <li><P>DELIVERY ADDRESS</P></li>
                                    {{--<li><strong>Bibek Oli</strong></li>--}}
                                    <li>{{ $user->address }}</li>
                                    <li>{{ $user->city }}</li>
                                    {{--                                    <li>Bagmati - Kathmandu Metro 9 - Sinamangal Area - Old Baneshwor</li>--}}
                                    {{--                                    <li>(+977) 9851123456</li>--}}
                                </ul>
                                {{--<ul class='billing-address'>
                                    <li><p>DEFAULT BILLING ADDRESS</p></li>
                                    <li><strong>Bibek Oli</strong></li>
                                    <li>Apple Corp. inc</li>
                                    <li>Bagmati - Kathmandu Metro 9 - Sinamangal Area - Old Baneshwor</li>
                                    <li>(+977) 9851123456</li>
                                </ul>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class=" col-lg-9">
                    <div class="card personal-profile">
                        <h5>Recent Orders</h5>
                        @if (count($orders) != 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Placed On</th>
                                    {{--                                    <th class=text-center>Items</th>--}}
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td class="text-center">{{ Helper::getFormattedDate($order->created_at) }}</td>
                                        {{--                                        <td class=text-center></td>--}}
                                        <td class="text-center">{{ $order->total }}</td>
                                        <td class="text-center"><a href="{{ route('order.detail', $order->id) }}">View Details</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No orders available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="col-md-12" action="{{ route('profile.update') }}" id="editProfileForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pointer" data-dismiss="modal">Close</button>
                    <button type="submit" id="editProfileSubmit" class="btn btn-primary pointer">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="col-md-12" action="{{ route('update.password') }}" id="changePasswordForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Old Password:</label>
                            <input type="password" class="form-control" name="old_password">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">New Password:</label>
                            <input type="password" class="form-control" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pointer" data-dismiss="modal">Close</button>
                    <button type="submit" id="changePasswordSubmit" class="btn btn-primary pointer">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Delivery Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="col-md-12" action="{{ route('address.update') }}" id="editAddressForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">City:</label>
                            <input type="text" class="form-control" name="city" value="{{ $user->city }}" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pointer" data-dismiss="modal">Close</button>
                    <button type="submit" id="editAddressSubmit" class="btn btn-primary pointer">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#editProfileSubmit').on('click', function () {
            $('#editProfileForm').submit();
        });
        $('#changePasswordSubmit').on('click', function () {
            $('#changePasswordForm').submit();
        });
        $('#editAddressSubmit').on('click', function () {
            $('#editAddressForm').submit();
        });
    </script>
@endsection
