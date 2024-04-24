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

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">All Advanced Salary</h3>
                            <a href="{{ route('add.advancedSalary') }}" class="btn btn-sn btn-info pull-right">Add New Advanced Salary</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Photo</th>
                                                <th>Salary</th>
                                                <th>Month</th>
                                                <th>Advanced Salary</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                 
                                        <tbody>
                                            @foreach ($salary as $advancedSalary)
                                            <tr>
                                                <td>{{$advancedSalary->name}}</td>
                                                <td><img src="{{$advancedSalary->photo}}" style="height: 60px; width: 60px;"></td>
                                                <td>{{$advancedSalary->salary}}</td>
                                                <td>{{$advancedSalary->month}}</td>
                                               
                                                <td>{{$advancedSalary->advanced_salary}}</td>
                                                <td>
                                                    <a href="{{ URL::to(''.$advancedSalary->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <a href="{{ URL::to(''.$advancedSalary->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                    <a href="{{ URL::to(''.$advancedSalary->id) }}" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                          
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>


           
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