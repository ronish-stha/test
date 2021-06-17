@if ($bannerAd)
    <div class="modal" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true" style="width: 80%; margin-left: 10%; margin-top: 50px;">
        <button type="button" class="close closeModal" id="closemodal" data-dismiss="modal" style="cursor: pointer">
            <span>&times;</span>
        </button>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="outline ">
                    <div class="row " style="margin:0; background-color: white;">
                        <div class="col-md-6 " style="background-color: #69a423; ">
                            <img src="{{ $bannerAd->image }}"
                                 alt=" ">
                        </div>
                        <div class="col-md-6 " style="padding: 20px; ">
                            <div class="dotted-border ">
                                <h2><strong>{{ $bannerAd->heading1 }}</strong></h2>
                                {{--                                <h2><strong>Take <span style="color: #69a423; ">15%</span> off</strong></h2>--}}
                                {{--                                <h6> On Your First Purchase</h6>--}}
                                <h6>{{ $bannerAd->heading2 }}</h6>
                                <div id="offerDiv">
                                    <form action="{{ route('offer.redeem', $bannerAd->id) }}" method="post"
                                          id="offerForm">
                                        <div class="pl-2 pr-2">
                                            <div class="alert alert-danger alert-dismissible fade show" id="alertDiv"
                                                 style="display: none" role="alert">
                                                <p id="alertMessage"></p>
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="form-inside ">
                                            <p>Enter your email below to get started.</p>
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <input type="text " name="email" id="offerEmail" class="form-control "
                                                   placeholder="Enter your Email here" required>
                                            <button class="btn" type="submit" id="bannerSubmit" style="cursor:pointer;">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                    <div id="codeDiv" class="form-inside" style="display: none">
                                        <h3><strong>Code: {{ $bannerAd->code }}</strong></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
