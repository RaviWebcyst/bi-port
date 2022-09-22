@extends('layouts.admin_app')
@section("content")
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
                    <h3>Users</h3>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table  class=" display table table-striped table-bordered" >
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>User Id</th>
                                <th>Topic</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($supports))
                                @foreach ($supports as $key=>$support)
                                    
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$support->user_id}}</td>
                                    <td>{{$support->topic}}</td>
                                    <td>{{$support->subject}}</td>
                                    <td>{{$support->message}}</td>     
                                    <td>{{$support->status}}</td>    
                                    <td>{{$support->created_at}}</td>    
                                    <td>
                                        <a href="{{route('admin.status',$support->id)}}" class="btn btn-sm btn-warning ml-2" onclick="if(confirm('Are You Sure Want to Change Status')){event.preventDefault();document.getElementById('status-form').submit();}">Done</a>
                                        <a href="{{route('admin.chat',$support->id)}}" class="btn btn-sm btn-info">Chat</a>
                                    </td> 
                                    <form id="status-form" action="{{route('admin.status',$support->id)}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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
    
