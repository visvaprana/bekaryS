<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinfos', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->text('subscribe_title')->nullable();
            $table->text('opening_hours')->nullable();
            $table->text('resturant_close')->nullable();
            $table->text('location_api')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('tax')->nullable();
            $table->integer('happy_cutomers')->nullable();
            $table->integer('completed_projects')->nullable();
            $table->longtext('google_anlytics_code')->nullable();
            $table->longtext('robots_txt')->nullable();
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
        Schema::dropIfExists('siteinfos');
    }
}
