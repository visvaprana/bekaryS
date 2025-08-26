<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_images', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('menu_home_image')->nullable();
            $table->string('reserv_home_image')->nullable();
            $table->string('gallery_home_image')->nullable();
            $table->string('reserv_banner_home_image')->nullable();
            $table->string('contact_banner_home_image')->nullable();
            $table->string('reserv_profile_home_image')->nullable();
            $table->string('menu_banner')->nullable();
            $table->string('shop_banner')->nullable();
            $table->string('gallery_banner')->nullable();
            $table->string('facility_banner')->nullable();
            $table->string('blog_banner')->nullable();
            $table->string('contact_banner')->nullable();
            $table->string('my_account_banner')->nullable();
            $table->string('login_banner')->nullable();
            $table->string('registration_banner')->nullable();
            $table->string('cart_banner')->nullable();
            $table->string('checkout_banner')->nullable();
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
        Schema::dropIfExists('site_images');
    }
}
