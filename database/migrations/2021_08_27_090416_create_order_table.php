<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Shop_id');
            $table->unsignedBigInteger('Member_id');
            $table->longText('order_content');
            $table->string('order_name');
            $table->string('order_address');
            $table->string('order_phone');
            $table->string('order_email')->nullable();
            $table->string('order_memo')->nullable();
            $table->unsignedBigInteger('order_price');
            $table->enum('shipped_status', ['1', '0'])->default('0')->nullable();
            $table->enum('finished_status', ['1', '0'])->default('0')->nullable();
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
