<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLottoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('info', 50)->nullable()->default('');
        });
        Schema::create('lotto_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main', 50);
            $table->string('other', 200)->nullable()->default('');
            $table->integer('lotto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotto');
    }
}
