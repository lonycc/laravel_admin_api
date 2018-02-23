<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('realname', 10)->nullable()->default('');
            $table->string('password', 100)->nullable()->default('');
            $table->enum('flag', ['域用户', '其他用户'])->nullable()->default('其他用户');
            $table->boolean('check_ip')->nullable()->default(false);
            $table->string('ip', 100)->nullable()->default('0.0.0.0');
            $table->integer('create_user')->nullable()->default(0);
            $table->integer('update_user')->nullable()->default(0);
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
        Schema::dropIfExists('clients');
    }
}
