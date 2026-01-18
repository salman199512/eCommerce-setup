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
    public function up()
    {



        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn([
                'question_gujarati',
                'question_hindi',
                'answer_gujarati',
                'answer_hindi',
                ]);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {



    }
};
