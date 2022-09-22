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
                  <div class="row">
                    <div class="col-md-8">
                        <h3>E-wallet Details</h3>
                    </div>
                    <div class="col-md-3 col-lg-3">
                       <div class="searchbar">
                           <form action="" method="get">
                               <div class="input-group">
                                 <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                                 <div class="input-group-append">
                                   <button class="btn" type="submit" id="button-addon2" style="background-color:lightgray;"><img src="{{asset('admin/assets/images/svg-icon/search.svg')}}" class="img-fluid" alt="search" style="min-width:20px;"></button>
                                 </div>
                               </div>
                           </form>
                       </div>
                   </div>
                  </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table  class=" display table table-striped table-bordered" >
                            <thead>
                              <tr>
                                {{-- <th>No</th> --}}
                                <th>#</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th>Amount</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($wallets))
                                @foreach ($wallets as $key=>$wallet)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$wallet->user->name}}</td>
                                    <td>{{$wallet->user_id}}</td>
                                    <td>${{$wallet->amount}}</td>
                                    <td>{{$wallet->created_at}}</td>
                                </tr>
                                @endforeach
                              @endif
                            </tbody>
                        </table>
                        {{$wallets->links()}}
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
