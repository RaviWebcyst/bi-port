<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("userId");
            $table->string("user_id");
            $table->bigInteger("amount");
            $table->string("type");
            $table->bigInteger("from");
            $table->string("description")->nullable();
            $table->bigInteger("level")->nullable();
            $table->string("transaction_type")->nullable();
            $table->string("wallet_type")->nullable();
            $table->string("hex")->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
