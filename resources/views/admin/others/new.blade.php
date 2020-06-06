@extends('layouts.admin.app')

@section('content')
    <div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="sb-page-header-content py-5">
                <h1 class="sb-page-header-title">
                    <div class="sb-page-header-icon"><i data-feather="{{$icon}}"></i></div>
                    <span>{{$title}}</span>
                </h1>
                <div class="sb-page-header-subtitle">{{$subtitle}}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">{{$form_name}}</div>
                    <div class="card-body">
                        <div class="col-md-8">
                            @include("partial._others")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/add.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        url = '/admin/others/submit';
    </script>
@endsection