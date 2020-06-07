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
    <h1>Contact Us</h1><hr/>
    <div class="pl-1">
        <p style="">Politeknik Pembangunan Pertanian Medan (POLBANGTAN MEDAN)</p>
        <p class="mb-0 subtitle"><i data-feather="map-pin"></i> ADDRESS</p>
        <p class="subtitle-info">Jl. Binjai KM.10 Tromol Pos 18 Medan 20002 Sumut</p>
        <p class="mb-0 subtitle"><i data-feather="phone"></i> PHONE</p>
        <p class="mb-0 subtitle-info">(061) 8451544</p>
        <p class="subtitle-info">(061) 8446669</p>
        <p class="mb-0 subtitle"><i data-feather="mail"></i> EMAIL</p>
        <p class="mb-0 subtitle-info">info@polbangtanmedan.ac.id</p>
        <p class="mb-0 subtitle-info">polbangtanmedan@gmail.com</p>
    </div>
@endsection
