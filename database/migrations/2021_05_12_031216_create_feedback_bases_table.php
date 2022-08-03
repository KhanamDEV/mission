<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mission_base_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('detail')->nullable();
            $table->integer('percent')->nullable();
            $table->string('hint_title')->nullable();
            $table->longText('hint_detail')->nullable();
            $table->text('thumbnail_url')->nullable();
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
        Schema::dropIfExists('feedback_bases');
    }
}
