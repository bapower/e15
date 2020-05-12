<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->string('name');
            $table->string('slug');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('post_code');
            $table->string('phone_number');
            $table->string('url');
            $table->integer('rating');
            $table->integer('cost_rating');
            $table->string('tagline');
            $table->text('description');
            $table->string('image');
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
        Schema::dropIfExists('restaurants');
    }
}
