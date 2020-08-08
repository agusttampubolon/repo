@extends('layouts.admin.app')

@section('content')
    <div class="sb-page-header pb-10 sb-page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="sb-page-header-content py-5">
                <h1 class="sb-page-header-title">
                    <div class="sb-page-header-icon"><i data-feather="settings"></i></div>
                    <span>Configuration</span>
                </h1>
                <div class="sb-page-header-subtitle">Cache</div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Cache has been cleared</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection