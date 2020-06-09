@extends('layouts.frontend.app')

@section('breadcrumb')
    <div class="row mb-1">
        <div class="col-md-3">
            <div class="card mb-2" style="width: 100%;">
                <div class="card-header bg-dark text-light" style="font-weight: 500;">
                    CATEGORIES
                </div>
                <ul class="list-group mt-2">
                    <?php $i=0 ?>
                    @foreach(Helper::get_top_category() as $item)
                        @if($item->type == 'paper')
                            <li class="list-group-item border-bottom-card"><a href="{{url('/student-paper')}}">{{ucwords($item->type == 'paper' ? 'Student Paper' : $item->type)}} ({{$item->count}})</a></li>
                        @else
                            <li class="list-group-item border-bottom-card"><a href="{{url('/'. $item->type == 'paper' ? 'student-paper' : ($item->type == 'guide book' ? 'guide-book' : $item->type))}}">{{ucwords($item->type == 'paper' ? 'Student Paper' : $item->type)}} ({{$item->count}})</a></li>
                        @endif
                        <?php $i++ ?>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <img src="{{url('/images/slider/home.png')}}" width="100%">
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header" style="font-weight: 600;color:#2f4e4f;">
                    RECENTLY ADDED
                </div>
                <div class="list-group list-group-flush">
                    @foreach($data as $item)
                        <div class="row">
                            <div style="float: left;width: 60px;margin-left: 10px;margin-top: 15px;">
                                <div class="entry-date">
                                    <span class="day">{{date('d', strtotime($item->created_at))}}</span>
                                    <span class="month">{{date('M', strtotime($item->created_at))}}</span>
                                </div>
                            </div>
                            <div style="float: left;width: calc(100% - 85px);">
                                <a href="{{url('detail/'.$item->code)}}" class="list-group-item list-group-item-action no-border">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="w-75"><h5 class="mt-0 mb-1 font-bold">{{$item->title}}</h5></div>
                                        <div class="w-25 text-right"><small class="text-muted">{{Helper::time_since(time() - strtotime($item->created_at))}}</small></div>
                                    </div>
                                    <small>{{ucwords($item->author_1)}} ({{$item->publication_place}}, {{$item->issued_date}})</small>
                                    <div class="abstract"><p class="mb-1">{!! $item->abstract_eng !!}</p></div>
                                    <div class="mt-2"><small class="d-flex"><i class="mr-1" data-feather="calendar"></i> {{$item->created_at}} <i class="mr-1 ml-2"data-feather="user"></i> {{$item->created_by}}</small></div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center p-10 mt-4 mb-4 ml-3" style="width: 100%">
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
