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
                        <div class="sb-datatable table-responsive">
                            <table class="table table-striped responsive table-bordered nowrap" id="dt_book" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="width: 15px"></th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Place of Publication</th>
                                    <th>Issued Date</th>
                                    <th>ISBN/ISSN</th>
                                    <th>File</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th data-priority="2" style="text-align: center;">Status</th>
                                    <th data-priority="1" style="text-align: center;">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th style="width: 15px"></th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Place of Publication</th>
                                    <th>Issued Date</th>
                                    <th>ISBN/ISSN</th>
                                    <th>File</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th data-priority="2" style="text-align: center;">Status</th>
                                    <th data-priority="1" style="text-align: center;">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/js/admin/book/index.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        init_data_table('all');
    </script>
@endsection