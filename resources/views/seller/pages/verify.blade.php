@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-10 col-md-offset-1">
                @include('admin.includes.message')
                @php
                    $user = Auth::user();
                    $sellerDetail = $user->sellerDetail;
                @endphp
                @if(!Auth::user()->document)
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">assignment_ind</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Verify Account</h4>
                            <form action="{{ route('seller.verify.account') }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Owner Name
                                                    <small>*</small>
                                                </label>
                                                <input name="owner_name" type="text" class="form-control"
                                                       value="{{ old('owner_name') }}" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">location_on</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address
                                                    <small>*</small>
                                                </label>
                                                <input name="address" type="text" class="form-control"
                                                       value="{{ old('address') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">location_on</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">District
                                                    <small>*</small>
                                                </label>
                                                <input name="district" type="text" class="form-control"
                                                       value="{{ old('district') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">location_on</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Province
                                                    <small>*</small>
                                                </label>
                                                <input name="province" type="text" class="form-control"
                                                       value="{{ old('province') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-lg-offset-1">
                                        <div class="input-group col-md-12">
                                            <div class="form-group">
                                                <div class="form-group is-empty is-fileinput">
                                                    <input type="file" name="business_registration" id="inputFile4"
                                                           multiple="">
                                                    <div class="input-group col-md-12">
                                                     <span class="input-group-addon">
                                                        <i class="material-icons">image</i>
                                                     </span>
                                                        <input type="text" readonly="" class="form-control"
                                                               placeholder="Business Registration Doc | Max: 2mb *">
                                                        <span class="input-group-btn input-group-sm">
                                                        <button type="button" class="btn btn-fab btn-fab-mini">
                                                            <i class="material-icons">attach_file</i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">my_location</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                {{--<label class="control-label">Location
                                                    <small>*</small>
                                                </label>--}}
                                                <input name="location" id="location" type="text" class="form-control"
                                                       placeholder="Enter Store Location (Note: If location has not been set on google maps, drag the marker on the map) *"
                                                       value="{{ old('location') }}" required>
                                                <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                                                <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
                                        <div id="map-div" style="height: 500px; width: 100%">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div align="center">
                                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="red">
                            <i class="material-icons">history_toggle_off</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Verification Pending</h4>
                            <div class="col-md-offset-1 col-md-10">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td><p><b>Store Name</b></p>
                                            <p>{{ $sellerDetail->store_name }}</p></td>
                                        <td><p><b>Owner Name</b></p>
                                            <p>{{ $sellerDetail->owner_name }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p><b>Address</b></p>
                                            <p>{{ $sellerDetail->address }}</p></td>
                                        <td><p><b>Store Name</b></p>
                                            <p>{{ $sellerDetail->district }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p><b>Province</b></p>
                                            <p>{{ $sellerDetail->province }}</p></td>
                                        <td><p><b>Location</b></p>
                                            <p>{{ $sellerDetail->location }}</p></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        </div>
                        <div class="modal-body text-center">
                            <h3><i class="material-icons">sports_bar</i></h3>
                            <h3>Welcome to Liquor Store Seller Center.</h3>
                            <p>You'll need to verify your account with
                                required information and documents to proceed any further.</p>
                            <p>Feel free to contact us for any questions.</p>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" data-dismiss="modal" class="btn btn-success btn-simple">
                                <i class="material-icons">check</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var placeSearch, autocomplete, types = ['establishment']
        var coordinate = {}

        function initAutocomplete() {
            initMap(27.706457, 85.316426)
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type  {!HTMLInputElement} */(document.getElementById('location')),
                {types: types, componentRestrictions: {country: "NP"}});
            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            initMap(place.geometry.location.lat(), place.geometry.location.lng())
            document.getElementById('lat').value = place.geometry.location.lat()
            document.getElementById('lng').value = place.geometry.location.lng()
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
                console.log('lat', evt.latLng.lat())
                console.log('lng', evt.latLng.lng())
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
    <script>
        let status = {{ Auth::user()->document }};
        $(document).ready(function () {
            if (!status)
                $('#welcomeModal').modal('show');
        })

    </script>
@endsection
