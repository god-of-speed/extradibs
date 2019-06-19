@extends('home')
@section('title')
Home
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
        font-weight: 600 !important;
    }

    .left {
        text-align: left !important;
        font-size: 28px !important;
        line-height: 1em !important;
        color: #222 !important;
        font-weight: 600 !important;
    }

    .card-body p {
        text-align: center;
    }

    .card-header {
        text-align: center;
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
    }

    .card-header {
        background-color: #F4F5FA;
        border: 0;
    }

    .packages .card-header h4 {
        font-size: 25px;
        font-weight: bolder;
        font-style: normal;
        text-align: center;
    }

    .packages .card-header small {
        font-size: 15px;
        font-style: normal;
        text-align: center !important;
    }
</style>
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
                                <img src="app-assets/images/carousel/08.jpg" class="d-block w-100 caro"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="app-assets/images/carousel/03.jpg" class="d-block w-100 caro"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img src="app-assets/images/carousel/01.jpg" class="d-block w-100 caro"
                                    alt="Third slide">
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
                            <h4 class="card-title">Hello, Welcome to Name Business</h4>
                            <br><small>Awesome packages we offer exclusively only</small>
                        </div>
                        <div class="row match-height">
                            <div class="col-xl-2 col-md-12 col-sm-12"></div>
                            <div class="col-xl-3 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N2000</h4>
                                            <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum
                                                brownie pastry
                                                gummies jelly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N5000</h4>
                                            <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum
                                                brownie pastry
                                                gummies jelly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N10000</h4>
                                            <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum
                                                brownie pastry
                                                gummies jelly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="card text-center bg-transparent">
                <div class="card-content">
                    <img src="../../../app-assets/images/elements/01.png" alt="element 01" width="400"
                        class="float-left">
                    <div class="card-body pt-3 float-left">
                        <h4 class="card-title left">Who we are</h4>
                        <p class="card-text">Donut toffee candy brownie soufflé macaroon.</p>
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
                                    <div class="card-img-top img-fluid bg-cover height-200"
                                        style="background: url('../../../app-assets/images/carousel/18.jpg');"></div>
                                    <div class="card-profile-image">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                            class="rounded-circle img-border box-shadow-1" alt="Card image">
                                    </div>
                                    <div class="profile-card-with-cover-content text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">Linda Holland</h4>
                                            <h6 class="card-subtitle text-muted">description</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 col-12">
                                <div class="card profile-card-with-cover">
                                    <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                    <div class="card-img-top img-fluid bg-cover height-200"
                                        style="background: url('../../../app-assets/images/carousel/18.jpg');"></div>
                                    <div class="card-profile-image">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                            class="rounded-circle img-border box-shadow-1" alt="Card image">
                                    </div>
                                    <div class="profile-card-with-cover-content text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">Linda Holland</h4>
                                            <h6 class="card-subtitle text-muted">description</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 col-12">
                                <div class="card profile-card-with-cover">
                                    <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                    <div class="card-img-top img-fluid bg-cover height-200"
                                        style="background: url('../../../app-assets/images/carousel/18.jpg');"></div>
                                    <div class="card-profile-image">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                            class="rounded-circle img-border box-shadow-1" alt="Card image">
                                    </div>
                                    <div class="profile-card-with-cover-content text-center">
                                        <div class="card-body">
                                            <h4 class="card-title">Linda Holland</h4>
                                            <h6 class="card-subtitle text-muted">description</h6>
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
@endsection