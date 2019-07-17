@extends('home')
@section('title')
{{Auth::user()->username}}
@endsection
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/users.css">
<style>
    .col-10{
        margin:auto;
    }
    .personal{
        background-color:inherit;
    }
    .card {
        background-color: inherit;
        box-shadow: none;
    }
    ul{
        list-decoration:none;
    }
    ul li{
        list-style:none;
        display:inline;
        margin-right:10px;
    }
    li a{
        text-decoration:none;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class=" float-right">
            <li class="">
                <a class="" href="/edit_user"><i class="la la-pencil"></i> Edit</a>
            </li>
            <li class="">
                <a class="" href="/logout">
                    <i class="la la-power-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>
<div id="user-profile">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card profile-with-cover">
                @if(!Auth::user()->image)
                <div class="card-img-top img-fluid bg-cover height-300"
                    style="background: url('../../../app-assets/images/carousel/22.jpg') 50%;"></div>
                @else
                <div class="card-img-top img-fluid bg-cover height-300"
                    style="background: url('{{Auth::user()->image}}') 50%;"></div>
                @endif
                <div class="media profil-cover-details w-100">
                    <div class="media-left pl-2 pt-2">
                        <a href="#" class="profile-image">
                        @if(!Auth::user()->image)
                            <img src="../../../app-assets/images/portrait/small/avatar-s-8.png"
                                class="rounded-circle img-border height-100" alt="Card image">
                        @else
                            <img src="{{Auth::user()->image}}"
                                class="rounded-circle img-border height-100" alt="Card image">
                        @endif
                        </a>
                    </div>
                    <div class="media-body pt-3 px-2">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">{{Auth::user()->username}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card personal">
                        <h4 class="card-title" style="text-align:center;text-decoration:underline;">Personal Details</h4>
                        <div class="card-body">
                            <p class="card text">
                            Name: {{ucwords(Auth::user()->firstName)}} {{ucwords(Auth::user()->lastName)}}<br>
                            Phone no: {{Auth::user()->phone}}<br>
                            referral link: {{Auth::user()->ref}}<br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h4 class="card-title" style="text-align:center;text-decoration:underline;">Bank Details</h4>
                        <div class="card-body">
                            <p class="card text">
                            Bank name: {{ucwords(Auth::user()->bankName)}}<br>
                            Account name: {{ucwords(Auth::user()->accountName)}}<br>
                            Account no: {{Auth::user()->accountNumber}}<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <h4 class="card-title" style="text-align:center;text-decoration:underline;">Potential</h4>
                        <div class="card-body">
                            @if(Auth::user()->potential < 25)
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{Auth::user()->potential}}%" aria-valuenow="{{Auth::user()->potential}}" aria-valuemin="0" aria-valuemax="100">{{Auth::user()->potential}}%</div>
                            </div>
                            @elseif(Auth::user()->potential > 25 && Auth::user()->potential < 50)
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{Auth::user()->potential}}%" aria-valuenow="{{Auth::user()->potential}}" aria-valuemin="0" aria-valuemax="100">{{Auth::user()->potential}}%</div>
                            </div>
                            @elseif(Auth::user()->potential > 50 && Auth::user()->potential < 75)
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{Auth::user()->potential}}%" aria-valuenow="{{Auth::user()->potential}}" aria-valuemin="0" aria-valuemax="100">{{Auth::user()->potential}}%</div>
                            </div>
                            @elseif(Auth::user()->potential > 75)
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{Auth::user()->potential}}%" aria-valuenow="{{Auth::user()->potential}}" aria-valuemin="0" aria-valuemax="100">{{Auth::user()->potential}}%</div>
                            </div>
                            @else
                            No Potential recorded
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
@parent
@endsection