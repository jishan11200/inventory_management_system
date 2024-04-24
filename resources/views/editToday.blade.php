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
                        <div class="panel-heading"><h3 class="panel-title">Add Expense  {{date('d-m-y');}}<a href="{{route('today.expense')}}" class="btn btn-sm btn-info pull-right">Today Expenses  <a href="" class="btn btn-sm btn-danger pull-right">This Month Expense</a></h3></div>
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
                            <form rule="form" method="post" action="{{ url('/update-today',$today->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label>Details</label>
                                  <textarea name="details" id="" cols="30" rows="4" class="form-control">{{$today->details}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$today->amount}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="date" placeholder="Date" value="{{date('d-m-y')}}">
                                </div>
                                <div class="form-group"> 
                                    <input type="hidden" class="form-control" name="month"  value="{{date('F')}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="year"  value="{{date('Y')}}">
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