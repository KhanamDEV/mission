<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionQuestionAnswerBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_question_answer_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mission_base_id')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('choice')->nullable();
            $table->integer('delivery_order_number')->nullable();
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
        Schema::dropIfExists('mission_question_answer_bases');
    }
}
