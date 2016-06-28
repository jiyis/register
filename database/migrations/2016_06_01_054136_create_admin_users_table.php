<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users',function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->tinyInteger('is_super')->default(0)->comment('是否超级管理员');
            $table->rememberToken();
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
        Schema::drop('admin_users');
    }
}
