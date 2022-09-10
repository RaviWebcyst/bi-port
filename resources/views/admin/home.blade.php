@extends('layouts.admin_app')

@section('content')
{{-- <div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-12 col-lg-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
            <h4 class="page-title">Admin Dashboard</h4>

        </div>

    </div>
</div> --}}

<div class="contentbar mt-5">
    <!-- Start row -->
    <div class="row mt-5">

        <!-- Start col -->
        @if (isset($users))


        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Users</h5>
                            <h4 class="mb-0">{{$users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Active Users</h5>
                            <h4 class="mb-0">{{$active_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-credit-card"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Deposit</h5>
                            <h4 class="mb-0">$ {{$total_deposit}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-credit-card"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Withdrawal</h5>
                            <h4 class="mb-0">$ {{$total_withdraw}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather  icon-mail"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Pending Tickets</h5>
                            <h4 class="mb-0">{{$pending_ticket}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather  icon-mail"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Confirmed Tickets</h5>
                            <h4 class="mb-0">{{$resolved_ticket}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
