@extends('layouts.admin_app')
@section('content')
<div class="contentbar mt-5">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->

        <div class="col-lg-12">
            <div class="card m-b-30">
                @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <div class="card-header">
                    <h3>Activation Packages</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table  class=" display table table-striped table-bordered" >
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($packages))
                                @foreach ($packages as $key=>$package)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$package->title}}</td>
                                    <td>${{$package->amount}}</td>
                                </tr>
                                @endforeach
                              @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->

    </div>
    <!-- End row -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
  $("#delete").click(function(){
    if (!confirm("Do you want to delete")){
        return false;
        }
        else{
            return true;
        }
    });
  });
</script>
@endsection
