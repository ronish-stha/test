@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="content">
        @include('admin.includes.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple"><i
                                class="material-icons">assignment_ind</i></div>
                        <div class="card-content"><h4 class="card-title">Sellers</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($sellers) == 0 )
                                No seller available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Store Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Verification Document</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead> @foreach ($sellers as $seller)
                                            <tr>
                                                <td class="text-center">{{ $seller->id }}</td>
                                                <td class="text-center">{{ $seller->first_name . ' ' . $seller->last_name }}</td>
                                                <td class="text-center">{{ $seller->email }}</td>
                                                <td class="text-center">{{ $seller->sellerDetail->store_name }}</td>
                                                <td class="text-center">
                                                    @if ($seller->document && !$seller->verified)
                                                        @php
                                                            $alert = 'info';
                                                            $msg = 'Pending';
                                                            $document = 'Received';
                                                        @endphp
                                                    @endif
                                                    @if (!$seller->document && !$seller->verified)
                                                        @php
                                                            $alert = 'warning';
                                                            $msg = 'Not Verified';
                                                            $document = 'Not Received';
                                                        @endphp
                                                    @endif
                                                    @if (($seller->document && $seller->verified) || (!$seller->document && $seller->verified))
                                                        @php
                                                            $alert = 'success';
                                                            $msg = 'Verified';
                                                            $document = 'Received';
                                                        @endphp
                                                    @endif
                                                    <span class="label label-{{ $alert }}" rel="tooltip">
                                                            {{ $msg }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="label label-{{ $alert }}"
                                                          rel="tooltip"> {{ $document }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('sellers.show', $seller->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini"> <i
                                                            class="material-icons">search</i>
                                                    </a>
                                                    {{--@if ($seller->document)
                                                        @if (!$seller->verified && !$seller->status)
                                                            <form
                                                                action="{{ route('admin.seller.verify', $seller->id) }}"
                                                                method="post"
                                                                style="display: inline-block">
                                                                {{ csrf_field() }}
                                                                <button type="submit"
                                                                        class="btn btn-success btn-raised btn-fab btn-fab-mini"
                                                                        rel="tooltip" data-placement="bottom"
                                                                        data-original-title="Verify">
                                                                    <i class="material-icons">check</i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif--}}
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
