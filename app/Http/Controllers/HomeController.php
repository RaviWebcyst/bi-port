<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\wallet;
use App\support;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        $users = User::where("is_admin","!=",1)->count();
        $active_users = User::where('is_admin',"!=",1)->where('enable',1)->count();
        $total_withdraw = wallet::where("transaction_type",'withdraw')->sum('amount');
        $total_deposit = wallet::where("transaction_type",'deposit')->sum('amount');
        $pending_ticket = support::where("status",'pending')->count();
        $resolved_ticket = support::where("status",'resolved')->count();
        return view('admin.home',compact('users','active_users','total_withdraw','pending_ticket','resolved_ticket','total_deposit'));
    }
}
