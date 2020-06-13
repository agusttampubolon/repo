@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="h4">My Profile</div><hr/>
    <div class="pl-1 mb-4">
        <form id="form_change_profile" method="POST">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="old_password">Name</label>
                        <input type="text" class="form-control"  name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="email" class="form-control"  name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                    </div>
                </div>
            </div>

            <button id="btn_submit" type="submit" class="btn btn-primary">Change</button>
        </form>

        <div class="title h4 mt-5">My Articles</div>
        <table class="table" width="100%">
            <tr>
                <td align="center">No</td>
                <td>Title</td>
                <td>Submitted At</td>
                <td>Status</td>
                <td></td>
            </tr>
            <?php $no=1 ?>
            @foreach($data as $item)
                <tr>
                    <td align="center">{{$no}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        @if($item->row_status =="pending")
                            <span class="badge badge-warning">{{$item->row_status}}</span>
                        @elseif($item->row_status =="rejected")
                            <span class="badge badge-dark">{{$item->row_status}}</span>
                        @elseif($item->row_status =="active")
                            <span class="badge badge-success">{{$item->row_status}}</span>
                        @elseif($item->row_status =="revised")
                            @if($item->is_revised == 0)
                                <span class="badge badge-primary">{{$item->row_status}}</span>
                            @else
                                <span class="badge badge-warning">on review</span>
                            @endif
                        @endif
                    </td>
                    <td><a href="{{url('/detail/'.$item->code)}}"><i data-feather="eye" class="mr-2"></i></a>
                        @if($item->type =="paper")
                            <a href="{{url('/student-paper/edit/'.$item->id)}}"><i data-feather="edit"></i></a>
                        @else
                            <a href="{{url('/article/edit/'.$item->id)}}"><i data-feather="edit"></i></a>
                        @endif
                    </td>
                </tr>
                <?php $no+=1 ?>
            @endforeach
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#form_change_profile').on('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Confirmation",
                    text: "Are you sure submit the data?",
                    showCancelButton: true,
                    confirmButtonColor: '#2f4e4f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change now!'
                })
                .then((result) => {
                    if (result.value) {
                        Swal.fire({
                            text: "please wait ...",
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            closeOnEsc: false,
                        });

                        var btn = $("#btn_submit");

                        var token = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url:'/change-profile/submit',
                            method:"POST",
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            data:new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(response)
                            {
                                var text = '';
                                var res = JSON.parse(response);
                                if(res.status === 'true') {
                                    window.location="/my-profile";
                                }else{
                                    $.each(res.message, function( index, value ) {
                                        text += value[0]+'<br/>';
                                    });
                                    Swal.fire({
                                        "title": "",
                                        "html": text,
                                        "type": "error",
                                        confirmButtonColor: '#2f4e4f',
                                    });
                                    btn.removeAttr("disabled");
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>
@endsection