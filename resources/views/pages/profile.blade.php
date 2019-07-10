@extends('home')
@section('title')
Profile
@endsection
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/users.css">
<style>
    .col-10{
        margin:auto;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<div id="user-profile">
    <div class="row">
        <div class="col-10">
            <div class="card profile-with-cover">
                <div class="card-img-top img-fluid bg-cover height-300"
                    style="background: url('../../../app-assets/images/carousel/22.jpg') 50%;"></div>
                <div class="media profil-cover-details w-100">
                    <div class="media-left pl-2 pt-2">
                        <a href="#" class="profile-image">
                            <img src="../../../app-assets/images/portrait/small/avatar-s-8.png"
                                class="rounded-circle img-border height-100" alt="Card image">
                        </a>
                    </div>
                    <div class="media-body pt-3 px-2">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">Jose Diaz</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-light navbar-profile align-self-end">
                    <button class="navbar-toggler d-sm-none" type="button" data-toggle="collapse" aria-expanded="false"
                        aria-label="Toggle navigation"></button>
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="la la-briefcase"></i> Accounts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="la la-bell-o"></i> Notifications</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
@parent
@endsection