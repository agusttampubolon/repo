@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/student-paper')}}">Student Paper</a></li>
            <li class="breadcrumb-item active" aria-current="page">New</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>Add Student Paper</h1><hr/>
    <div class="row">
        <div class="col-md-12">
            @include('partial._student_paper')
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{url('/js/tinymce_init.js')}}"></script>
    <script src="{{url('/js/article/add.js')}}"></script>
@endsection