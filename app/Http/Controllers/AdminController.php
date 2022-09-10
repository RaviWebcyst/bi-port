<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\wallet;
use App\package;
use App\support;
use App\chat;
use App\withdraw;
use App\invest_active;
use App\invest_pack;
use App\pack_active;


use Carbon\Carbon;


class AdminController extends Controller
{
    public function login(){
        return view("admin.login");
    }

    public function users(Request $request){
        $users = User::where("is_admin","!=",1)->when($request->search,function($q) use($request){
          $q->where("name","like","%".$request->search."%")->orWhere("email","like","%".$request->search."%")->orWhere("uid","like","%".$request->search."%")->orWhere("spid","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");
        })->orderBy("id","desc")->paginate();
        $users->appends(["search"=>$request->search]);
        return view('admin.users',compact('users'));
    }
    public function paidUser(Request $request){
        $users = User::where("is_admin","!=",1)->where("enable",1)->when($request->search,function($q) use($request){
          $q->where("name","like","%".$request->search."%")->orWhere("email","like","%".$request->search."%")->orWhere("uid","like","%".$request->search."%")->orWhere("spid","like","%".$request->search."%")->orWhere("phone","like","%".$request->search."%");
        })->orderBy("id","desc")->paginate();
        $users->appends(["search"=>$request->search]);
        return view('admin.paid_users',compact('users'));
    }

    public function wallet(){
        return view('admin.eWallet');
    }
    public function walletSend(Request $request){
        $user = User::where("uid",$request->user_id)->first();
        $wallet = new wallet();
        $wallet->user_id = $request->user_id;
        $wallet->userId = $user->id;
        $wallet->amount = $request->amount;
        $wallet->from = "admin";
        $wallet->transaction_type = "send";
        $wallet->wallet_type = "epin";
        $wallet->type="credit";
        $wallet->description = "Sent ".$request->amount." from admin, Credit in user:- ".$request->user_id;
        $wallet->save();

        return redirect()->back()->with("success","Amount Credit Successfully");
    }

    public function walletDetails(Request $request){
        $wallets = wallet::orderBy("id","desc")->where("type","credit")->when($request->search,function($q) use($request){
          $q->where("userId","like","%".$request->search."%")->orWhere("amount","like","%".$request->search."%");
        })->where("wallet_type","epin")->paginate();
        $wallets->map(function($data){
            $data->user = User::where("uid",$data->user_id)->first();
            return $data;
        });
        $wallets->appends(["search"=>$request->search]);
        return view("admin.walletDetails",compact('wallets'));
    }

    public function packages(){
        $packages = package::orderBy("id","desc")->get();
        return view("admin.packages",compact('packages'));
    }

    public function transactions(Request $request){
        $wallets = wallet::orderBy("id","desc")->when($request->search,function($q) use($request){
          $q->where("user_id","like","%".$request->search."%")->orWhere("amount","like","%".$request->search."%")->orWhere("type","like","%".$request->search."%")->orWhere("description","like","%".$request->search."%");
        })->paginate();
        $wallets->map(function($data){
            $data->user = User::where("uid",$data->user_id)->first();
            return $data;
        });
        $wallets->appends(["search"=>$request->search]);
        return view("admin.walletTransactions",compact('wallets'));
    }

    public function queries(){
        $supports  = support::where("status","pending")->get();
        $supports->map(function($data){
            $data->user = User::where("uid",$data->user_id)->first();
            return $data;
        });
        return view("admin.pending_queries",compact('supports'));
    }

    public function resolved(){
        $supports  = support::where("status","resolved")->get();
        $supports->map(function($data){
            $data->user = User::where("uid",$data->user_id)->first();
            return $data;
        });
        return view("admin.resolved_queries",compact('supports'));
    }

    public function changeStatus($id){
        support::where("id",$id)->update([
            "status"=>"resolved"
        ]);
        return redirect()->back();
    }

    public function chat($id){
        $chats = chat::where("support_id",$id)->get();
        return view('admin.chat',compact('id','chats'));
    }
    public function sendMessage(Request $request,$id){
        $chat = new chat();
        $chat->support_id = $id;
        $chat->sender = "admin";
        $chat->reciever = "user";
        $chat->message = $request->message;
        $chat->save();
        return redirect()->back()->with("success","Message Sent Successfully");
    }

    public function pendingWithdraw(Request $request){
      $withdraws = withdraw::where('status','pending')->when($request->search,function($q) use($request){
        $q->where("userId","like","%".$request->search."%")->orWhere("amount","like","%".$request->search."%");
      })->orderBy("id","desc")->paginate();
      $withdraws->map(function($data){
        $data->user = User::where("id",$data->userId)->first();
        return $data;
      });
      $withdraws->appends(["search"=>$request->search]);
      return view('admin.withdraw_pending',compact('withdraws'));
    }

    // confirm withdraw
    public function confirmWithdraw(Request $request){
      $withdraw = withdraw::where("id",$request->withdraw_id)->first();
      $withdraw->remarks = $request->remarks;
      $withdraw->status = "confirmed";
      $withdraw->confirm_date = Carbon::now();
      $withdraw->save();
      return redirect()->back()->with("success","Request Confirmed");

    }

    //confirmed withdraw list
    public function confirmedWithdraw(Request $request){
      $withdraws = withdraw::where('status','confirmed')->when($request->search,function($q) use($request){
        $q->where("user_id","like","%".$request->search."%")->orWhere("amount","like","%".$request->search."%");
      })->orderBy("id","desc")->paginate();
      $withdraws->map(function($data){
        $data->user = User::where("id",$data->userId)->first();
        return $data;
      });
      $withdraws->appends(["search"=>$request->search]);
      return view('admin.withdraw_confirmed',compact('withdraws'));
    }

    public function investments(){
      $invests = invest_active::orderBy("id","desc")->get();
      $invests->map(function($data){
        $data->user = User::where("id",$data->userId)->first();
        return $data;
      });
      return view('admin.investments',compact('invests'));
    }

    public function investPackages(){
        $packages = invest_pack::orderBy("id","desc")->get();
        return view('admin.investPackage',compact('packages'));
    }

    public function investEdit($id){
      $invest = invest_pack::findOrFail($id);
      return view('admin.investPack_edit',compact('invest'));
    }
    public function investUpdate($id,Request $request){
        $invest = invest_pack::findOrFail($id);
        $invest->roi = $request->roi;
        $invest->save();
        return redirect()->route("admin.investPackages")->with("success",'Package Updated successfully');
    }

    public function userStatus(Request $request){
      User::where("id",$request->id)->update([
        'is_enable'=> $request->val
      ]);

      return response("success");
    }

    public function test(){
      $users = pack_active::where("status","paid")->get();
      // $users->map(function($data){
      //   $usr = Carbon::parse($data->updated_at)->addHours(24);
      //   $user = User::where("id",$data->userId)->first();
      //   // $data->count = User::whereBetween("created_at",[$data->updated_at,$usr])->where("spid",$user->uid)->count();
      //   $data->sponsers = User::where("enable",1)->where("spid",$user->uid)->first();
      //   return $data;
      // });
      // dd($users);
        $sponsers = [];
      foreach($users as $user){
        // $usr = Carbon::parse($user->created_at)->addHours(24);
        $userr = User::where("id",$user->userId)->first();
        $sponser = User::where("enable",1)->where("spid",$userr->uid)->get();
        $sponser->map(function($data){
          $usr = Carbon::parse($data->created_at)->addHours(24);
          $data->directs = User::where("spid",$data->uid)->where("paid_date",">",$usr)->count();
          return $data;
        });
        $sponsers[] = $sponser;
      }
      dd($sponsers);

    }

}
