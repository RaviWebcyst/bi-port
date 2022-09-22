@extends('layouts.admin_app')
@section('content')
{{--
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h3 class="page-title">Users</h3>
        </div>

        <div class="col-md-4 col-lg-4">
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
</div> --}}
<div class="contentbar mt-5">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->

        <div class="col-lg-12">
            <div class="card m-b-30">
                @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-8">
                        <h3>Users</h3>
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
                        <table  class=" display table table-striped table-bordered" id="edit-btn">
                            <thead>
                              <tr>
                                {{-- <th>No</th> --}}
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>UID</th>
                                <th>SPID</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Package</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($users))
                                @foreach ($users as $key=>$user)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->uid}}</td>
                                    <td>{{$user->spid}}</td>
                                    <td>{{$user->showPass}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->enable==1?'Active':'Not Active'}}</td>
                                    <td>
                                      <button class="btn btn-info" type="button" onclick="enableDisable({{$user->id}},{{$user->is_enable==0?1:0}})">{{$user->is_enable == 0 ?'Disable':'Enable'}}</button>
                                    </td>
                                </tr>
                                @endforeach
                              @endif
                            </tbody>
                        </table>
                        {{$users->links()}}
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
    function enableDisable(id,val){

  $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':"{{csrf_token()}}"
        }
        });
      $.ajax({
        url:"{{route('user.status')}}",
        method:"post",
        data:{
          id:id,
          val:val
        },
        success:function(data){
          console.log(data);
          window.location.reload();
        }
      });
    });
    }

</script>
@endsection
