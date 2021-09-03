<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankColumnsToShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop', function (Blueprint $table) {
            $table->integer('ship_tax')->after('bg_img')->nullable();
            $table->string('card_number')->after('bg_img')->nullable();
            $table->string('bank_port')->after('bg_img')->nullable();
            $table->string('bank_name')->after('bg_img')->nullable();
            $table->string('manager_phone')->after('bg_img')->nullable();
            $table->enum('manager_gender', ['1', '0'])->after('bg_img')->nullable();
            $table->string('manager_name')->after('bg_img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop', function (Blueprint $table) {
            //
        });
    }
}
