<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('target_user_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('mission_base_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('detail')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->date('delivery_order_date')->nullable();
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
        Schema::dropIfExists('missions');
    }
}
