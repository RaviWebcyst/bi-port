<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\downline;
use App\pack_active;
use App\package;
use App\wallet;
use App\support;
use App\chat;
use App\withdraw;
use App\invest_active;
use App\invest_pack;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
  public function refer(Request $request){
      // $validator = Validator::make($request->json()->all(), [
      $validator = Validator::make($request->all(), [
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:2',
              "spid"=> 'required',
          ]);


          if($validator->fails()){
            return response()->json(["error"=>$validator->errors()->toJson(),"status"=>400]);
            exit;
              // return response()->json($validator->errors()->toJson(), 400);
          }

          $user = User::where("uid",$request->spid)->where("uid","!=","")->first();

          $usr = User::where("email",$request->email)->first();
          if(empty($user) || !empty($usr)){
              return response()->json("Invaild User id", 500);
          }

          $uid =  "BI".mt_rand(10000, 99999);

          $user = User::where("uid",$uid)->first();

          // if(!empty($user)){
          //     return false;
          // }


          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
          $user->showPass = $request->password;
          $user->spid = $request->spid;
          $user->phone = $request->phone;
          $user->uid =$uid;
          $user->save();


          // $user = User::create([
          //     'name' => $request->name,
          //     'email' => $request->email,
          //     'password' => Hash::make($request->password),
          //     'showPass' => $request->password,
          //     'spid' => $request->spid,
          //     'phone' => $request->phone,
          //     "uid"=> $uid,
          // ]);

      $tagsp = $user->spid;
      $user_id = $user->uid;
      $while = true;
      $lv = 1;

      while ($while == true) {
          $udata = User::where("uid",$tagsp)->where("is_admin","!=",1)->get();
          if(count($udata)<1){
              $while = false;
              break;
              exit;
          }
          downline::create([
              "tagsp"=>$tagsp,
              "user_id"=>$user_id,
              "spid"=>$udata[0]->id,
              "level"=>$lv

          ]);
          $userdata = $udata[0];
          $tagsp = $userdata['spid'];
          $lv++;
      }

          $token = JWTAuth::fromUser($user);



          return response()->json(compact('user','token'), 201);

  }

    public function register(Request $request){
        // $validator = Validator::make($request->json()->all(), [
        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:2',
                "spid"=> 'required',
            ]);


            if($validator->fails()){
              return response()->json(["error"=>$validator->errors()->toJson(),"status"=>400]);
              exit;
                // return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::where("uid",$request->spid)->where("uid","!=","")->first();

            $usr = User::where("email",$request->email)->first();
            if(empty($user) || !empty($usr)){
                return response()->json("Invaild User id", 500);
            }

            $uid =  "BI".mt_rand(10000, 99999);

            $user = User::where("uid",$uid)->first();

            // if(!empty($user)){
            //     return false;
            // }


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->showPass = $request->password;
            $user->spid = $request->spid;
            $user->phone = $request->phone;
            $user->uid =$uid;
            $user->save();


            // $user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password),
            //     'showPass' => $request->password,
            //     'spid' => $request->spid,
            //     'phone' => $request->phone,
            //     "uid"=> $uid,
            // ]);

        $tagsp = $user->spid;
        $user_id = $user->uid;
        $while = true;
        $lv = 1;

        while ($while == true) {
            $udata = User::where("uid",$tagsp)->where("is_admin","!=",1)->get();
            if(count($udata)<1){
                $while = false;
                break;
                exit;
            }
            downline::create([
                "tagsp"=>$tagsp,
                "user_id"=>$user_id,
                "spid"=>$udata[0]->id,
                "level"=>$lv

            ]);
            $userdata = $udata[0];
            $tagsp = $userdata['spid'];
            $lv++;
        }

            $token = JWTAuth::fromUser($user);



            return response()->json(compact('user','token'), 201);

    }

    public function login(Request $request){
        // $credentials = $request->json()->all();



        $user = User::where("email",$request->email)->orWhere("uid",$request->email)->first();
        $users= [
          "email"=>$user->email,
          "password"=>$request->password
        ];

        if($request->email == "" && $request->password == ""){
          return response()->json(['error'=>'Invalid User'], 500);
        }
        else if($request->email == "admin@gmail.com" ){
            return response()->json(['error'=>'Invalid User'], 500);
        }
        else if($user->is_enable == 1){
          return response()->json(['error'=>'Invalid User data'], 500);
        }
        else{


        $credentials = $request->all();



        try {
            if(! $token = JWTAuth::attempt($users)){
                    return response()->json(['error'=>'invalid Credentials'], 500);
            }
        }catch (JWTException $e){
            return response()->json(['error'=>'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
      }

    }

    public function getAuthenticatedUser(Request $request){
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 400);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['token_expired']);
        }catch (TokenInvalidException $e){
            return response()->json(['token_invalid ']);
        }catch (JWTException $e){
            return response()->json(['token_absent']);
        }
        $credit = wallet::where("wallet_type","epin")->where("type","credit")->where("userId",$user->id)->sum('amount');
        $debit = wallet::where("wallet_type","epin")->where("type","debit")->where("userId",$user->id)->sum('amount');
        $balance = $credit-$debit;

        return response()->json(compact('user','balance'));
    }

    public function getUsers(Request $request){

       $user = User::where("uid",$request->spid)->where("uid","!=","")->get();
        return response()->json($user);
    }

    public function changePwd(Request $request){

        User::where("email",$request->email)->update([
            "password"=>Hash::make($request->password),
            "showPass"=> $request->password
        ]);
        return response()->json("status",200);
    }

    public function invest(Request $request){
        $log_usr = JWTAuth::parseToken()->authenticate();

        $credit = wallet::where("wallet_type","epin")->where("user_id",$log_usr->uid)->where("type","credit")->sum('amount');
        $debit = wallet::where("wallet_type","epin")->where("user_id",$log_usr->uid)->where("type","debit")->sum('amount');
        $balance = $credit - $debit;



        $package = package::where("amount",$request->amount)->first();
        $user = User::where("uid",$request->user_id)->first();


        $pack_invest = pack_active::where('userId',$user->id)->first();
        if(empty($pack_invest)){

        if($balance > $request->amount){
            $active = new pack_active();
            $active->userId = $user->id;
            $active->package = $package->id;
            $active->status = "paid";
            $active->save();

            $invest = new invest_active();
            $invest->userId = $user->id;
            $invest->pack = $package->id;
            $invest->invested = $request->amount;
            $invest->save();

            $wallet = new wallet();
            $wallet->user_id = $log_usr->uid;
            $wallet->userId = $log_usr->id;
            $wallet->amount = $request->amount;
            $wallet->from = "admin";
            $wallet->transaction_type = "joining";
            $wallet->wallet_type = "epin";
            $wallet->type="debit";
            $wallet->description = "Transaction for id top up is Successfully top up";
            $wallet->save();

             User::where("id",$user->id)->update([
                "package"=>$package->id,
                "paid_date"=> Carbon::now(),
                "enable"=>1
            ]);

            $usr = User::where("uid",$user->spid)->first();
            $income = 0.1*$request->amount;
            $wallet = new wallet();
            $wallet->user_id = $user->spid;
            $wallet->userId = $usr->id;
            $wallet->amount = $income;
            $wallet->from = $user->uid;
            $wallet->transaction_type = "direct";
            $wallet->wallet_type = "USD";
            $wallet->type="credit";
            $wallet->description = "Direct income (10%) recieved from ".$user->uid;
            $wallet->save();

            $sponsers = User::where("enable",1)->where("uid",$user->spid)->get();

            $sponsers->map(function($data){
              $time  = Carbon::parse($data->paid_date)->addHours(24);
              $directs = User::where("enable",1)->where("paid_date","<",$time)->where("spid",$data->spid)->count();
              if($directs >= 2){
                    User::where("uid",$data->spid)->update([
                      "booster"=>1
                    ]);
              }
                return $data;
            });


            return response()->json(["status"=>200]);
        }
        else{
            return response()->json(["status"=>400]);
        }
      }
      else{
          return response()->json(["status"=>401]);
      }

    }

    public function walletDetails(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $wallets = wallet::where("user_id",$user->uid)->where("wallet_type",'epin')->get();
        return response()->json($wallets);
    }

    //get active packages of user
    public function activePackages(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $packages= pack_active::join("packages","pack_actives.package","packages.id")->where("pack_actives.package",$user->package)->where("pack_actives.userId",$user->id)->get();
        return response()->json($packages);
    }

    //get total investment of logged user
    public function investments(){
        $user = JWTAuth::parseToken()->authenticate();
        $invests = wallet::where("userId",$user->id)->where("type","debit")->where("wallet_type","epin")->where("transaction_type","joining")->get();
        $invests->map(function($data) use($user){
            $data->invests = pack_active::where("userId",$data->userId)->first();
            $data->user = $user;
            return $data;
        });
        return response()->json($invests);
    }

    //get direct team of logged user
    public function directs(){
        $user = JWTAuth::parseToken()->authenticate();
        $directs = User::where("spid",$user->uid)->get();
        $directs->map(function($data){
            $data->package = package::where("id",$data->package)->first();
            $data->downline = downline::where("tagsp",$data->uid)->first();
            return $data;
        });
        return response()->json($directs);
    }

    //get other details show on user dashboard
    public function details(){
        $user = JWTAuth::parseToken()->authenticate();
        $credit = wallet::where("userId",$user->id)->where("wallet_type","epin")->where("type","credit")->sum('amount');
        $debit = wallet::where("userId",$user->id)->where("wallet_type","epin")->where("type","debit")->sum('amount');
        $wallet = $credit-$debit;

        // $total_investment = wallet::where("userId",$user->id)->where("wallet_type","epin")->where("type","debit")->where("transaction_type","joining")->sum('amount');
        $total_investment = invest_active::where("userId",$user->id)->sum('invested');
        $direct_bonus = wallet::where("userId",$user->id)->where("transaction_type","direct")->sum('amount');
        $dailyProfit = wallet::where("userId",$user->id)->where("transaction_type","roi_bonus")->sum('amount');
        $totalWithdraw = wallet::where("userId",$user->id)->where("transaction_type","withdraw")->sum('amount');
        $dailyProfit = round($dailyProfit,2);

        $total_credit = wallet::where("userId",$user->id)->where("wallet_type","USD")->where("type","credit")->sum('amount');
        $total_debit = wallet::where("userId",$user->id)->where("wallet_type","USD")->where("type","debit")->sum('amount');
        $balance = $total_credit-$total_debit;
        $balance = round($balance,2);
        return response()->json(["wallet"=>$wallet,"invest"=>$total_investment,"balance"=>$balance,"direct_bonus"=>$direct_bonus,"dailyProfit"=>$dailyProfit,"totalWithdraw"=>$totalWithdraw]);
    }

    public function downline(){
        $user = JWTAuth::parseToken()->authenticate();
        $downline = downline::where("tagsp",$user->uid)->get();
        $downline->map(function($data){
            $user = User::where("uid",$data->user_id)->first();
            $data->user = $user;
            $data->package = package::where("id",$user->package)->first();
            return $data;
        });
        return response()->json($downline);
    }

    public function walletTransfer(Request $request){
        //get sender user
        $usr = User::where("uid",$request->user_id)->first();

        //get logged in user
        $user = JWTAuth::parseToken()->authenticate();
        if($user->showPass == $request->password){

        $credit = wallet::where("wallet_type","USD")->where("user_id",$user->uid)->where("type","credit")->sum('amount');
        $debit = wallet::where("wallet_type","USD")->where("user_id",$user->uid)->where("type","debit")->sum('amount');
        $balance = $credit - $debit;

        if($balance > $request->amount){

        $wallet = new wallet();
        $wallet->user_id = $user->uid;
        $wallet->userId = $user->id;
        $wallet->amount = $request->amount;
        $wallet->from = $request->user_id;
        $wallet->transaction_type = "send";
        $wallet->wallet_type = "USD";
        $wallet->type="debit";
        $wallet->description = "Sent ".$request->amount. " from main wallet in user:- ".$request->user_id;
        $wallet->save();

        $wallet = new wallet();
        $wallet->user_id = $request->user_id;
        $wallet->userId = $usr->id;
        $wallet->amount = $request->amount;
        $wallet->from = $user->uid;
        $wallet->transaction_type = "recieve";
        $wallet->wallet_type = "epin";
        $wallet->type="credit";
        $wallet->description = "credit ".$request->amount. "from main wallet in user_id:- ".$user->uid;
        $wallet->save();

        return response()->json(["status"=>200]);
        }
        else{
            return response()->json(["status"=>400]);
        }
    }
        else{
            return response()->json(["status"=>401]);
        }
    }

      public function eWalletTransfer(Request $request){
        //get sender user
        $usr = User::where("uid",$request->user_id)->first();

        //get logged in user
        $user = JWTAuth::parseToken()->authenticate();
        if($user->showPass == $request->password){

        $credit = wallet::where("wallet_type","epin")->where("user_id",$user->uid)->where("type","credit")->sum('amount');
        $debit = wallet::where("wallet_type","epin")->where("user_id",$user->uid)->where("type","debit")->sum('amount');
        $balance = $credit - $debit;

        if($balance > $request->amount){

        $wallet = new wallet();
        $wallet->user_id = $user->uid;
        $wallet->userId = $user->id;
        $wallet->amount = $request->amount;
        $wallet->from = $request->user_id;
        $wallet->transaction_type = "send";
        $wallet->wallet_type = "epin";
        $wallet->type="debit";
        $wallet->description = "Sent ".$request->amount. "in user:- ".$request->user_id;
        $wallet->save();

        $wallet = new wallet();
        $wallet->user_id = $request->user_id;
        $wallet->userId = $usr->id;
        $wallet->amount = $request->amount;
        $wallet->from = $user->uid;
        $wallet->transaction_type = "recieve";
        $wallet->wallet_type = "epin";
        $wallet->type="credit";
        $wallet->description = "credit ".$request->amount. "from ".$user->uid;
        $wallet->save();

        return response()->json(["status"=>200]);
        }
        else{
            return response()->json(["status"=>400]);
        }
    }
        else{
            return response()->json(["status"=>401]);
        }
    }

    public function sendMsg(Request $request){
         //get logged in user
         $user = JWTAuth::parseToken()->authenticate();

         $support = new support();
         $support->topic = $request->topic;
         $support->email = $request->email;
         $support->subject = $request->subject;
         $support->message = $request->message;
         $support->status = "pending";
         $support->user_id = $user->uid;
         $support->save();

         $chat = new chat();
         $chat->support_id = $support->id;
         $chat->user_id = $user->uid;
         $chat->sender = "user";
         $chat->reciever = "admin";
         $chat->message = $request->message;
         $chat->save();

         return response()->json(["status"=>"Message sent successfully"],200);

    }

    public function resolvedTickets(){
        $user = JWTAuth::parseToken()->authenticate();
        $supports= support::where("user_id",$user->uid)->where("status","resolved")->get();
        return response()->json($supports);
    }

    public function recentTickets(){
        $user = JWTAuth::parseToken()->authenticate();
       $supports= support::where("user_id",$user->uid)->where("status","pending")->get();
       return response()->json($supports);
    }

    public function chat(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $chat = new chat();
        $chat->support_id = $request->id;
        $chat->user_id = $user->uid;
        $chat->sender = "user";
        $chat->reciever = "admin";
        $chat->message = $request->message;
        $chat->save();

        return response()->json(["status"=>"Message sent successfully"],200);

    }

    public function recentChat(Request $request){
        $chats = chat::where("support_id",$request->id)->get();
        return response()->json($chats);
    }

    public function investment_withdraw(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        // $wallet = new wallet();
        // $wallet->user_id = $user->uid;
        // $wallet->userId = $user->id;
        // $wallet->amount = $request->amount;
        // $wallet->transaction_type = "withdraw";
        // $wallet->wallet_type = "epin";
        // $wallet->type="debit";
        // $wallet->description = "Withdraw request by name:- ".$user->name." user_id:- ".$user->uid;
        // $wallet->save();

        $fee = 0.1*$request->amount;
        $amount = $request->amount - $fee;

        $with = new withdraw();
        $with->user_id  = $user->uid;
        $with->userId = $user->id;
        $with->amount = $amount;
        $with->admin_fee = $fee;
        $with->total = $request->amount;
        $with->wallet_type = "epin";
        $with->status = "pending";
        $with->description = "Withdraw request by name:- ".$user->name." user_id:- ".$user->uid;
        $with->save();

         invest_active::where("id",$request->id)->update([
           "status"=>1
         ]);

        return response()->json(["status"=>200]);
    }

    public function withdraw(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        // return response($request->password);
        if($user->showPass == $request->password){
            $credit = wallet::where("wallet_type","USD")->where("user_id",$user->uid)->where("type","credit")->sum('amount');
            $debit = wallet::where("wallet_type","USD")->where("user_id",$user->uid)->where("type","debit")->sum('amount');
            $balance = $credit - $debit;

            if($balance > $request->amount && $request->amount >= 2){

                $wallet = new wallet();
                $wallet->user_id = $user->uid;
                $wallet->userId = $user->id;
                $wallet->amount = $request->amount;
                $wallet->transaction_type = "withdraw";
                $wallet->wallet_type = "USD";
                $wallet->type="debit";
                $wallet->description = "Withdraw request by name:- ".$user->name." user_id:- ".$user->uid;
                $wallet->save();

                $fee = 0.1*$request->amount;
                $amount = $request->amount - $fee;

                $with = new withdraw();
                $with->user_id  = $user->uid;
                $with->userId = $user->id;
                $with->amount = $amount;
                $with->admin_fee = $fee;
                $with->total = $request->amount;
                $with->wallet_type = "USD";
                $with->status = "pending";
                $with->description = "Withdraw request by name:- ".$user->name." user_id:- ".$user->uid;
                $with->save();

                return response()->json(["status"=>200]);
            }
            else{
                return response()->json(["status"=>401]);
            }
        }
        else{
            return response()->json(["status"=>400]);
        }
    }

    public function withdrawDetails(){
        $user = JWTAuth::parseToken()->authenticate();
        $withdraw = withdraw::where("user_id",$user->uid)->orderBy("id","desc")->get();
        return response()->json($withdraw);
    }

    public function transactions(){
        $user = JWTAuth::parseToken()->authenticate();
        $transactions = wallet::where("user_id",$user->uid)->where("wallet_type","USD")->orderBy("id","desc")->get();
        return response()->json($transactions);
    }

    public function topup(Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        $active = User::where("id",$user->id)->first();
        if($active->enable == 0){
          return response()->json("Please Activate Your Package First",500);
        }


        $credit = wallet::where("wallet_type","epin")->where("user_id",$user->uid)->where("type","credit")->sum('amount');
        $debit = wallet::where("wallet_type","epin")->where("user_id",$user->uid)->where("type","debit")->sum('amount');
        $balance = $credit - $debit;

        $package = invest_pack::first();
        $invest = invest_active::where("userId",$user->id)->orderBy("id","desc")->first();
        if((!empty($invest) && $request->amount > $invest->invested) || empty($invest)){
        if($request->amount < $balance){
            if($request->amount >= $package->min && $request->amount <= $package->max){

                    $invest = new invest_active();
                    $invest->userId = $user->id;
                    $invest->pack = 1;
                    $invest->invested = $request->amount;
                    $invest->status = 0;
                    $invest->save();


                    $wallet = new wallet();
                    $wallet->user_id = $user->uid;
                    $wallet->userId = $user->id;
                    $wallet->amount = $request->amount;
                    $wallet->transaction_type = "investment";
                    $wallet->wallet_type = "epin";
                    $wallet->type="debit";
                    $wallet->description = "Invest ".$request->amount." from ".$user->uid;
                    $wallet->save();

                    return response()->json(["status"=>200]);
             }
            else{
                return response()->json(["status"=>402]);
            }
        }
        else{
            return response()->json(["status"=>401]);
        }
      }
      else{
        return response()->json(["status"=>403]);
      }
    }

    public function invests(Request $request){
      $user = JWTAuth::parseToken()->authenticate();

      $invests =  invest_active::where("userId",$user->id)->get();
      return response()->json($invests);
    }

    public function levelList(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        // $referrals = DB::select('SELECT *, count(*) as cnt FROM `downlines` where tagsp="'.$user->uid.'" GROUP by level');
        // $referrals = collect($referrals);
        $referrals = downline::join('users',"users.uid","downlines.user_id")->where("downlines.tagsp",$user->uid)->groupBy("downlines.level")->get();

        $referrals->map(function($data) use($user){
            $data->active = downline::join('users',"users.uid","downlines.user_id")->where("downlines.tagsp",$user->uid)->where("downlines.level",$data->level)->where("users.enable",1)->count();
            $data->inactive = downline::join('users',"users.uid","downlines.user_id")->where("downlines.tagsp",$user->uid)->where("downlines.level",$data->level)->where("users.enable",0)->count();

            return $data;
        });

        return response()->json($referrals);
    }

    public function dailyProfit(Request $request){
      $user = JWTAuth::parseToken()->authenticate();
      $wallets = wallet::where("userId",$user->id)->where("transaction_type","roi_bonus")->get();
      $wallets->map(function($data){
        $data->package = package::first();
        return $data;
      });
      return response()->json($wallets);
    }
    public function directBonus(Request $request){
      $user = JWTAuth::parseToken()->authenticate();
      $wallets = wallet::where("userId",$user->id)->where("transaction_type","direct")->get();
      $wallets->map(function($data){
        $data->package = invest_pack::first();
        return $data;
      });
      return response()->json($wallets);
    }
}
