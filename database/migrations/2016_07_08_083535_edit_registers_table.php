<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registers', function (Blueprint $table) {
            $table->dropColumn('politics');
            $table->dropColumn('profession');
            $table->dropColumn('video');

            $table->text('reward')->change();

            $table->text('reason')->after('family');
            $table->string('email',50)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registers', function($table) {
            $table->string('politics', 30);
            $table->string('profession', 30);
            $table->string('video', 100);

            $table->string('reward', 255)->change();

            $table->dropColumn('reason');
            $table->dropColumn('email');

        });
    }
}
