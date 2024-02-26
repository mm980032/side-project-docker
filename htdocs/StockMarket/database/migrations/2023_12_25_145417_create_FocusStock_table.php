<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FocusStock', function (Blueprint $table) {
            $table->increments('id')->comment('流水號');
            $table->char('focusID', 32)->comment('關注ID');
            $table->char('method', 32)->comment('推播類型');
            $table->char('stockCode', 32)->comment('股票代碼');
            $table->char('name', 32)->comment('股票名稱');
            $table->dateTime('createdAt')->useCurrent()->comment('建立時間(MySQL)');
            $table->dateTime('updatedAt')->useCurrent()->comment('更新時間(MySQL)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FocusStock');
    }
};
