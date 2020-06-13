@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/article')}}">Article</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>Edit Student Paper</h1><hr/>
    <div class="row mb-4">
        @if($data->row_status == 'revised')
        <div class="col-md-12">
            @if($data->is_revised == 1)
                <div class="alert alert-success" role="alert">
                    We are reviewing your changes
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    {{$data->notes}}
                </div>
            @endif
            @include('partial._article_revision')
        </div>
        @else
        <div class="col-md-12">
            @include('partial._article_edit')
        </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{url('/js/tinymce_init.js')}}"></script>
    <script src="{{url('/js/edit.js')}}"></script>
    <script type="text/javascript">
        url_revision = '/article/submit-revision';
        url = '/article/update';
    </script>
@endsection