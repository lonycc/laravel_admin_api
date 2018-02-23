<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id');
            $table->integer('create_user');
            $table->integer('update_user')->nullable();
            $table->string('title', 100);
            $table->string('description', 200)->nullable();
            $table->text('content', 100)->nullable();
            $table->string('keywords', 50)->nullable();
            $table->integer('hits')->nullable()->default(0);
            $table->boolean('hot')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(true);
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
        Schema::dropIfExists('news');
    }
}
