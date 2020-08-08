@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/'.Helper::get_slug($data->type))}}">{{ucwords($data->type)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card p-3">
                <h3>{{$data->title}}</h3>
                <div class="row mt-4">
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            @if($data->type == "article")
                                <img class="card-img-top" src="{{url('/assets/upload/article'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
                            @elseif($data->type == "paper")
                                <img class="card-img-top" src="{{url('/assets/upload/student-paper'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
                            @else
                                <img class="card-img-top" src="{{url('/images/'.Helper::get_slug($data->type).'.png')}}" width="100%" alt="Card image cap">
                            @endif
                            <ul class="list-group">
                                <li class="list-group-item">Download
                                    <ul class="list mb-2 mt-2 list-unstyled" style="padding-inline-start: 0px;">
                                        @if($data->type == "paper")
                                            <li><a class="btn btn-outline-success btn-block" href="{{url('/download/'.$data->type .'/'. $data->code.'/cover/'.$data->cover_pdf)}}"><i data-feather="download" class="mr-2"></i>Cover</a></li>
                                            <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/chapter1/'.$data->chapter_1)}}"><i data-feather="download" class="mr-2"></i>Chapter 1</a></li>
                                            <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/chapter2/'.$data->chapter_2)}}"><i data-feather="download" class="mr-2"></i>Chapter 2</a></li>
                                            @if(Auth::check())
                                                @if($data->lock_chapter_3 == 1)
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/chapter3/'.$data->chapter_3)}}"><i data-feather="download" class="mr-2"></i>Chapter 3</a></li>
                                                @else
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 3</a></li>
                                                @endif
                                                @if($data->lock_chapter_4 == 1)
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/chapter4/'.$data->chapter_4)}}"><i data-feather="download" class="mr-2"></i>Chapter 4</a></li>
                                                @else
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 4</a></li>
                                                @endif
                                                @if($data->lock_chapter_5 == 1)
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/chapter5/'.$data->chapter_5)}}"><i data-feather="download" class="mr-2"></i>Chapter 5</a></li>
                                                @else
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 5</a></li>
                                                @endif
                                                @if($data->lock_reference == 1)
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/reference/'.$data->reference)}}"><i data-feather="download" class="mr-2"></i>Reference</a></li>
                                                @else
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Reference</a></li>
                                                @endif
                                                @if($data->lock_appendix == 1)
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="{{url('/download/'.$data->type .'/'. $data->code.'/appendix/'.$data->appendix)}}"><i data-feather="download" class="mr-2"></i>Appendix</a></li>
                                                @else
                                                    <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Appendix</a></li>
                                                @endif
                                            @else
                                                <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 3</a></li>
                                                <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 4</a></li>
                                                <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Chapter 5</a></li>
                                                <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Reference</a></li>
                                                <li><a class="btn btn-outline-success btn-block mt-2" href="javascript:void(0)"><i data-feather="lock" class="mr-2"></i>Appendix</a></li>
                                                <small class="mt-2">Please login to open unlocked file</small>
                                            @endif
                                        @else
                                            <li><a class="btn btn-outline-success btn-block" href="{{url('/download/'.$data->type .'/'. $data->code.'/all/'.$data->upload_file)}}"><i data-feather="download" class="mr-2"></i>Download File</a></li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="list-group-item"><div class="p">Submitted Date <br/> {{$data->created_at}}</div></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        @if($data->type == "article" || $data->type == "paper" )
                            <table class="mb-4">
                                <tr>
                                    <td class="align-top">Type</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->type)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Author</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        @if($data->author_1)
                                            {{ucwords($data->author_1)}}
                                        @endif
                                        @if($data->author_2)
                                            <br/>{{ucwords($data->author_2)}}
                                        @endif
                                        @if($data->author_3)
                                            <br/>{{ucwords($data->author_3)}}
                                        @endif
                                        @if($data->author_4)
                                            <br/>{{ucwords($data->author_4)}}
                                        @endif
                                        @if($data->author_5)
                                            <br/>{{ucwords($data->author_5)}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Issued Date</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->issued_date)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Publisher</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->publisher_name)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Publication Place</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->publication_place)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">ISBN ISSN</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->isbn_issn)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Subject</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{ucwords($data->subject)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-top">Total Download</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{Helper::get_download_count($data->id)}}
                                    </td>
                                </tr>
                            </table>
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
                                    <td>{{ucwords($data->author_1)}}</td>
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
                                    <td class="align-top">Total Download</td>
                                    <td class="align-top text-center" width="50">:</td>
                                    <td>
                                        {{Helper::get_download_count($data->id)}}
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
