<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\invest_active;
use App\invest_pack;
use App\User;
use App\wallet;

class DailyRoi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:roi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Roi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $actives = invest_active::where("status",0)->get();

      foreach($actives as $active){
        $user = User::where("id",$active->userId)->first();
        $pack = invest_pack::where("id",$active->pack)->first();

        // $usr = Carbon::parse($active->updated_at)->addHours(24);
        // $count = User::whereBetween("created_at",[$data->updated_at,$usr])->where("spid",$user->uid)->count();

        $invest = $active->invested;
        $amnt = ($pack->roi/100)*$invest;
        // if($count >= 2){
        //   $amnt *2;
        // }
        $amount = $amnt;
        $wallet = new wallet();
        $wallet->wallet_type = "USD";
        $wallet->amount = $amount;
        $wallet->transaction_type = "roi_bonus";
        $wallet->userId= $active->userId;
        $wallet->user_id= $user->uid;
        $wallet->description = "Daily ROI Recieved";
        $wallet->type = "credit";
        $wallet->save();
      }
    }
}
