@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search By {{$filter}}</li>
        </ol>
    </nav>
    <div>

    </div>
@endsection

@section('content')
    <h5>{!! $title !!}</h5><hr/>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header">
                    Total Result : {{$data ? $data->total() : "0" }}
                </div>
                <div class="list-group list-group-flush">
                    @include('partial._list_style2')
                </div>
            </div>
        </div>
    </div>
@endsection
