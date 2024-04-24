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
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">View Product <a href="{{route('all.product')}}" class="btn btn-sm btn-danger pull-right">All Product</a></h3></div>
                        <div class="panel-body">
                                <div class="form-group">
                                    {{-- <img id="image" src="#"/> --}}
                                    <label>Product Image</label><br>
                                    <img src="{{URL::to($product->product_image)}}" style="height: 90px; width: 90px;" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <p>{{$product->product_name}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <p>{{$product->product_code}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <p>{{$product->cat_name}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <p>{{$product->name}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Garage</label>
                                    <p>{{$product->product_garage}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Buy Date</label>
                                    <p>{{$product->buy_date}}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Expire Date</label>
                                    <p>{{$product->expire_date}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Buying Price</label>
                                    <p>{{$product->buying_price}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Selling price</label>
                                    <p>{{$product->selling_price}}</p>
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