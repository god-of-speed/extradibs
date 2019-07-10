@extends('home')
@section('title')
ExtraDibs
@endsection
@section('styles')
@parent
<style>
    .caro {
        height: 45vw;
    }

    h4 {
        text-align: center;
        font-style: normal;
        font-size: 28px !important;
        line-height: 1em !important;
        color: #222 !important;
    }

    .left {
        text-align: left !important;
        font-size: 28px !important;
        line-height: 1em !important;
        color: #222 !important;
    }

    .card-body p {
        text-align: center;
    }

    .card-header {
        text-align: center;
    }

    .card {
        box-shadow: none;
        background-color: inherit;
    }

    .card-title:after {
        content: '';
        display: block;
        vertical-align: bottom;
        width: 50px;
        height: 2px;
        margin: 20px auto 10px auto;
        background-color: #29ABE2;
    }

    .left:after {
        margin: 20px auto 10px 0px;
    }

    .packages {
        background-color: transparent;
        border: 0;
        margin-top: 0;
        padding: 5px 40px 5px 0px;
        cursor:default;
        
    }

    .card-header {
        background-color: #F4F5FA;
        border: 0;
    }

    .packages .card-header h4 {
        font-size: 25px;
        font-style: italic !important;
        text-align: center;
        font-family: 'Playfair Display', serif;
    }

    .packages .card-header small {
        font-size: 15px;
        font-style: normal;
        text-align: center !important;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<section id="content-types">
    <div class="row match-height">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-content">
                    <div id="carousel-example" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="images/app/1.png" class="d-block w-100 caro" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="images/app/2.png" class="d-block w-100 caro" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img src="images/app/3.png" class="d-block w-100 caro" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                            <span class="la la-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                            <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row first-row">
        <div class="col-md-12 col-sm-12 fir-col">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 first-col">
                    <div class="card packages">
                        <div class="card-header">
                            <h4 class="card-title text-bold-400">Hello, Welcome to Extra Dibs</h4>
                            <br><small>Awesome packages we offer exclusively only</small>
                        </div>
                        <div class="row match-height">
                            @for($i=0; $i<count($packages);$i++) 
                        <div class="col-xl-4 col-md-12 col-sm-12 package" id="{{$packages[$i]->id}}">
                                <div class="card">
                                    <div class="card-content">
                                    <img class="card-img-top img-fluid" src="{{ $packages[$i]->image }}"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title" style="font-family: 'Source Sans Pro', sans-serif;font-style:italic;">{{ $packages[$i]->name }}</h4>
                                            <p class="card-text">
                                                {{ $packages[$i]->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="card text-center bg-transparent">
            <div class="card-content">
                <img src="images/app/who_we_are.png" alt="element 01" width="400" class="float-left">
                <div class="card-body pt-3 float-left">
                    <h4 class="card-title left">Who we are</h4>
                    <p class="card-text" style="text-align: left;">
                        There are about 86.9 million people living in poverty <br>here in Nigeria which represents 50% of the country's
                        population.<br> We have a unique opportunity to work with participants <br>to make sustainable living commonplace.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="card text-center bg-transparent">
            <div class="card-content">
                <h4 class="card-title">Testimonials</h4>
                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col-xl-4 col-md-12 col-12">
                            <div class="card profile-card-with-cover">
                                <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                <div class="card-img-top img-fluid bg-cover height-150"
                                    style="background: url('../../../app-assets/images/portrait/testy/selfie1.jpg');"></div>
                                <div class="card-profile-image">
                                    <img src='../../../app-assets/images/portrait/testy/selfie1.jpg'
                                        class="rounded-circle img-border box-shadow-1" style="height:60px;" alt="Card image">
                                </div>
                                <div class="profile-card-with-cover-content text-center">
                                    <div class="card-body">
                                        <h4 class="card-title">Chinyere Nwankwo</h4>
                                        <h6 class="card-subtitle text-muted">
                                            Thank you very much! for the support
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12 col-12">
                            <div class="card profile-card-with-cover">
                                <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                <div class="card-img-top img-fluid bg-cover height-150"
                                    style="background: url('../../../app-assets/images/portrait/testy/selfie2.jpg');"></div>
                                <div class="card-profile-image">
                                    <img src='../../../app-assets/images/portrait/testy/selfie2.jpg'
                                        class="rounded-circle img-border box-shadow-1" style="height:60px;" alt="Card image">
                                </div>
                                <div class="profile-card-with-cover-content text-center">
                                    <div class="card-body">
                                        <h4 class="card-title">Gabriel Young</h4>
                                        <h6 class="card-subtitle text-muted">
                                            I didn't believe it until i was rewarded.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12 col-12">
                            <div class="card profile-card-with-cover">
                                <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                <div class="card-img-top img-fluid bg-cover height-150"
                                    style="background: url('../../../app-assets/images/portrait/testy/selfie3.jpg');"></div>
                                <div class="card-profile-image">
                                    <img src='../../../app-assets/images/portrait/testy/selfie3.jpg'
                                        class="rounded-circle img-border box-shadow-1" style="height:60px;" alt="Card image">
                                </div>
                                <div class="profile-card-with-cover-content text-center">
                                    <div class="card-body">
                                        <h4 class="card-title">Stella Irebo</h4>
                                        <h6 class="card-subtitle text-muted">
                                            Honestly this is actually cool.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@section('javascripts')
@parent
<script>
    $(document).ready(function(){
        $('.package').on('click',function(e){
            var e1 = e.currentTarget;
            var id = $(e1).attr('id');
            window.location = 'package?package=' + id;
        });
    });
</script>
@endsection