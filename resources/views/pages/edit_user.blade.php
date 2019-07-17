@extends('home')
@section('title')
{{Auth::user()->username}}
@endsection
@section('styles')
@parent
<style>
    #photo{
        display:none;
    }
    #upload{
        display:none;
    }
    .card {
        background-color: inherit;
        box-shadow: none;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<div class="row match-height">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-10">
                @if(Auth::user()->image != null)
                <img id="display" class="img-thumbnail" src="{{Auth::user()->image}}"
                    alt="profile picture">
                @else
                <img id="display" class="img-thumbnail" src="../../../app-assets/images/portrait/medium/avatar-m-1.png"
                    alt="profile picture">
                @endif
            </div>
            <div class="col-md-10">
                <form enctype="multipart/form-data" action="/upload_user_photo" method="POST">
                    @csrf
                    <input type="file" name="image" id="photo">
                    <br><button class="btn btn-sm" id="select">Select</button><br><br>
                    <button id="upload" class="btn btn-sm btn-success">Upload picture</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <form class="form" method="POST" action="/edit_user">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" class="form-control"
                                        value="{{Auth::user()->firstName}}" placeholder="first Name" name="firstName">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" class="form-control"
                                    value="{{Auth::user()->lastName}}" placeholder="last Name" name="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Contact No.</label>
                                    <input type="text" id="phone" class="form-control"
                                    value="{{Auth::user()->phone}}" placeholder="phone" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h4 class="form-section"><i class="la la-paperclip"></i> Bank
                            Details
                        </h4>
                        <div class="form-group">
                            <label for="bankName">Bank Name</label>
                            <input type="text" id="bankName" class="form-control"
                            value="{{Auth::user()->bankName}}" placeholder="Bank Name" name="bankName">
                        </div>
                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" id="accountName" class="form-control"
                            value="{{Auth::user()->accountName}}" placeholder="Account Name" name="accountName">
                        </div>
                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" id="accountNumber" class="form-control"
                            value="{{Auth::user()->accountNumber}}" placeholder="XXXX-XXXX-XXXX-XXXX" name="accountNumber">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="save" class="btn btn-primary float-right">
                    <i class="la la-check-square-o"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
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
    });
</script>
@endsection