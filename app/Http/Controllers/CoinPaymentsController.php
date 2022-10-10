<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Kevupton\LaravelCoinpayments\Providers\LaravelCoinpaymentsServiceProvider;
use App\callback;
use App\wallet;
use App\order;
use App\User;


use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class CoinPaymentsController extends Controller
{
    public function payment(Request $request){
        //merchat id = 49efa49a6c65e5d716f46458b5994f6c;
        $user = JWTAuth::parseToken()->authenticate();
        include app_path() . '/Http/Controllers/init.php';
        $coin->Setup('4D8ea842e25722a24FdF24fcA940a4d919B5BBD4233b48a55D8B62aeA915C46E', '6570b8a7528506e26c1dc0107ee2754c2d21d2ad636474a259dfa2441bbc4c1c');
        $basicInfo = $coin->GetBasicProfile();
        $username = $basicInfo['result']['public_name'];

        $amount = $request->amount;
        $scurrency = "USDT";
        $rcurrency = "USDT.TRC20";
        $req = [
            'amount' => $amount,
            'currency1' => $scurrency,
            'currency2' => $rcurrency,
            'buyer_email'=>'abch396@gmail.com',
            'item' => "Donate to coinpayment",
            'address' => "",
            'ipn_url' => "http://bi-port.live/vue/api/callback"
        ];
        $result = $coin->CreateTransaction($req);

        order::create([
           "payment_id" => $result['result']['txn_id'],
           "user_id" => $user->id,
           "amount" => $amount,
           "status_url" => $result['result']['status_url'],
           "address" => $result['result']['address']
       ]);
       callback::create([
           "response" => "before status" . json_encode($result['result'])
       ]);

        return response()->json(["status" => 1, "data" => $result['result'], "qr_code" => $result['result']['qrcode_url']]);
    }

    public function callback(Request $request){
      callback::create([
          "response" => 'ipn'
      ]);
      $postdata = $_POST;
      $data = json_encode($postdata);
      callback::create([
          "response" => $data
      ]);
      $payment_id = $postdata['txn_id'];
      $order = order::where("payment_id", $payment_id)->first();
      $order->wallet = $postdata['currency2'];
      $order->status = $postdata['status'];
      $order->payment_status = $postdata['status_text'];
      $order->status_text = "Processing";
      $order->save();
      if ($postdata['status'] == "100") {
          callback::create([
              "response" => "success" . $data
          ]);
          $amount = $order->amount;
          $user_id = $order->user_id;
          $amount1 = $postdata['amount1'];
          $amount2 = $postdata['amount2'];

          $usr = User::where("id",$user_id)->first();
          if ($amount1 >= $amount2) {
              wallet::create([
                  "userId" => $user_id,
                  "user_id" => $usr->uid,
                  "amount" => $amount2,
                  "description" => "Fund credit in E-wallet with usdt",
                  "wallet_type" => "epin",
                  "transaction_type"=>"deposit",
                  "type"=>"credit"
              ]);
              order::where("payment_id", $payment_id)->update([
                  "wallet_status" => "transfer",
                  "status" =>  1,
                  "status_text"=>"Complete"
              ]);
          } else {
              order::where("payment_id", $payment_id)->update([
                  "wallet_status" => "pending"
              ]);
          }
      }
      return response()->json(["status" => 1]);
    }

    public function withdrawUsdt(Request $request){
      $usr = JWTAuth::parseToken()->authenticate();
      // $user = order::where("user_id",$usr->id)->where("status","complete")->first();
      // if(!empty($user)){
      include app_path() . '/Http/Controllers/init.php';
      $coin->Setup('4D8ea842e25722a24FdF24fcA940a4d919B5BBD4233b48a55D8B62aeA915C46E', '6570b8a7528506e26c1dc0107ee2754c2d21d2ad636474a259dfa2441bbc4c1c');
      $amount = $request->amount;
      $currency = "USDT.TRC20";
      // $address = $user->address;
      $req = [
          'amount' => $amount,
          'currency' =>$currency,
          'address' => 'TLVVFgtEeZ46XjVDrWd7BgtHuoTu8g3nNh',
          // 'ipn_url'=> "http://mern-stack.live/vue/api/withdraw_callback",
      ];
        $result = $coin->CreateWithdrawal($amount,$currency,'TN4H36qzmw1LTu77rGFaVGgftuN8ryk2M2');

        if($result->error == "ok"){
          wallet::create([
              "userId" => $usr->id,
              "user_id" => $usr->uid,
              "amount" => $amount,
              "description" => "amount is withdraw from coinpayment",
              "wallet_type" => "epin",
              "transaction_type"=>"withdraw",
              "type"=>"debit",
              "hex"=>$result->result->id
          ]);
          return reponse("success");
        }

    // }else{
    //   return response()->json("No Transaction exist for this User");
    // }
    }

    public function withdraw_callback(Request $request){
      dd($request->all());
    }

    public function CancelWithdraw(){
      include app_path() . '/Http/Controllers/init.php';
      $coin->Setup('4D8ea842e25722a24FdF24fcA940a4d919B5BBD4233b48a55D8B62aeA915C46E', '6570b8a7528506e26c1dc0107ee2754c2d21d2ad636474a259dfa2441bbc4c1c');
      $result = $coin->CancelWithdraw('https://bi-port.live/vue/api/withdraw_callback','CWGH3LKILSLTQY57ENQRRZXPHZ');
      return response($result);
    }

    public function withdrawHistory(Request $request){

    }

}
