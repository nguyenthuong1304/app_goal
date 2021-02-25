<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusProgressToGoals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->boolean('status')->nullanle()->default(false);
            $table->tinyInteger('progress')->nullanle()->default(0);
            $table->boolean('remind_update')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('progress');
            $table->dropColumn('remind_update');
        });
    }
}
