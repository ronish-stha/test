@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.message')
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">add</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title align:cen">Create Banner Ad</h4>
                            <form action="{{ route('banner-ad.store') }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">article</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Title
                                                    <small>*</small>
                                                </label>
                                                <input name="title" type="text" class="form-control"
                                                       value="{{ old('title') }}" autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Discount</label>
                                                <input name="discount" type="number" class="form-control"
                                                       value="{{ old('discount') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">receipt</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Heading 1
                                                    <small>*</small>
                                                </label>
                                                <input name="heading1" type="text" class="form-control"
                                                       value="{{ old('heading1') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Heading 2
                                                </label>
                                                <input name="heading2" type="text" class="form-control"
                                                       value="{{ old('heading2') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">receipt</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Code
                                                    <small>*</small>
                                                </label>
                                                <input name="code" type="text" class="form-control"
                                                       value="{{ old('code') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Offer
                                                </label>
                                                <input name="offer" type="text" class="form-control"
                                                       value="{{ old('offer') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">event</i>
                                            </span>
                                            <div class="form-group">
                                                <label class="control-label">Expiry Date
                                                </label>
                                                <input name="expiry_date" type="text" class="form-control datepicker"
                                                       value="{{ old('expiry_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Status
                                                </label>
                                                <input name="status" type="radio" value="1" required>
                                                Active
                                                <input name="status" type="radio" value="0" required>
                                                Inactive
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-5 col-md-offset-1">
                                        <div class="input-group col-md-12">
                                            <div class="form-group">
                                                <div class="form-group is-empty is-fileinput">
                                                    <input type="file" name="image" id="inputFile4" multiple=""
                                                           required>
                                                    <div class="input-group col-md-12">
                                                         <span class="input-group-addon">
                                                            <i class="material-icons">image</i>
                                                         </span>
                                                        <input type="text" readonly="" class="form-control"
                                                               placeholder="Image*">
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
                                <hr>
                                <br>
                                <br>
                                <div align="center">
                                    <input type="submit" class="btn btn-success">
                                    <a href="{{ route('banner-ad.index') }}" class="btn btn-info">Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    </script>
@endsection
