<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("userId");
            $table->string("user_id");
            $table->float("amount");
            $table->float("admin_fee")->nullable();
            $table->float("total")->nullable();
            $table->string("description")->nullable();
            $table->string("wallet_type")->nullable();
            $table->string("status")->nullable();
            $table->string("remarks")->nullable();
            $table->timestamp("confirm_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
