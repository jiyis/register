<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('register_status')->default(0)->comment('0：关闭报名 1：开启报名');
            $table->tinyInteger('review_status')->default(1)->comment('0：关闭初审 1：开始初审');
            $table->timestamps();
        });
        DB::table('systems')->insert([
                'register_status' => '1',
                'review_status' => '1',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('systems');
    }
}
