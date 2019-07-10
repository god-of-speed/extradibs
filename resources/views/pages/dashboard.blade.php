@extends('home')
@section('title')
Dashboard
@endsection
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/project.css">
<style>
    h4 {
        text-align: left;
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

    .card-title:after {
        content: '';
        display: block;
        vertical-align: bottom;
        width: 50px;
        height: 2px;
        margin: 20px auto 10px 0px;
        background-color: #29ABE2;
    }

    .left:after {
        margin: 20px auto 10px 0px;
    }

    p {
        text-align: left;
    }

    .card {
        background-color: inherit;
        cursor: default;
    }

    .package .card {
        margin: 0px auto 20px auto;
    }

    .package img {
        height: 10vw;
    }

    .card-header {
        background-color: inherit;
    }
    .badge{
        color:#333;
        cursor:pointer;
        font-size: 14px;
    }
    .span-left{
        float:left;
    }
    .span-right{
        float:right;
    }
    .re-invest{
        cursor:pointer;
    }
    .close-account{
        cursor:pointer;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<section class="row">
    <div class="col-md-8">
        <div class="row loading-row">
            @foreach($accounts as $account)
            <div class="col-12">
                <div class="card account" id="{{$account->id}}">
                    <div class="card-head">
                        <div class="card-header">
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a class="re-invest" style="background-color:rgb(13, 32, 59);color:rgb(166, 166, 166);" id="invest{{$account->id}}">Re-invest</a></li>
                                    <li><a class="close-account" style="background-color: crimson;color:white;" id="close{{$account->id}}"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                            {{-- <div class="heading-elements">
                                <span class="re-invest" id="invest{{$account->id}}" class="badge badge-default">Re-invest</span>
                                <span class="close-account" id="close{{$account->id}}" class="badge badge-default">Close</span>
                            </div> --}}
                        </div>
                    </div>
                    <!-- project-info -->
                    <div id="project-info" class="card-body row">
                        <div class="project-info-count col-lg-4 col-md-12">
                            <div class="project-info-icon">
                                @if(!$account->blocked)
                                <h2>check</h2>
                                @else
                                <h2>blocked</h2>
                                @endif
                                <div class="project-info-sub-icon">
                                    <span class="la la-calendar-check-o"></span>
                                </div>
                            </div>
                            <div class="project-info-text pt-1">
                                <h5>Account</h5>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="card text-center bg-transparent">
                                <div class="card-content">
                                    <div class="card-body pt-3">
                                    <h4 class="card-title left">{{$account->accountName}}</h4>
                                        <p class="card-text">
                                            <span class="span-left">
                                                Status: <br>
                                                Counter: 
                                            </span>
                                            <span class="span-right">
                                                Date created: {{$account->created_at}}<br>
                                                Last update:  {{$account->updated_at}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="row match-height">
            @foreach($packages as $package)
        <div class="col-xl-12 col-md-12 col-sm-12 package" id="{{$package->id}}">
                <div class="card">
                    <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{$package->image}}"
                            alt="Card image cap">
                        <div class="card-body">
                        <h4 class="card-title">{{$package->name}}</h4>
                            <p class="card-text">
                                {{$package->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('javascripts')
@parent
<script>
    $(document).ready(function(){
        $('.account').on('click',function(e){
            var currentTarget = e.currentTarget;
            var account = $(currentTarget).attr('id');
            window.location = '/account?account='+account;
        });
        $('.close-account').on('click',function(e){
            e.preventDefault();
            if(confirm('Are you sure you want to carry out this action?')) {
                e.stopImmediatePropagation();
                var span = e.target;
                //get current target
                var currentTarget = e.currentTarget;
                var account = $(span).attr('id');
                account = account.slice(account.length-1);
                $.ajax({
                    method:'GET',
                    url:'/close?account='+account,
                    success:function(data) {
                        if(data.truthy) {
                            window.location.reload();
                        }
                    }
                });
            }else{
                e.stopImmediatePropagation();
            }
        });
        $('.re-invest').on('click',function(e){
            e.preventDefault();
            if(confirm('Are you sure you want to carry out this action?')) {
                e.stopImmediatePropagation();
                var span = e.target;
                //get current target
                var currentTarget = e.currentTarget;
                var account = $(span).attr('id');
                account = account.slice(account.length-1);
                $.ajax({
                    method:'GET',
                    url:'/re-invest?account='+account,
                    success:function(data) {
                        if(data.truthy) {
                            window.location.reload();
                        }
                    }
                });
            }else{
                e.stopImmediatePropagation();
            }
        });
        $('.package').on('click',function(e){
            e.preventDefault();
            //get package detail
            var div = e.currentTarget;
            var package = $(div).attr('id');
            if(confirm('Are you sure you want to create a new citizen account?')) {
                e.stopImmediatePropagation();
                $.ajax({
                    method:'GET',
                    url:'/new-account?package='+package,
                    success:function(data){
                        window.location.reload();
                    }
                });
            }else{
                e.stopImmediatePropagation();
            }
        });
    });
</script>
@endsection