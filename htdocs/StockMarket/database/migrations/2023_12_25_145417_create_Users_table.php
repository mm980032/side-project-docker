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
        Schema::create('Users', function (Blueprint $table) {
            $table->integer('id', true)->comment('流水號');
            $table->char('userID', 32)->comment('用戶ID');
            $table->char('account', 32)->comment('帳號');
            $table->char('paaword', 32)->comment('密碼');
            $table->char('email', 40)->comment('信箱');
            $table->integer('toggle')->default(1)->comment('啟用狀態');
            $table->integer('errorCount')->default(0)->comment('登入錯誤次數');
            $table->char('googleAuthCode', 128)->comment('GoogelAuthCode');
            $table->char('googleAuthQrcodeUrl', 128)->comment('GoogelQRCodeUrl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Users');
    }
};
