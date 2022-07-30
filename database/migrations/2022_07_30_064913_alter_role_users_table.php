<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('role_id')->nullable()->unsigned()->after('id');
            $table->string('username')->nullable()->after('name');
            $table->string('short_name')->nullable()->after('username');
            $table->string('nik')->nullable()->after('short_name');
            $table->string('phone')->nullable()->after('nik');
            $table->string('company_name')->nullable()->after('phone');
            $table->string('photo')->nullable()->after('company_name');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
