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
    <h1>Change Password</h1><hr/>
    <div class="pl-1 mb-4">
        <form id="form_change_password" method="POST">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control"  name="old_password">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control"  name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            <button id="btn_submit" type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#form_change_password').on('submit', function(event) {
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
                                url:'/change-password/submit',
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
                                        window.location="/change-password";
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