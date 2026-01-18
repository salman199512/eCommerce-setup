<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('websites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('heading')->nullable();
            $table->text('sub_heading')->nullable();
            $table->text('type')->nullable();
            $table->longText('description')->nullable();
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('websites');
    }
};
