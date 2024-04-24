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
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Add Product  <a href="{{route('all.product')}}" class="btn btn-sm btn-danger pull-right">All Product</a></h3></div>
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form rule="form" method="post" action="{{ url('/insert-product') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control"  name="product_name" placeholder="Product Name" >
                                </div>
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" class="form-control"  name="product_code" placeholder="Product Code" >
                                </div>
                                <div class="form-group">
                                    <label >Category</label>
                                    @php
                                        $cat = DB::table('categories')->get();
                                    @endphp
                                    <select class="form-control" name="cat_id" id="">
                                        <option disabled="" selected>Select Category Name</option>
                                        @foreach ($cat as $row)
                                        <option value="{{$row->id}}">{{$row->cat_name}}</option>
                                        @endforeach
                                       
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Supplier Name</label>
                                    @php
                                        $sup = DB::table('suppliers')->get();
                                    @endphp
                                    <select class="form-control" name="sup_id" id="">
                                        <option disabled="" selected>Select Supplier Name</option>
                                        @foreach ($sup as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                       
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Godown Name</label>
                                    <input type="text" class="form-control" name="product_garage" placeholder="Godown Name">
                                </div>
                                <div class="form-group">
                                    <label>Product Route</label>
                                    <input type="text" class="form-control" name="product_route" placeholder="Product Route">
                                </div>
                                <div class="form-group">
                                    <label>Buy Date</label>
                                    <input type="date" class="form-control" name="buy_date">
                                </div>
                                <div class="form-group">
                                    <label>Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Buying Price</label>
                                    <input type="text" class="form-control" name="buying_price" placeholder="Buy Price">
                                </div>
                                
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control" placeholder="Sell Price">
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#"/>
                                    <label>Product Photo</label>
                                    <input type="file" name="product_image" accept="image/*" class="upload" required onchange="readURL(this);">
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                            </form>
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



    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
</div>


@endsection