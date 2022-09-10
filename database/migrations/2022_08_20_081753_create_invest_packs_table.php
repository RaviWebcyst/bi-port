<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_packs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("min")->nullable();
            $table->bigInteger("max")->nullable();
            $table->string("roi")->nullable();
            $table->string("roi_days")->nullable();
            $table->bigInteger("direct")->nullable();
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
        Schema::dropIfExists('invest_packs');
    }
}
