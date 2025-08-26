<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResturantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resturants', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('area_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('discount')->nullable();
            $table->string('address')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('delivery_hours')->nullable();
            $table->string('open_closed')->nullable();
            $table->string('image')->nullable();
            $table->string('cover_image')->nullable();
            $table->longtext('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_des')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('resturants');
    }
}
