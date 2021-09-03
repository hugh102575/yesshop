<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOthersimgToMerchandise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchandise', function (Blueprint $table) {
            $table->string('Product_Img_others_1')->after('Product_Img')->nullable();
            $table->string('Product_Img_others_2')->after('Product_Img_others_1')->nullable();
            $table->string('Product_Img_others_3')->after('Product_Img_others_2')->nullable();
            $table->string('Product_Img_others_4')->after('Product_Img_others_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchandise', function (Blueprint $table) {
            //
        });
    }
}
