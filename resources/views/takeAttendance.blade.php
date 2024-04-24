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
                            {{-- <h3 class="panel-title">Today Attendance</h3> --}}
                            <h4 class="text-center text-red">Today Attendance: {{date('d/m/y') }}</h4>
                            {{-- <a href="{{ route('add.employee') }}" class="btn btn-sn btn-info pull-right">Add New Employee</a> --}}

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table  class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Attendance</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ url('/insert-attendance') }}" method="post">
                                                @csrf
                                                @foreach ($employee as $employee)
                                                <tr>
                                                    <td>{{$employee->name}}</td>
                                                    <td><img src="{{$employee->photo}}" style="height: 60px; width: 60px;"></td>
                                                    <input type="hidden" name="user_id[]" value="{{ $employee->id}}">
                                                    <td>
                                                        <input type="radio" name="attendance[{{ $employee->id}}]" value="Present">Present
                                                        <input type="radio" name="attendance[{{ $employee->id}}]" value="Absence">Absence
                                                        
                                                    </td>
                                                    <input type="hidden" name="att_date" value="{{date('d-m-y')}}">
                                                    <input type="hidden" name="att_year" value="{{date('Y')}}">
                                                    {{-- <td>
                                                        <a href="{{ URL::to('edit-employee/'.$employee->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a href="{{ URL::to('delete-employee/'.$employee->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                        <a href="{{ URL::to('view-employee/'.$employee->id) }}" class="btn btn-sm btn-primary">View</a>
                                                    </td> --}}
                                                </tr>
                                                @endforeach 
                                            
                                        
                                        </tbody>
                                        
                                    </table>
                                    <button type="submit" class="btn btn-sm btn-success">Take Attendance</button>
                                </form>

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