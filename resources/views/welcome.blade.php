@extends('layouts.frontend.app')

@section('breadcrumb')
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark mt-1" >
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">Welcome to Polbangtan Medan Repository</h1>
            <p class="lead my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mb-4" style="padding-left: 15px;padding-right: 15px;">
        <div class="col hand" style="height: 250px;background-color: green">
            <a href="{{url('/student-paper')}}">
                Student Paper
            </a>
        </div>
        <div class="col hand" style="height: 250px;background-color: gray">
            <a href="{{url('/journal')}}">
                Journal
            </a>
        </div>
        <div class="col hand" style="height: 250px;background-color: green">
            <a href="{{url('/peer-reviewer')}}">
                Peer Reviewer
            </a>
        </div>
        <div class="col hand" style="height: 250px;background-color: gray">
            <a href="{{url('/similarity')}}">
                Similarity
            </a>
        </div>
        <div class="col hand" style="height: 250px;background-color: green">
            <a href="{{url('/prosiding')}}">
                Prosiding
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header h4">
                    Recently Added
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 font-bold">Lorem ipsum dolor sit amet Lorem ipsum dolor sit</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet Lorem ipsum dolor dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action no-border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mt-0 mb-1 text-bold">Lorem ipsum dolor sit amet</h5>
                            <small class="font-italic">3 days ago</small>
                        </div>
                        <small>Nasution, Sri Mulyani; Sutatminingsih, Raras; Marhamah, Marhamah (Universitas Sumatera Utara, 2020)</small>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    </a>
                    <div class="text-center p-10 mt-4 mb-4" style="width: 100%">
                        <a href="" class="btn btn-outline-success text-center">View More ...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
