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
                        <h3>Pending Withraws</h3>
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
                                <th>#</th>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($withdraws))
                                @foreach ($withdraws as $key=>$withdraw)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$withdraw->user->uid}}</td>
                                    <td>{{$withdraw->user->name}}</td>
                                    <td>${{$withdraw->amount}}</td>
                                    <td>{{$withdraw->created_at}}</td>
                                    <td>
                                      <button type="button" class="btn btn-info mt-1 model-animation-btn" data-animation="zoomIn" data-toggle="modal" data-target="#confirm-model" data-id="{{$withdraw->id}}" id="confirm">Confirm  </button>
                                    </td>
                                </tr>
                                @endforeach
                              @endif
                            </tbody>
                        </table>
                        {{$withdraws->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->

    </div>
    <!-- End row -->
</div>

    <div class="modal fade" id="confirm-model" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog  zoomIn  animated" role="document">
            <div class="modal-content">
              <form  action="{{route('withdraw.confirm')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-model">Confirm Withdraw</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="withdraw_id" value="" id="withdraw">
                    <textarea name="remarks" rows="3" class="form-control border-dark"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
  $("#confirm").click(function(){
      var id = $(this).data("id");
      $("#withdraw").val(id);
    });
  });
</script>
@endsection
