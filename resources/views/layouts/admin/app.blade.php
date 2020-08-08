<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Login') }}</title>

    <title>Dashboard - Polbangtan Medan Repository</title>
    <link href="{{url('css/admin/styles.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <link href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
    {{--<link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css"/>--}}
    {{--<link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />--}}
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand d-none d-sm-block pl-0" href="{{url('/admin')}}">
        <img class="align-middle" src="{{url('images/logopolbangtan.png')}}"/> Admin Repository
    </a>
    <button class="btn sb-btn-icon sb-btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href=""><i data-feather="menu"></i></button>
    <form class="form-inline mr-auto d-none d-lg-block">
        {{--<input class="form-control sb-form-control-solid mr-sm-2" type="search" placeholder="Search" aria-label="Search" />--}}
    </form>
    <form class="form-inline ml-auto mr-3">
        <a class="btn btn-outline-success btn-sm" href="https://docs.google.com/document/d/11kVTfQUHZYFgizWYlVKnmKk1G0szEUrHqmB9_n1Pxlk/edit?usp=sharing" target="_blank">
            <div class="d-none d-sm-inline-flex align-items-center"><i class="mr-1" data-feather="book"></i>Documentation</div>
            <div class="d-inline d-sm-none">Docs</div>
        </a>
    </form>
    <ul class="navbar-nav align-items-center">

        <li class="nav-item dropdown no-caret mr-3 sb-dropdown-user">
            <a class="btn sb-btn-icon sb-btn-transparent-dark dropdown-toggle p-0" id="navbarDropdownUserImage" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{url('/images/user.png')}}"/></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="sb-dropdown-user-img" src="{{url('/images/user.png')}}" />
                    <div class="sb-dropdown-user-details">
                        <div class="sb-dropdown-user-details-name">{{Auth::user()->name}}</div>
                        <div class="sb-dropdown-user-details-email">{{Auth::user()->email}}</div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" onclick="myAccount()">
                    <div class="sb-dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item" href="javascript:void(0);">
                    <div class="sb-dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav sb-shadow-right sb-sidenav-light">
            <div class="sb-sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" target="_blank" href="{{url('/')}}"><div class="sb-nav-link-icon"><i data-feather="activity"></i></div>
                        View Website</a>
                    <div class="sb-sidenav-menu-heading">Communities</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticle" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Article
                        <span class="{{Helper::get_article_header_count() == "0" ? '' : 'badge badge-success ml-2'}}">{{Helper::get_article_header_count() == "0" ? "" : Helper::get_article_header_count() }}</span>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/article/*') ? 'show' : ' ' }}" id="collapseArticle" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/article/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/article/publish')}}">Publish</a>
                            <a class="nav-link" href="{{url('/admin/article/unpublish')}}">Unpublish</a>
                            <a class="nav-link" href="{{url('/admin/article/rejected')}}">Rejected</a>
                            <a class="nav-link" href="{{url('/admin/article/revision')}}">Revised
                                <span class="badge badge-success ml-2">{{Helper::get_article_revision_count()}}</span>
                            </a>
                            <a class="nav-link" href="{{url('/admin/article/pending')}}">Need For Approval
                                <span class="badge badge-success ml-2">{{Helper::get_article_pending_count()}}</span>
                            </a>
                            <a class="nav-link" href="{{url('/admin/article/user')}}">User</a>
                            <a class="nav-link" href="{{url('/admin/article/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGuideBook" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Guide Book
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/guide-book/*') ? 'show' : ' ' }}" id="collapseGuideBook" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/guide-book/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/guide-book/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBook" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Book
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/book/*') ? 'show' : ' ' }}" id="collapseBook" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/book/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/book/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonograph" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Monograph
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/monograph/*') ? 'show' : ' ' }}" id="collapseMonograph" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/monograph/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/monograph/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudentPaper" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Student Paper
                        <span class="{{Helper::get_paper_header_count() == "0" ? '' : 'badge badge-success ml-2'}}">{{Helper::get_paper_header_count() == "0" ? "" : Helper::get_paper_header_count() }}</span>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/student-paper/*') ? 'show' : ' ' }}" id="collapseStudentPaper" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/student-paper/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/student-paper/rejected')}}">Rejected</a>
                            <a class="nav-link" href="{{url('/admin/student-paper/revision')}}">Revised
                                <span class="badge badge-success ml-2">{{Helper::get_paper_revision_count()}}</span>
                            </a>
                            <a class="nav-link" href="{{url('/admin/student-paper/pending')}}">Need For Approval
                                <span class="badge badge-success ml-2">{{Helper::get_paper_pending_count()}}</span>
                            </a>
                            <a class="nav-link" href="{{url('/admin/student-paper/user')}}">User</a>
                            <a class="nav-link" href="{{url('/admin/student-paper/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArchive" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Archive
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/archive/*') ? 'show' : ' ' }}" id="collapseArchive" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/archive/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/archive/publish')}}">Publish</a>
                            <a class="nav-link" href="{{url('/admin/archive/unpublish')}}">Unpublish</a>
                            <a class="nav-link" href="{{url('/admin/archive/add')}}">New</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOthers" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
                        Others
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/others/*') ? 'show' : ' ' }}" id="collapseOthers" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/others/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/others/publish')}}">Publish</a>
                            <a class="nav-link" href="{{url('/admin/others/unpublish')}}">Unpublish</a>
                            <a class="nav-link" href="{{url('/admin/others/add')}}">New</a>
                        </nav>
                    </div>

                    <div class="sb-sidenav-menu-heading">Users Management</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                        <div class="sb-nav-link-icon"><i data-feather="users"></i></div>
                        Users
                        <span class="{{Helper::get_user_pending_count() == "0" ? '' : 'badge badge-success ml-2'}}">{{Helper::get_user_pending_count() == "0" ? "" : Helper::get_user_pending_count() }}</span>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ request()->is('admin/user/*') ? 'show' : ' ' }}" id="collapseUser" data-parent="#accordionSidenav">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="{{url('/admin/user/all')}}">All</a>
                            <a class="nav-link" href="{{url('/admin/user/rejected')}}">Rejected</a>
                            <a class="nav-link" href="{{url('/admin/user/pending')}}">Need For Approval
                                <span class="badge badge-success ml-2">{{Helper::get_user_pending_count()}}</span>
                            </a>
                            <a class="nav-link" href="{{url('/admin/user/new')}}">New User Admin</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Configuration</div>
                    <a class="nav-link" target="_blank" href="{{url('/clear')}}"><div class="sb-nav-link-icon"><i data-feather="settings"></i></div>
                        Clear Cache</a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div>
                    <div class="small">Logged in as:</div>
                    {{Auth::user()->name}}
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield('content')
            @include("admin.user._my_account")
            @include("admin.user._password")
        </main>
        <footer class="sb-footer py-4 mt-auto sb-footer-light">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div>Copyright &copy; Polbangtan Medan {{date('yy')}}</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{url('/js/admin/scripts.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
{{--<script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    function myAccount() {
        $("#modal_my_account").modal('show');
    }
    function change_password(email) {
        $("#hdn_email_password").val(email);
        $("#modal_my_account").modal('hide');
        $("#modal_change_password").modal("show");
    };
    function change_account() {
        Swal.fire({
            title: "Confirmation",
            text: "Are you sure change the data?",
            buttons: true,
            dangerMode: true,
        })
            .then((value) => {
                if (value) {
                    Swal.fire({
                        text: "please wait ...",
                        button: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });
                    var btn = $("#btn_save");

                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url:"/admin/user/update-account",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: $("#form_account").serialize(),
                        success:function(response)
                        {
                            var text = '';
                            var res = JSON.parse(response);
                            if(res.status === 'true') {
                                Swal.fire({
                                    text:"Success! The data has been approved!",
                                    icon: "success",
                                });
                                location.reload();
                            }else{
                                Swal.fire({
                                    text:"Error! Something went wrong!",
                                    icon: "success",
                                });
                                btn.removeAttr("disabled");
                            }
                        }
                    })
                }
            });
    }
</script>
@yield('js')
</body>
</html>
