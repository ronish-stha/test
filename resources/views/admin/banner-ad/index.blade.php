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
                                class="material-icons">redeem</i></div>
                        <div class="card-content"><h4 class="card-title">Banner Ad
                                <a href="{{ route('banner-ad.create') }}"
                                   class="btn btn-success btn-raised btn-just-icon pull-right" rel="tooltip"
                                   data-placement="bottom"
                                   data-original-title="Add Banner Ad">
                                    <i class="material-icons">add</i>
                                </a>
                            </h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($bannerAds) == 0 )
                                No banner ad available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead> @foreach ($bannerAds as $bannerAd)
                                            <tr>
                                                <td class="text-center">{{ $bannerAd->id }}</td>
                                                <td class="text-center">{{ $bannerAd->title }}</td>
                                                <td class="text-center">{{ $bannerAd->discount }}%</td>
                                                <td class="text-center">{{ $bannerAd->code }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('banner-ad.show', $bannerAd->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini"> <i
                                                            class="material-icons">search</i>
                                                    </a>
                                                    <a href="{{ route('banner-ad.edit', $bannerAd->id) }}"
                                                       class="btn btn-primary btn-raised btn-fab btn-fab-mini"> <i
                                                            class="material-icons">edit</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                        <!-- end bannerAd-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
