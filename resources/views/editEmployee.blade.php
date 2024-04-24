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
                        <div class="panel-heading"><h3 class="panel-title">Update Employee Information</h3></div>
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
                            <form rule="form" method="post" action="{{ url('/update-employee/'.$employee->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control"  name="name" placeholder="Full Name"  value="{{$employee->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$employee->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="Phone Number" value="{{$employee->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{$employee->address}}">
                                </div>
                                <div class="form-group">
                                    <label>NID No</label>
                                    <input type="text" name="nid_no" class="form-control" placeholder="NID No" value="{{$employee->nid_no}}">
                                </div>
                                <div class="form-group">
                                    <label> Experience</label>
                                    <input type="text" class="form-control" name="experience" placeholder="Experience" value="{{$employee->experience}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="text" name="salary" class="form-control" placeholder="Salary" value="{{$employee->salary}}">
                                </div>
                                <div class="form-group">
                                    <label>Vacation</label>
                                    <input type="text" name="vacation" class="form-control" placeholder="Vacation" value="{{$employee->vacation}}">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" value="{{$employee->city}}">
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#"/>
                                    <label>New Photo</label>
                                    <input type="file" name="photo" accept="image/*" class="upload"  onchange="readURL(this);">
                                </div>

                                <div class="form-group">
                                  <img src="{{ URL::to($employee->photo) }}" name="old_photo" alt="" style="height: 80px; width: 80px;">
                                   
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