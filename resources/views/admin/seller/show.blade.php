@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
          integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg=="
          crossorigin="anonymous"/>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">assignment_ind</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $seller->first_name . ' ' . $seller->last_name }}</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <br>
                            <div class="col-md-offset-1 col-md-10">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p><b>Store Name</b></p>
                                            <p>{{ $seller->sellerDetail->store_name }}</p>
                                        </td>
                                        <td>
                                            <p><b>Owner Name</b></p>
                                            <p>{{ $seller->sellerDetail->owner_name }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Address</b></p>
                                            <p>{{ $seller->sellerDetail->address }}</p>
                                        </td>
                                        <td>
                                            <p><b>Store Name</b></p>
                                            <p>{{ $seller->sellerDetail->district }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Phone</b></p>
                                            <p>{{ $seller->phone }}</p>
                                        </td>
                                        <td>
                                            @if ($seller->document && !$seller->verified)
                                                @php
                                                    $alert = 'info';
                                                    $msg = 'Pending';
                                                @endphp
                                            @endif
                                            @if (!$seller->document && !$seller->verified)
                                                @php
                                                    $alert = 'warning';
                                                    $msg = 'Not Verified';
                                                @endphp
                                            @endif
                                            @if (($seller->document && $seller->verified) || (!$seller->document && $seller->verified))
                                                @php
                                                    $alert = 'success';
                                                    $msg = 'Verified';
                                                @endphp
                                            @endif
                                            <p><b>Status</b></p>
                                            <p>
                                                <span class="label label-{{ $alert }}" rel="tooltip">
                                                    {{ $msg }}
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Verification Document</b></p>
                                        </td>
                                        <td>
                                            <div class="col-md-1">
                                                @if ($seller->sellerDetail->business_registration)
                                                    <a data-fancybox="images"
                                                       href="{{ asset($seller->sellerDetail->business_registration) }}">
                                                        <img
                                                            src="{{ asset($seller->sellerDetail->business_registration) }}"
                                                            style="height:110px; width:100px; display: block;"
                                                            alt="">
                                                    </a>
                                                    <br>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Province</b></p>
                                            <p>{{ $seller->sellerDetail->province }}</p>
                                        </td>
                                        <td>
                                            <p><b>Location</b></p>
                                            <p>{{ $seller->sellerDetail->location }}</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @if ($seller->lat && $seller->lng)
                                    <div id="map-div" style="height: 500px; width: 100%">
                                        <div id="map"></div>
                                    </div>
                                @endif
                                @if ($seller->document)
                                    @if (!$seller->verified)
                                        <hr>
                                        <div align="center">
                                            <form
                                                action="{{ route('admin.seller.verify', $seller->id) }}"
                                                method="post"
                                                style="display: inline-block">
                                                {{ csrf_field() }}
                                                <input type="submit" name="status" value="Approve"
                                                       class="btn btn-success btn-raised"
                                                       rel="tooltip" data-placement="bottom"
                                                       data-original-title="Approve">
                                                <input type="submit" name="status" value="Disapprove"
                                                       class="btn btn-danger btn-raised"
                                                       rel="tooltip" data-placement="bottom"
                                                       data-original-title="Disapprove">
                                            </form>
                                        </div>
                                    @endif
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
@endsection

@section('scripts')
    <script>
        var lat = {{ $seller->lat }};
        var lng = {{ $seller->lng }};
        var placeSearch, autocomplete, types = ['establishment']
        var coordinate = {}

        function initAutocomplete() {
            initMap(lat, lng)
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type  {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: types, componentRestrictions: {country: "NP"}});
            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            initMap(place.geometry.location.lat(), place.geometry.location.lng())
        }

        function initMap(lat, lng) {
            var center = {lat: lat, lng: lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: center,
                scrollwheel: false,
                disableDoubleClickZoom: true
            });
            var marker = new google.maps.Marker({
                position: center,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById('lat').value = evt.latLng.lat()
                document.getElementById('lng').value = evt.latLng.lng()
            });
        }

        $(document).on("keypress", "form", function (event) {
            return event.keyCode != 13;
        });
    </script>
    <script type="text/javascript"
            src="{{ 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_API_KEY') . '&libraries=places&callback=initAutocomplete' }}"
            async defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"
            integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA=="
            crossorigin="anonymous"></script>
@endsection
