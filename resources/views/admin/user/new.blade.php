@extends('layouts.admin.app')

@section('content')
    <div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="sb-page-header-content py-5">
                <h1 class="sb-page-header-title">
                    <div class="sb-page-header-icon"><i data-feather="{{$icon}}"></i></div>
                    <span>{{$title}}</span>
                </h1>
                <div class="sb-page-header-subtitle">{{$subtitle}}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">{{$form_name}}</div>
                    <div class="card-body">
                        <div class="col-md-8">
                            <form id="form_submit" method="POST" action="" class="needs-validation" novalidate>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="title">Name*</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Email*</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="publisher">Password*</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="publication_place">Password Confirmation*</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password Confirmation" required>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <button id="btn_save" type="submit" class="btn btn-success w-25">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/admin/user/add.js')}}" type="text/javascript"></script>
@endsection