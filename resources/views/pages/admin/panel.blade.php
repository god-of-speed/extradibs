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
    ul li{
        list-style:none;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/admin_panel?filter=fresh">Fresh</a>
                <a class="dropdown-item" href="/admin_panel?filter=un-merged">Unpaid</a>
                <a class="dropdown-item" href="/admin_panel?filter=merged">Half</a>
                <a class="dropdown-item" href="/admin_panel?filter=success">Success</a>
            </div>
        </div>
        <ul class=" float-right">
            <li class="">
                <a class="" href="/admin_package"><i class="la la-pencil"></i> Packages</a>
            </li>
        </ul>
    </div>
    <div class="row">
        @foreach($arr as $a)
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <span class="float-left">
                            Name: {{$a['user']->username}}<br>
                            Potential: {{$a['user']->potential}}<br>
                            Package: {{$a['package']->name}}<br>
                            Phone no: {{$a['user']->phone}}<br>
                            Payers: {{$a['account']->payers}}<br>
                            Account name: {{$a['account']->accountName}}<br>
                            Date created: {{date('d-m-Y', strtotime($a['account']->created_at))}}<br>
                            Last update:  {{date('d-m-Y', strtotime($a['account']->updated_at))}}
                        </span>
                        <span class="float-right">
                            Bank name: {{$a['user']->bankName}}<br>
                            Account name: {{$a['user']->accountName}}<br>
                            Account no: {{$a['user']->accountNumber }}<br>
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    @if(!$a['account']->blocked)
                    @if(!Session::has('mergedTo'))
                    <a role="button" href="/merge_account?mergedTo={{$a['account']->id}}" class="btn btn-sm btn-primary">Select</a>
                    @else
                    <a role="button" href="/final_merge?merge={{$a['account']->id}}" class="btn btn-sm btn-primary">Merge</a>
                    @endif
                    <a role="button" id="block-account" href="/block_account?account={{$a['account']->id}}" class="btn btn-sm btn-danger">Block</a>
                    @else
                    <a role="button" id="unblock-account" href="/unblock_account?account={{$a['account']->id}}" class="btn btn-sm btn-primary">un-block</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if($p > 1)
                        <li class="page-item"><a class="page-link" href="/admin_panel?filter={{app('request')->input('filter')}}&p={{$p-1}}&s={{$s-50}}">Previous</a></li>
                    @endif
                    @for($i=0; $i<$pages; $i++)
                        @if($i+1 != $p)
                        <li class="page-item"><a class="page-link" href="/admin_panel?filter={{app('request')->input('filter')}}&p={{$i}}&s={{$i*50}}">$i+1</a></li>
                        @else
                        <li class="page-item">{{$i+1}}</li>
                        @endif
                    @endfor
                    @if($p == $pages && $p != 1)
                    <li class="page-item"><a class="page-link" href="/admin_panel?filter={{app('request')->input('filter')}}&p={{$p+1}}&s={{$s+50}}">Next</a></li>
                    @endif
              </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
@parent
<script>
    $(document).ready(function(){
        $('#block-account').on('click',function(e){
            e.preventDefault();
            var e1 = e.target;
            var loc = $(e1).attr('href');
            if(confirm('Are you sure you want to block this account?')) {
                window.location = loc;
            }
            e.stopPropagation();
        });

        $('#unblock-account').on('click',function(e){
            e.preventDefault();
            var e1 = e.target;
            var loc = $(e1).attr('href');
            if(confirm('Are you sure you want to un-block this account?')) {
                window.location = loc;
            }
            e.stopPropagation();
        });
    });
</script>
@endsection