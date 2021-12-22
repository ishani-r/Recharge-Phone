<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('education');
            $table->string('work');
            $table->string('employer');
            $table->string('about_me');
            $table->string('height');
            $table->string('speaks');
            $table->string('cast');
            $table->string('smoking');
            $table->string('drinks');
            $table->string('food');
            $table->string('marray_age');
            $table->string('dressing');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('status');
            $table->string('slug');
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
        Schema::dropIfExists('user_details');
    }
}