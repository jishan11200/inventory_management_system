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
                        <div class="panel-heading"><h3 class="panel-title">Update Customer Information</h3></div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="panel-body">
                            <form rule="form" method="post" action="{{ url('/update-customer/'.$customer->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control"  name="name" placeholder="Full Name"  value="{{$customer->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$customer->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="Phone Number" value="{{$customer->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{$customer->address}}">
                                </div>
                                <div class="form-group">
                                    <label>Shop Name</label>
                                    <input type="text" name="shop_name" class="form-control" placeholder="Shop Name" value="{{$customer->shop_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Account Holder</label>
                                    <input type="text" class="form-control" name="account_holder" placeholder="Account Holder" value="{{$customer->account_holder}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="{{$customer->account_number}}">
                                </div>
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="{{$customer->bank_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Bank Branch</label>
                                    <input type="text" name="bank_branch" class="form-control" placeholder="Bank Branch" value="{{$customer->bank_branch}}">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" value="{{$customer->city}}">
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#"/>
                                    <label>New Photo</label>
                                    <input type="file" name="photo" accept="image/*" class="upload"  onchange="readURL(this);">
                                </div>

                                <div class="form-group">
                                  <img src="{{ URL::to($customer->photo) }}" name="old_photo" alt="" style="height: 80px; width: 80px;">
                                   
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Update</button>
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