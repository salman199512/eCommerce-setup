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
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question_gujarati')->nullable();
            $table->text('question_english')->nullable();
            $table->text('question_hindi')->nullable();
            $table->longText('answer_gujarati')->nullable();
            $table->longText('answer_english')->nullable();
            $table->longText('answer_hindi')->nullable();
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
        Schema::drop('faqs');
    }
};
