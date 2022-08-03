<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_notifies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->json('option')->nullable();
            $table->longText('url')->nullable();
            $table->boolean('is_seen')->nullable()->default(0);
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
        Schema::dropIfExists('brand_notifies');
    }
}
