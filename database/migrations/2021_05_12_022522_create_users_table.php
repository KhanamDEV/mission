<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('detail')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('brand_id')->nullable();
            $table->boolean('is_admin')->default(0)->comment('0 is not admin, 1 is admin')->nullable();
            $table->json('push_notification_token')->nullable();
            $table->string('name_sei')->nullable();
            $table->string('name_mei')->nullable();
            $table->string('name_sei_kana')->nullable();
            $table->string('name_mei_kana')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('department')->nullable();
            $table->longText('plan')->nullable();
            $table->string('employment_status')->nullable();
            $table->boolean('is_active')->default(1)->comment('0 is not active, 1 is active')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
