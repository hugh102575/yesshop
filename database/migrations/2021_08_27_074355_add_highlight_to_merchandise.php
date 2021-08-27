<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHighlightToMerchandise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchandise', function (Blueprint $table) {
            //$table->string('highlight')->after('Product_Img')->nullable();
            $table->enum('highlight', ['1', '0'])->after('Product_Img')->default('0')->nullable();
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
