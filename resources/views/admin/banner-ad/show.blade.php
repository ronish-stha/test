@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">redeem</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">{{ $bannerAd->title }}</h4>
                            <div class="col-md-offset-1 col-md-10">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <p><b>Title</b></p>
                                            <p>{{ $bannerAd->title }}</p>
                                        </td>
                                        <td>
                                            <p><b>Discount</b></p>
                                            <p>{{ $bannerAd->discount }}%</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Heading 1</b></p>
                                            <p>{{ $bannerAd->heading1 }}</p>
                                        </td>
                                        <td>
                                            <p><b>Heading 2</b></p>
                                            <p>{{ $bannerAd->heading2 }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Code</b></p>
                                            <p>{{ $bannerAd->code }}</p>
                                        </td>
                                        <td>
                                            <p><b>Status</b></p>
                                            <p><span
                                                    class="label label-{{ $bannerAd->status ? 'success' : 'danger' }}"
                                                    rel="tooltip" data-placement="bottom"
                                                    data-original-title="Category">{{ $bannerAd->status ? 'Yes' : 'No' }}</span>
                                            </p>
                                        </td>
                                        <td>
                                            <p><b></b></p>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="row">
                                    <div>
                                        <img src="{{URL::asset($bannerAd->image)}}" style="height:200px; width: 300px">
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div align="center">
                                    <a href="{{ route('banner-ad.index') }}" class="btn btn-info">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
