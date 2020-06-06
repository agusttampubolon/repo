@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Filter</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h4>Search by Title</h4><hr/>
    <div class="row">
        <div class="col-md-12 mb-4">
            @include("filter._search_style_2")

            <div class="row mt-3">
                <div class="col-md-12">
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
        </div>
    </div>
@endsection
