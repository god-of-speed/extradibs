@extends('home')
@section('title')
Package
@endsection
@section('styles')
@parent
<style>
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
@section('nav')
@parent
@endsection
@section('content')
<section>
    <div class="row match-height">
        <div class="col-md-8 col-sm-12 fir-col">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 first-col">
                    <div class="card packages">
                        <div class="row match-height">
                            <div class="col-xl-4 col-md-12 col-sm-12 package">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N</h4>
                                            <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum
                                                brownie pastry
                                                gummies jelly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 col-sm-12 package">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N</h4>
                                            <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum
                                                brownie pastry
                                                gummies jelly.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 col-sm-12 package">
                                <div class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="app-assets/images/carousel/06.jpg"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">N</h4>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Create Package</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" id="price" class="form-control" placeholder="000000" name="price">
                                </div>
                                <div class="form-group">
                                    <label>Select File</label>
                                    <label id="image" class="file center-block">
                                        <input type="file" id="file">
                                        <span class="file-custom"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" rows="5" class="form-control" name="description"
                                        placeholder="description"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
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