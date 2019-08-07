<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailySignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_signs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('userid');
            $table->text('name')->nullable();
            $table->text('platform');
            $table->date('date');
            $table->time('time');
            $table->integer('rank')->nullable();
            $table->text('avatar')->nullable();
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
        Schema::dropIfExists('daily_signs');
    }
}
