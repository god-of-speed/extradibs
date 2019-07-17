@extends('home')
@section('title')
{{$account->accountName}}
@endsection
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="app-assets/css/pages/project.css">
<style>
    h4 {
        text-align: left;
        font-style: normal;
        font-size: 18px !important;
        line-height: 1em !important;
        color: #222 !important;
        font-weight: 600 !important;
    }

    #upload{
        display:none;
    }

    .left {
        text-align: left !important;
        font-size: 18px !important;
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
        box-shadow: none;
    }

    .card .reward {
        box-shadow: 0 !important;
    }

    .reward .card-content {
        box-shadow: 10 10 10 10em;
        border: 1px solid rgb(0, 0, 0, 0.06);
        border-radius: 10px;
        padding: 5px;
        margin: 0px 0px 0px 10px;
    }

    .reward .card-body {
        padding: 5px;
    }

    .card-header {
        background-color: inherit;
    }

    .package .card {
        width: 20vw;
        margin: 0px auto 20px auto;
    }

    .package img {
        width: 20vw;
        height: 10vw;
    }

    ul li {
        text-align: left;
    }

    .center {
        text-align: center;
    }

    .card-title.center:after {
        margin: auto;
    }

    .first-col{
        margin:auto;
    }
    
    .top p{
        line-height: 2em;
    }
    
    .top p span{
        font-weight: bold;
    }
    
    .top p .left-align{
        float:left;
    }
    .top p .right-align{
        float:right;
    }
    #photo{
        display:none;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<section class="row">
    <div class="col-md-10 first-col">
        <div class="card">
            <!-- project-info -->
            <div id="project-info" class="card-body row">
                <div class="project-info-count col-lg-4 col-md-12">
                    <div class="project-info-icon">
                        <h2>check</h2>
                        <div class="project-info-sub-icon">
                            <span class="la la-calendar-check-o"></span>
                        </div>
                    </div>
                    <div class="project-info-text pt-1">
                        <h5>Account</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card top text-center bg-transparent">
                        <div class="card-content">
                            <div class="card-body pt-3">
                                <p class="card-text">
                                    <span class="left-align">
                                        <span>Account Name:</span> {{$account->accountName}}<br>
                                        <span>No. of re-investments:</span> {{$account->numberOfInvestments}}<br>
                                        <span>No. of referrals:</span> {{$account->numberOfReferrals}}<br>
                                        <span>Referral link: <a href="/register?package={{$account->packageId}}&ref={{Auth::user()->ref}}">Referral link</a></span>
                                    </span>
                                    <span class="right-align">
                                            <span>Date created:</span> {{date('d-m-Y', strtotime($account->created_at))}}<br>
                                            <span>Closed:</span> {{$account->closed == true? 'true':'false'}}<br>
                                            <span>Blocked:</span> {{$account->blocked == true? 'true':'false'}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if($mergedTo != null)
                <div class="card  reward text-center bg-transparent">
                        <div class="card-header">
                            <h4 class="card-title left">Reward</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="card-text">
                                            <a href="#">{{$mergedTo['accountDetails']->accountName}}</a>
                                            <ul>
                                                <li>Bank name: {{$mergedTo['userDetails']->bankName}}</li>
                                                <li>Account name: {{$mergedTo['userDetails']->accountName}}</li>
                                                <li>Account no.: {{$mergedTo['userDetails']->accountNumber}}</li>
                                            </ul>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-10">
                                                @if($mergedTo['mergeDetails']->proofOfPayment != null)
                                                <img id="display" class="img-thumbnail" src="{{$mergedTo['mergeDetails']->proofOfPayment}}"
                                                    alt="proof">
                                                @else
                                                <img id="display" class="img-thumbnail" src="../../../app-assets/images/portrait/medium/avatar-m-1.png"
                                                    alt="proof">
                                                @endif
                                            </div>
                                            <div class="col-md-10">
                                            <form enctype="multipart/form-data" action="/upload_proof?account={{$account->id}}&merge={{$mergedTo['mergeDetails']->id}}" method="POST">
                                                    @csrf
                                                <input type="file" name="image" id="photo">
                                                <br><button class="btn btn-sm" id="select">Select</button><br><br>
                                                <button id="upload" class="btn btn-sm btn-success">Upload payment proof</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($totalMerges != null)
                    <div class="card text-center bg-transparent">
                        <div class="card-header">
                            <h4 class="card-title center">Rewarded By</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($totalMerges as $totalMerge)
                                    <div class="col-md-6" id="{{$totalMerge['merge']->id}}">
                                        <div class="card  reward text-center bg-transparent">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <a href="#">{{$totalMerge['accountDetails']->accountName}}</a><br>
                                                        Name: {{$totalMerge['userDetails']->firstName}} {{$totalMerge['userDetails']->lastName}}<br>
                                                        Phone No.: {{$totalMerge['userDetails']->phone}}<br>
                                                        Payment proof: {{$totalMerge['merge']->proofOfPayment == null ? 'null' : 'uploaded'}}<br><br>
                                                        <button id="confirm" merge="{{$totalMerge['merge']->id}}" class="btn btn-sm btn-success">Confirm</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8"></div>
</section>
@endsection
@section('javascripts')
@parent
<script>
    $(document).ready(function(){
        $('#select').on('click',function(e){
            e.preventDefault();
            $('#photo').click();
        });
        $('#photo').on('change',function(e){
            e.preventDefault();
            //display image
            var reader = new FileReader();
            reader.onload = function(event) {
                $('#display').attr('src',event.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
            $('#upload').css('display','block');
        });
        //confirm payment
        $('#confirm').on('click',function(e){
            e.preventDefault();
            var confirmBtn = e.target;
            if(confirm('Are you sure you want to confirm payment?')) {
                $.ajax({
                    method:'GET',
                    url:'/confirm_payment?merge='+$(confirmBtn).attr('merge'),
                    success:function(data){
                        if(data.truthy) {
                            window.location.reload();
                        }
                        window.location.reload();
                    }
                });
            }
            e.stopImmediatePropagation();
        });
    });
</script>
@endsection