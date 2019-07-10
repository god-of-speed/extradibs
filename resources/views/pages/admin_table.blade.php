@extends('home')
@section('title')
Table
@endsection
@section('styles')
@parent
<style>
    .table-responsive{
        padding:10px;
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

    .card-title:after {
        margin: 20px auto 10px 0px;
    }
</style>
@endsection
@section('nav')
@parent
@endsection
@section('content')
<!-- `new` constructor table -->
<section id="constructor">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin Table</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-body">
                                            <fieldset class="form-group">
                                                <select class="form-control" id="basicSelect">
                                                    <option>fresh</option>
                                                    <option>un-merged</option>
                                                    <option>merged</option>
                                                    <option>success</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Potential</th>
                                    <th scope="col">Account name</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Updated date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
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
        $('#basicSelect').on('change',function(){
            getTableContent();
        });
        getTableContent();
    });
    
    function getTableContent() {
        $.ajax({
            method:'GET',
            url:'admin_table?filter='+$('#basicSelect').val(),
            success:function(data) {
                $('#table-body').append(
                    `<tr>
                          <th scope="row">3</th>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>`
                );
            }
        });
    }
</script>
@endsection