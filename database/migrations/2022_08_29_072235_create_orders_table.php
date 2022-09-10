<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->id();
          $table->integer("user_id");
          $table->float("amount");
          $table->string("payment_id");
          $table->string("wallet")->nullable();
          $table->string("payment_status")->nullable();
          $table->boolean("status")->default(0);
          $table->string("wallet_status")->nullable();
          $table->string("status_url")->nullable();
          $table->string("address")->nullable();
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
        Schema::dropIfExists('orders');
    }
}
