@extends('seller.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">DataTables.net</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>FUll Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Payment Method</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>S.N</th>
                                        <th>FUll Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Payment Method</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </tfoot>
                                    {{--@if(count($products)>0)--}}
                                        {{--@foreach($products as $product)--}}
                                            {{--<tbody>--}}
                                            {{--<tr>--}}
                                                {{--<th>{{$product->id}}</th>--}}
                                                {{--<th><a href="{{route('products.show',$product->id)}}">{{$product->name}}</a></th>--}}
                                                {{--<th>{{$product->brand}}</th>--}}
                                                {{--<th>{{$product->code}}</th>--}}
                                                {{--<th>{{$product->price}}</th>--}}
                                                {{--<th>{{$product->quantity}}</th>--}}
                                                {{--<th>{{$product->cover_image}}</th>--}}
                                                {{--<th>{{$product->discount}}</th>--}}
                                                {{--<td class="text-right">--}}
                                                    {{--<a href="{{route('products.edit',$product->id)}}" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>--}}
                                                    {{--{!!Form::open(['action' => ['ProductsController@destroy',$product->id],'method' =>'POST']) !!}--}}
                                                    {{--{{Form::hidden('_method','DELETE')}}--}}
                                                    {{--{{Form::submit('DEL',['class' =>'btn btn-simple btn-danger btn-icon remove'])}}--}}
                                                    {{--{!! Form::close() !!}--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}

                                            {{--</tbody>--}}
                                        {{--@endforeach--}}
                                    {{--@else--}}
                                        {{--{--}}
                                        {{--echo"No Product Found";--}}
                                        {{--}--}}
                                    {{--@endif--}}
                                </table>
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
@endsection
