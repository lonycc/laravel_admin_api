<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdminPermissionsAddNamespaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('admin_permissions', function (Blueprint $table) {
		    $table->string('namespace', 100)->nullable()->default("");
		    $table->string('controller', 100)->nullable()->default("");
		    $table->string('action', 100)->nullable()->default("");
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
