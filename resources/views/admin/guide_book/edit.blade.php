@extends('layouts.admin.app')

@section('content')
    <div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="sb-page-header-content py-5">
                <h1 class="sb-page-header-title">
                    <div class="sb-page-header-icon"><i data-feather="{{$icon}}"></i></div>
                    <span>{{$title}}</span>
                </h1>
                <div class="sb-page-header-subtitle">{{$subtitle}} : {{$data->title}}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">{{$form_name}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <small class="block mb-0 text-muted">Status</small><br/>
                                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left"><b>{{strtoupper($data->row_status)}}</b></small>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <small class="block mb-0 text-muted">Created By</small><br/>
                                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->created_by}}, {{$data->created_at}}</small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <small class="block mb-0 text-muted">Updated At</small><br/>
                                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->updated_by ? $data->updated_by : "-"}}, {{$data->updated_at}}</small>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <small class="block mb-0 text-muted">Total Download</small><br/>
                                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{Helper::get_download_count($data->id)}}</small>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <small class="block mb-0 text-muted">Total Download</small><br/>
                                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{Helper::get_download_count($data->id)}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                @include("partial._guide_book_edit")
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/edit.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        url = '/admin/guide-book/update';
    </script>
@endsection