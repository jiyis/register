<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateregistersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentID', 20);
            $table->string('name', 30);
            $table->string('province');
            $table->string('gender');
            $table->string('politics', 30);
            $table->string('stature', 5);
            $table->string('academy', 30);
            $table->string('profession', 30);
            $table->string('middleschool', 30);
            $table->string('telphone', 20);
            $table->string('postcode', 10);
            $table->string('address', 100);
            $table->text('family');
            $table->string('hobby', 50);
            $table->string('reward', 255);
            $table->string('personal', 100);
            $table->string('certificate', 100);
            $table->string('video', 100);
            $table->string('state');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registers');
    }
}
