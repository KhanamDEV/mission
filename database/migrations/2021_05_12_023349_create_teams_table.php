<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('detail')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->date('program_started_at')->default(date('Y/m/d H:i:s', strtotime('2021/01/01')));
            $table->integer('last_delivery_mission_number')->nullable();
            $table->boolean('is_active')->default(1)->comment('0 is not active, 1 is active');
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
        Schema::dropIfExists('teams');
    }
}
