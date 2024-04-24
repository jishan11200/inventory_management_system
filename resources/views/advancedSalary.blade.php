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
                    <div class="panel panel-info">
                        <div class="panel-heading"><h3 class="panel-title  text-white">Add Advanced Salary Provide</h3></div>
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
                            <form rule="form" method="post" action="{{ url('/insert-advanced-salary') }}">
                                @csrf
                                <div class="form-group">
                                    @php
                                    $employee = DB::table('employees')->get();
                                    @endphp
                                    <label >Employee Name</label>
                                    <select class="form-control" name="emp_id" id="">
                                        <option disabled="" selected>Selected Employee Name</option>
                                        @foreach ($employee as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Month</label>
                                    <select class="form-control" name="month" id="">
                                        <option disabled="" selected>Selected Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="November">November</option>
                                        <option value="Decembar">Decembar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" class="form-control" name="year" placeholder="Year">
                                </div>

                                <div class="form-group">
                                    <label>Advanced Salary</label>
                                    <input type="text" class="form-control" name="advanced_salary" placeholder="Advanced Salary">
                                </div>
                               
                              
                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
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