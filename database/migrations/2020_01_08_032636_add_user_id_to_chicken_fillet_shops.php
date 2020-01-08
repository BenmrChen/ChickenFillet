<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToChickenFilletShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chicken_fillet_shops', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->default(1)->comment('使用者ID');
            // 新增外鍵約束 如果user id:1 刪除 animal user_id = 1 也會全部刪除
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chicken_fillet_shops', function (Blueprint $table) {
            // 刪除外鍵約束 （這個表名_外鍵名_foreign）
            $table->dropForeign('chicken_fillet_shops_user_id_foreign');

            // 刪除user_id 欄位
            $table->dropColumn('user_id');
        });
    }
}
