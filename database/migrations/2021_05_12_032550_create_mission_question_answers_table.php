<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_question_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('mission_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('choice')->nullable();
            $table->longText('answer')->nullable();
            $table->boolean('is_anonymous')->nullable();
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
        Schema::dropIfExists('mission_question_answers');
    }
}
