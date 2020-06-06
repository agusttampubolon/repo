@extends('layouts.frontend.app')

@section('content')
<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form id="form_submit_user" method="POST" action="{{url('/new/user')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">User Type</label>
                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control">
                                    <option value="guest">UMUM</option>
                                    <option value="dosen">DOSEN</option>
                                    <option value="mahasiswa">MAHASISWA</option>
                                </select>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div id="group_profession">
                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">Profesion</label>
                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label id="lbl_identity_number" for="name" class="col-md-4 col-form-label text-md-right">Identity Number (KTP)</label>
                            <div class="col-md-6">
                                <input id="identity_number" type="text" class="form-control @error('email') is-invalid @enderror" name="identity_number" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn_submit" type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#role').on('change', function() {
                if(this.value == "guest"){
                    $("#group_profession").removeClass("hide");
                    $("#group_profession").addClass("show");
                    $("#lbl_identity_number").html("Identity Number (KTP)");
                }else{
                    $("#group_profession").removeClass("show");
                    $("#group_profession").addClass("hide");
                    $("#lbl_identity_number").html("NIM / NIP");
                }
            });
            $('#form_submit_user').on('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Confirmation",
                    text: "Are you sure submit the data?",
                    showCancelButton: true,
                    confirmButtonColor: '#2f4e4f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, register now!'
                })
                    .then((value) => {
                        if (value) {
                            Swal.fire({
                                text: "please wait ...",
                                button: false,
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            });
                            var btn = $("#btn_submit");

                            var token = $('meta[name="csrf-token"]').attr('content');

                            $.ajax({
                                url:'/new/user',
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
                                        window.location="/registration/success";
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
