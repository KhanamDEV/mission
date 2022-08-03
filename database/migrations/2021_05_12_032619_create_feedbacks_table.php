<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mission_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('detail')->nullable();
            $table->float('percent')->nullable()->default(0);
            $table->string('hint_title')->nullable();
            $table->longText('hint_detail')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->dateTime('user_look_at')->nullable()->default(null);
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
        Schema::dropIfExists('feedbacks');
    }
}
