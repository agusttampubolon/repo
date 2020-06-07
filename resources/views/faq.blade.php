@extends('layouts.frontend.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1>FAQ</h1><hr/>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading p-1 mb-2" role="tab" id="heading0">
                <h5 class="panel-title">
                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
                        What is Polangtan Medan Repository?
                    </a>
                </h5>
            </div>
            <div id="collapse0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0">
                <div class="panel-body px-3 mb-4">
                    <p>With Solodev CMS, you and your visitors will benefit from a finely-tuned technology stack that drives the highest levels of site performance, speed and engagement - and contributes more to your bottom line. Our users fell in love with:</p>
                    <ul>
                        <li>Light speed deployment on the most secure and stable cloud infrastructure available on the market.</li>
                        <li>Scalability – pay for what you need today and add-on options as you grow.</li>
                        <li>All of the bells and whistles of other enterprise CMS options but without the design limitations - this CMS simply lets you realize your creative visions.</li>
                        <li>Amazing support backed by a team of Solodev pros – here when you need them.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading p-1 mb-2" role="tab" id="heading1">
                <h5 class="panel-title">
                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        How to create an account?
                    </a>
                </h5>
            </div>
            <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                <div class="panel-body px-3 mb-4">
                    <p>Building a website is extremely easy. With a working knowledge of HTML and CSS you will be able to have a site up and running in no time.</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading p-1 mb-2" role="tab" id="heading2">
                <h5 class="panel-title">
                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        Why i can't login?
                    </a>
                </h5>
            </div>
            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                <div class="panel-body px-3 mb-4">
                    <p>Using Amazon AWS technology which is an industry leader for reliability you will be able to experience an uptime in the vicinity of 99.95%.</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading p-1 mb-2" role="tab" id="heading3">
                <h5 class="panel-title">
                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        Can i download the files?
                    </a>
                </h5>
            </div>
            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                <div class="panel-body px-3 mb-4">
                    <p>Yes, Solodev CMS is built to handle the needs of any size company. With our Multi-Site Management, you will be able to easily manage all of your websites.</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading p-1 mb-2" role="tab" id="heading4">
                <h5 class="panel-title">
                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse3">
                        What does locked files mean?
                    </a>
                </h5>
            </div>
            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                <div class="panel-body px-3 mb-4">
                    <p>Yes, Solodev CMS is built to handle the needs of any size company. With our Multi-Site Management, you will be able to easily manage all of your websites.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

