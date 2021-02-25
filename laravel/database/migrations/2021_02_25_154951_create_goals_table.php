<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('topic')->comment('Tiêu đề');
            $table->string('agenda')->nullable()->comment('agenda');
            $table->string('start_time')->comment('Ngày dự kiến bắt đầu');
            $table->string('end_time')->nullable()->comment('Ngày dự kiến kết thúc');
            $table->tinyInteger('priority')->nullable()->default(5)->comment('Độ ưu tiên');
            $table->bigInteger('user_id')->unsigned()->comment('thuộc về user id nào đó');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('goals');
    }
}
