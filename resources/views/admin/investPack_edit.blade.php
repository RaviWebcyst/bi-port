@extends('layouts.admin_app')
@section('content')

<div class="contentbar">
    <!-- Start row -->
    <div class="row justify-content-center mt-5">
        <!-- Start col -->
        <div class="col-lg-6 ">
            <div class="card m-b-30">
               @if(session('success'))
               <div class="alert alert-success">{{session('success')}}</div>
               @endif
               @if(session('error'))
               <div class="alert alert-danger">{{session('error')}}</div>
               @endif
               <div class="card-header">
                <h3>Edit Investment Package</h3>
               </div>
                <div class="card-body">
                    <form class="form-validate" action="{{route('invest.update',$invest->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" >ROI</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control"  name="roi" placeholder="Enter Daily ROI" value="{{$invest->roi}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"></label>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
@endsection
