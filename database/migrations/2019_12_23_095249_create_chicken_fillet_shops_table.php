<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChickenFilletShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chicken_fillet_shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('type_id')->comment('雞排分類');
            $table->string('name')->comment('雞排店名');
            $table->string('operation_time')->nullable()->comment('營業時間');
            $table->string('area')->nullable()->comment('店家所在地區');
            $table->boolean('chain_store')->default(false)->comment('是否為連鎖店');
            $table->text('feature')->nullable()->comment('店家特色');
            $table->text('phone_order')->nullable()->comment('可否電話訂餐/外送');
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
        Schema::dropIfExists('chicken_fillet_shops');
    }
}
