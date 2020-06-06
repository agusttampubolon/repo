<div class="row">
    @include("filter._search_style_1")
    <div class="col-sm-12 mb-4">
        <div class="card">
            <div class="card-header">
                Total Result : {{$data ? $data->total() : "0" }}
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
                                @if($item->abstract_eng)
                                <div class="abstract"><p class="mb-1">{!! $item->abstract_eng !!}</p></div>
                                @endif
                                <div class="mt-2"><small class="d-flex"><i class="mr-1" data-feather="calendar"></i> {{$item->created_at}} <i class="mr-1 ml-2"data-feather="user"></i> {{$item->created_by}}</small></div>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="text-center p-10 mt-4 mb-4 ml-3" style="width: 100%">
                    {!! $data->withQueryString()->links()  !!}
                </div>
            </div>
        </div>
    </div>
</div>