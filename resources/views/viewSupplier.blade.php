@extends('layouts.app')

@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Welcome !</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Inventory</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
                <!-- Basic example -->
                <div class="col-md-2"></div>
                <div class="col-md-8 offset-2">
                    <div class="panel panel-primary ">
                        <div class="panel-heading "><h3 class="panel-title ">View Supplier</h3></div>
                        <div class="panel-body">
                           
                                <div class="form-group">
                                    <label>Name</label>
                                    <p>{{$single->name}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <p>{{$single->email}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <p>{{$single->phone}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <p>{{$single->address}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Shop Name</label>
                                    <p>{{$single->shop}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Account Holder</label>
                                    <p>{{$single->accountholder}}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <p>{{$single->accountnumber}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <p>{{$single->bankname}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Branch</label>
                                    <p>{{$single->bankbranch}}</p>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <p>{{$single->city}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <p>{{$single->type}}</p>
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#"/>
                                    <label>Photo</label>
                                    <img src="{{URL::to($single->photo)}}" style="height: 60px; width: 60px;" alt="">
                                </div>
                              
                               
                           
                        </div><!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col-->
              

            </div> <!-- End row -->
            <!-- End row-->


           
        </div> <!-- container -->
                   
    </div> <!-- content -->

    <footer class="footer text-right">
        2015 © Moltran.
    </footer>



    
    
</div>


@endsection