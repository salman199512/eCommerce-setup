<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_best_seller')->default(0);
            $table->boolean('is_new_arrival')->default(0);
            $table->dateTime('deal_start_date')->nullable();
            $table->dateTime('deal_end_date')->nullable();
        });

        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('button_text')->nullable();
            $table->string('link')->nullable();
            $table->string('image_path')->nullable(); // Or use media library, but simple path for now
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('link')->nullable();
            $table->string('image_path')->nullable();
            $table->string('position')->default('main'); // main, grid_1, grid_2, footer
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'is_best_seller', 'is_new_arrival', 'deal_start_date', 'deal_end_date']);
        });
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('banners');
    }
};
