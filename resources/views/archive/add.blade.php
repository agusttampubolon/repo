@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/archive')}}">Archive</a></li>
            <li class="breadcrumb-item active" aria-current="page">New</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>Add Archive</h1><hr/>
    <div class="row">
        <div class="col-md-12">
            @include("partial._archive")
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/article/add.js')}}"></script>
@endsection