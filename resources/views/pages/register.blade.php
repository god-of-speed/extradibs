@extends('home')
@section('title')
{{ $package->name }} Package
@endsection
@section('styles')
@parent
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
    .card{
        box-shadow:none;
        background-color: inherit;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<section id="content-types">
    <div class="col-md-12 col-sm-12">
        <div class="card text-center bg-transparent">
            <div class="card-content">
            <img src="{{ $package->image}}" alt="element 01" width="400" class="float-left">
                <div class="card-body pt-3 float-left">
                <h4 class="card-title left">{{$package->name}}</h4>
                <p class="card-text">{{$package->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                    <form class="form" method="POST" action="{{$action}}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstName">First Name</label>
                                                    <input type="text" id="firstName" class="form-control"
                                                        placeholder="first Name" name="firstName">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName">Last Name</label>
                                                    <input type="text" id="lastName" class="form-control"
                                                        placeholder="last Name" name="lastName">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" class="form-control"
                                                        placeholder="username" name="username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" class="form-control"
                                                        placeholder="password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Contact No.</label>
                                                    <input type="text" id="phone" class="form-control"
                                                        placeholder="phone" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Referred By</label>
                                                    <input type="text" id="ref" class="form-control" 
                                                            placeholder="ref" name="ref" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="form-section"><i class="la la-paperclip"></i> Bank
                                            Details
                                        </h4>
                                        <div class="form-group">
                                            <label for="bankName">Bank Name</label>
                                            <input type="text" id="bankName" class="form-control"
                                                placeholder="Bank Name" name="bankName">
                                        </div>
                                        <div class="form-group">
                                            <label for="accountName">Account Name</label>
                                            <input type="text" id="accountName" class="form-control"
                                                placeholder="Account Name" name="accountName">
                                        </div>
                                        <div class="form-group">
                                            <label for="accountNumber">Account Number</label>
                                            <input type="text" id="accountNumber" class="form-control"
                                                placeholder="XXXX-XXXX-XXXX-XXXX" name="accountNumber">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                <input type="checkbox" id="checkTerms" style="margin-right:5px;" class="float-left">
                                <a href="/terms" class="float-left" style="text-decoration:underline;color:red;">I agree to the terms and <br>conditions of this platform.</a><br>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                <button type="submit" id="save" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                                </div>
                            </div>
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
<script>
    $(document).ready(function(){
        //get refferal link
        //get url
        var url = window.location.href;
        //get referral link
        var ref = '';
        if(url.indexOf('&') !== -1) {
            //get position of amber
            var pos = url.indexOf('&');
            //get referral link
            ref = url.slice(pos + 5);
        }
        //on load
        $('#ref').val(ref);
        $('#save').on('click',function(e){
            if(!$('#checkTerms').prop('checked')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection