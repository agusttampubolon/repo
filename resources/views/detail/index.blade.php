@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ucwords($data->type)}}</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
            <li class="breadcrumb-item active" aria-current="page">{{$data->code}}</li>
        </ol>
    </nav>
    <div>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card p-3">
                <h3>{{$data->title}}</h3>
                <div class="row mt-4">
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="{{url("/images/banner_default.jpg")}}" width="100%" alt="Card image cap">
                            @if($data->type == "article" || $data->type == "paper" )
                                <ul class="list-group">
                                    <li class="list-group-item">View/Open
                                        <ul class="list mb-2 mt-2" style="padding-inline-start: 20px;">
                                            <li><a href=""><i data-feather="download" class="mr-2"></i>Cover</a></li>
                                            <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 1</a></li>
                                            <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 2</a></li>
                                            <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 3</a></li>
                                            <li><a href=""><i data-feather="lock" class="mr-2"></i>Chapter 4</a></li>
                                            <li><a href=""><i data-feather="lock" class="mr-2"></i>Chapter 5</a></li>
                                            <li><a href=""><i data-feather="lock" class="mr-2"></i>Reference</a></li>
                                            <li><a href=""><i data-feather="lock" class="mr-2"></i>Appendix</a></li>
                                        </ul>
                                        <small class="mt-2">Please login to open unlocked file</small>
                                    </li>
                                    <li class="list-group-item">Date <br/> 2020-09-02</li>
                                    <li class="list-group-item">Author <br/> Tampubolon, Agust Erwinson</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        @if($data->type == "article" || $data->type == "paper" )
                        <p class="h5">Abstract</p>
                        <div class="abstract-full">
                            <p>
                                {!! $data->abstract_eng !!}
                            </p>
                        </div>
                        @else
                            <table class="table">
                                <tr>
                                    <td>Author</td>
                                    <td>:</td>
                                    <td>{{$data->author_1}}</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>:</td>
                                    <td>{{ucwords($data->type)}}</td>
                                </tr>
                                <tr>
                                    <td>Issued Date</td>
                                    <td>:</td>
                                    <td>{{$data->issued_date}}</td>
                                </tr>
                                <tr>
                                    <td>Publisher</td>
                                    <td>:</td>
                                    <td>{{$data->publisher}}</td>
                                </tr>
                                <tr>
                                    <td>Publication Place</td>
                                    <td>:</td>
                                    <td>{{$data->publication_place}}</td>
                                </tr>
                                <tr>
                                    <td>ISBN / ISSN</td>
                                    <td>:</td>
                                    <td>{{$data->isbn_issn}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><a class="btn btn-outline-success btn-sm">Download</a></td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
