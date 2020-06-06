<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/1d73c63128.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .feather {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 1;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
        }
        small>.feather{
            width: 16px;
            height: 16px;
            vertical-align: middle;

        }
        .list-group-item{
            border:0;
        }
        .hand:hover{
            cursor: pointer;
        }
        .hide{
            display: none;
        }
        .show{
            display: block;
        }
        .p-title{
            width: 400px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>


<div style="position:relative;height: 34px;width: 100%;display: block;background-color: darkslategrey;padding:2px;color:#fafafa;line-height: 26px;text-indent: 15px;">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-6">
                <small style="font-size: 12px">POLBANGTAN MEDAN REPOSITORY</small>
            </div>
            <div class="col-md-6">
                <div style="text-align: right;top:3px;font-size: 10pt;color:#fff;padding-right: 15px;">
                    <a class="text-light" href="{{ route('login') }}">Contact Us</a> |
                    <a class="text-light" href="{{ route('login') }}">FAQ</a> |
                    @guest
                        <a class="text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            | <a class="text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        hi {{ Auth::user()->name }} ,
                        <a class="text-light" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light pt-4 pb-4">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('/images/logo.png')}}" width="100%" class="d-inline-block align-top" alt="" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form id="form_search" class="form-inline my-2 my-lg-0" action="{{url('/all?')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" style="width: 450px;" name="keyword" placeholder="Search by Title, Abstract, Author and Subject">
                <div class="input-group-btn">
                    <button class="btn btn-search" type="submit">
                        <i data-feather="search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top mb-2" style="background-color: #f1efef!important;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/article')}}">ARTICLE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/guide-book')}}">GUIDE BOOK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/book')}}">BOOK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/monograph')}}">MONOGRAPH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/student-paper')}}">STUDENT PAPER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/archive')}}">ARCHIVE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/others')}}">OTHERS</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div class="container mt-4">
    <div style="position: relative;">
        @yield('breadcrumb')
    </div>
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>

<footer class="page-footer font-small bg-dark pt-5 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="title text-light text-uppercase mb-2">Contact Us</div>
                <div>
                    <p style="color: #d6d6d6;font-size: 13px">Politeknik Pembangunan Pertanian Medan (POLBANGTAN MEDAN)</p>
                    <p class="mb-0 subtitle"><i data-feather="map-pin"></i> ADDRESS</p>
                    <p class="subtitle-info">Jl. Binjai KM.10 Tromol Pos 18 Medan 20002 Sumut</p>
                    <p class="mb-0 subtitle"><i data-feather="phone"></i> PHONE</p>
                    <p class="mb-0 subtitle-info">(061) 8451544</p>
                    <p class="subtitle-info">(061) 8446669</p>
                    <p class="mb-0 subtitle"><i data-feather="mail"></i> EMAIL</p>
                    <p class="mb-0 subtitle-info">info@polbangtanmedan.ac.id</p>
                    <p class="mb-0 subtitle-info">polbangtanmedan@gmail.com</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="title text-light text-uppercase mb-2">Categories</div>
                <ul class="list-unstyled">
                    <li><a href="{{url('/article')}}">Article</a> </li>
                    <li><a href="{{url('/guide-book')}}">Guide Book</a> </li>
                    <li><a href="{{url('/book')}}">Book</a> </li>
                    <li><a href="{{url('/monograph')}}">Monograph</a> </li>
                    <li><a href="{{url('/student-paper')}}">Student Paper</a> </li>
                    <li><a href="{{url('/archive')}}">Archive</a> </li>
                    <li><a href="{{url('/others')}}">Others</a> </li>
                </ul>
            </div>
            <div class="col-md-2">
                <div class="title text-light text-uppercase mb-2">Links</div>
                <ul class="list-unstyled">
                    <li><a href="url('')">About</a> </li>
                    <li><a href="url('')">FAQ</a> </li>
                    <li><a href="url('')">Contact Us</a> </li>
                </ul>
            </div>
            <div class="col-md-2">
                <div class="title text-light text-uppercase mb-2">Social Media</div>
                <ul class="list-inline social">
                    <li><a href="https://www.facebook.com/polbangtanmedan/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/polbangtanmedan" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/polbangtanmedan/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCwDAiQ-qdWvdqDdWLnAE1lA" target="_blank"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright text-center text-white py-3 mt-2">© {{date('yy')}} Copyright:
            <a class="text-light" href="https://polbangtanmedan.ac.id/"> polbangtanmedan.ac.id</a>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@yield('js')
<script>
    feather.replace({ class: 'foo bar', 'stroke-width': 0.5 })

    $(document).ready(function() {
        $("#filter_data").change(function () {
            if($(this).val()==="issue_date" || $(this).val() === "submitted_date"){
                $("#year").removeClass("hide");
                $("#keyword").addClass("hide");
                $("#first_char").addClass("hide");
            }else{
                $("#year").addClass("hide");
                $("#keyword").removeClass("hide");
                $("#first_char").removeClass("hide");
            }
        });

        $("#form_search").submit(function (e) {
            if($("input[name='keyword']").val() === ''){
                e.preventDefault(e);
                return false;
            }
        })
    });
</script>
</body>
</html>
