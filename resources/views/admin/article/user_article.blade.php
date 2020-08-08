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
            <input type="hidden" name="user_id" value="{{$data->id}}">
            @include("admin.article._list")
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/admin/article/index.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        init_data_table('user');
    </script>
@endsection