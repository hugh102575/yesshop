<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            //$table->id();
            //$table->timestamps();

            $table->bigIncrements('id');
            $table->unsignedBigInteger('Shop_id');
            $table->string('Product_Name');
            $table->string('Product_Category')->nullable();
            //$table->enum('Product_forSale', ['1', '0'])->default('1');
            $table->integer('Product_Price')->nullable();
            $table->string('Product_Model')->nullable();
            $table->string('Product_Img')->nullable();
            //$table->integer('Product_Cost')->nullable();
            //$table->string('Product_Bar')->nullable();
            //$table->enum('Stock_Track', ['1', '0'])->default('0')->nullable();
            //$table->integer('Stock_Amount')->nullable();
            //$table->integer('Stock_Lowalert')->nullable();
            //$table->integer('Pos_Color')->nullable();
            //$table->string('Pos_Shape')->nullable();
            $table->string('create_from');
            $table->string('update_from')->nullable();
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
        Schema::dropIfExists('merchandise');
    }
}
