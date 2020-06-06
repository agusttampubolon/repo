@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/student-paper')}}">Student Paper</a></li>
            <li class="breadcrumb-item p-title active" aria-current="page">Lorem ipsum dolor sit amet Lorem ipsum dolor sit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>Student Paper</h1><hr/>
    <div class="card p-3">
        <h3>Lorem ipsum dolor sit amet Lorem ipsum dolor sit</h3>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="{{url("/images/banner_default.jpg")}}" width="100%" alt="Card image cap">
                    <ul class="list-group">
                        <li class="list-group-item">View/Open
                            <ul class="list mb-2 mt-2" style="padding-inline-start: 20px;">
                                <li><a href=""><i data-feather="download" class="mr-2"></i>Cover</a></li>
                                <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 1</a></li>
                                <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 2</a></li>
                                <li><a href=""><i data-feather="download" class="mr-2"></i>Chapter 3</a></li>
                                <li><a href=""><i data-feather="lock" class="mr-2"></i>Chapter 4</a></li>
                                <li><a href=""><i data-feather="lock" class="mr-2"></i>Chapter 5</a></li>
                                <li><a href=""><i data-feather="lock" class="mr-2"></i>Reference</a></li>
                                <li><a href=""><i data-feather="lock" class="mr-2"></i>Appendix</a></li>
                            </ul>
                            <small class="mt-2">Please login to open unlocked file</small>
                        </li>
                        <li class="list-group-item">Date <br/> 2020-09-02</li>
                        <li class="list-group-item">Author <br/> Tampubolon, Agust Erwinson</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <p class="h5">Abstract</p>
                <p>
                    Standard Operational Procedure is a set of instructions or steps of activities which is estabilished to meet the need of a certain client who intends to direct the nursing care activities for an efficient and effective goal that is consistent and safe in the framework of improving the quality of service through meeting the existing standard. The carelessness of nurses and their less knowledge and attitude in the application of SOP of injecting technique can endanger the nurse and patient. The ratio of HIV transmission opportunity resulted from the accident of injection is low, 3 :1000, meaning, only 3 cases of HIV transmission are found in the1000 cases of the accident of injection. At Arifin Achmad General Hospital Pekanbaru in 2006 and 2007 occurred and occupational accident involving 4 (four) nurses and 1 (one) medical student who had physical contact with the neddles used to give an injection and to infuse the HIV/AIDS patient. Since they did not wear their gloves when they were working, this condition made them worried. This observational study with cross sectional design is intended to examine the relationship between the nurses knowledge and attitude in applying the SOP of injecting technique to prevent injection at Arifin Achmad General Hospital Pekanbaru. The population for this study is 153 persons and 60 of them were selected to be the samples.The data obtained were analyzed through univariate, bivariate (using Chi-square test), and multivariate (using double regression test) analysis. The result of this study shows that 91,7% of the nurses working for Arifin Achmad General Hospital Pekanbaru applied the SOP of injection technique. The result of Chi-square test shows that there is a significant relationship between nurses knowledge in the application the SOP of injecting technique ( P=0,025) and is not significant relationship between nurses attitude in the application the SOP of injecting technique (P=0,403). In is suggested that there be a strict commitment in the application of SOP as an attempt to prevent injection, to develop the nurse knowledge through technical education and training departemen of safety work and to conduct further study on the application of the SOP of nursing at the other hospitals and including the other variables related to SOP.
                </p>
            </div>
        </div>
    </div>
@endsection
