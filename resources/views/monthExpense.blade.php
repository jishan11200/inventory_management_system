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
                    <div>
                        <a href="{{route('january.expense')}}" class="btn btn-sm btn-info">January</a>
                        <a href="{{route('february.expense')}}" class="btn btn-sm btn-danger">February</a>
                        <a href="{{route('march.expense')}}" class="btn btn-sm btn-success">March</a>
                        <a href="{{route('april.expense')}}" class="btn btn-sm btn-primary">April</a>
                        <a href="{{route('may.expense')}}" class="btn btn-sm btn-warning">May</a>
                        <a href="{{route('june.expense')}}" class="btn btn-sm btn-info">June</a>
                        <a href="{{route('july.expense')}}" class="btn btn-sm btn-danger">July</a>
                        <a href="{{route('august.expense')}}" class="btn btn-sm btn-success">August</a>
                        <a href="{{route('september.expense')}}" class="btn btn-sm btn-primary">September</a>
                        <a href="{{route('october.expense')}}" class="btn btn-sm btn-warning">October</a>
                        <a href="{{route('november.expense')}}" class="btn btn-sm btn-default">November</a>
                        <a href="{{route('december.expense')}}" class="btn btn-sm btn-info">December</a>
                    </div>
                    
                    <div class="panel panel-default"><br>
                       
                        <div class="panel-heading">
                            <h3 class="panel-title text-danger">{{$date = date('F');}} All Expenses</h3>
                            <a href="{{ route('add.expense') }}" class="btn btn-sn btn-info pull-right">Add New</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Details</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>

                                 
                                        <tbody>
                                            @foreach ($monthly as $monthly)
                                            <tr>
                                                <td>{{$monthly->details}}</td>
                                                <td>{{$monthly->date}}</td>
                                                <td>{{$monthly->amount}}</td>
                                               
                                               
                                            </tr>
                                            @endforeach
                                            
                                          
                                        </tbody>
                                    </table>
                                    @php
                                    $month = date('F');
                                    $total = DB::table('expenses')->whereDate('month', $month)->sum('amount');
                                @endphp
                                   <h4 style="font-size: 30px; text-align:center; color:red;">Total Monthly Expense: {{$total}} Taka</h4>
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