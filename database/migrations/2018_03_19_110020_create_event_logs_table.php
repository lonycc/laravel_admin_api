<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user_id')->comment('操作人的ID');
            $table->string('user_name')->comment('操作人的名字，方便直接查阅');
            $table->string('url')->comment('当前操作的URL');
            $table->string('method')->comment('当前操作的请求方法');
            $table->string('event')->comment('当前操作的事件，create,update,delete');
            $table->string('table')->comment('操作的表');
            $table->string('description')->default('');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `event_logs` comment '事件日志表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
}
