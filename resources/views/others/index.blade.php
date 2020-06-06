@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Others</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>Others</h1><hr/>
    @include("partial._list")
@endsection
