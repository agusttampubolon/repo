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
    <h4>Search By Types</h4><hr/>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <table class="table" style="max-width: 300px">
                <tr>
                    <th>Type</th>
                    <th style="text-align: center">Count</th>
                </tr>
                @foreach($data as $item)
                <tr>
                    <td>{{$item->type}}</td>
                    <td align="center">{{$item->count}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection