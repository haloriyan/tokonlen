<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderan', function (Blueprint $table) {
            $table->bigIncrements('idorder');
            $table->integer('user_id');
            $table->integer('total');
            $table->date('tanggal');
            $table->integer('status');
            $table->string('resi');
            $table->string('bukti');
            $table->string('shipping');
            $table->integer('shipping_price');
            $table->integer('review_status');
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
        Schema::dropIfExists('orderan');
    }
}
