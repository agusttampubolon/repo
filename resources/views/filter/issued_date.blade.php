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
    <h2>Search By Issued Date</h2><hr/>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <form class="form-inliness">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select class="form-control" name="issued_date" required>
                                @foreach(Helper::get_year() as $year)
                                    <option value="{{$year}}" {{$issued_date == $year ? "selected" : ""}}>{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="input-group">
                            <input type="text" class="form-control keyword" value="{{$keyword}}" name="keyword" placeholder="Search title, abstract, title or subject">
                            <div class="input-group-btn">
                                <button class="btn btn-search" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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
