<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('detail')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->boolean('is_target')->default(0)->comment('0 is not target, 1 is target');
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
        Schema::dropIfExists('mission_bases');
    }
}
