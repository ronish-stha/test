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
                                class="material-icons">description</i></div>
                        <div class="card-content"><h4 class="card-title">Content</h4>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            @if (count($contents) == 0 )
                                No content available
                            @else
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead> @foreach ($contents as $content)
                                            <tr>
                                                <td class="text-center">{{ $content->id }}</td>
                                                <td class="text-center">{{ $content->title }}</td>
                                                <td class="text-center">
                                                   {{-- <a href="{{ route('content.show', $content->id) }}"
                                                       class="btn btn-info btn-raised btn-fab btn-fab-mini"> <i
                                                            class="material-icons">search</i>
                                                    </a>--}}
                                                    <a href="{{ route('content.edit', $content->id) }}"
                                                       class="btn btn-success btn-raised btn-fab btn-fab-mini"> <i
                                                            class="material-icons">edit</i>
                                                    </a>
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
