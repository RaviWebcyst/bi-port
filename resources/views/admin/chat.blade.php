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
                <h3>Chat</h3>
               </div>
                <div class="card-body">
                    <div class="mb-4 p-3 border border-dark" style="overflow-y:scroll;height:10%;">
                        @if (!empty($chats))
                        @foreach ($chats as $chat)
                        <div class="d-flex flex-row {{$chat->sender =='user' ? 'justify-content-start':'justify-content-end'}}" >
                              <div class="{{$chat->sender == 'user' ? 'bg-light text-dark' : 'bg-success text-white'}} mt-1 mb-1 rounded p-2" >{{ $chat->message }}</div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                    <form class="form-validate" action="{{route('admin.sendMessage',$id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        </div>
                        <div class="form-group row pl-5 pr-5">
                            <label class="col-lg-3 col-form-label" >Message<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="message"  rows="3" class="form-control border border-dark"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"></label>
                            <div class="col-lg-8 text-right" >
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="mt-5 card col-md-8 justify-content-center">
                <div class="card-header">Messages</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
@endsection
