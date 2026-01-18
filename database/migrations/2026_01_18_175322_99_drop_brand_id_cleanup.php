<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('products', 'brand_id')) {
            Schema::table('products', function (Blueprint $table) {
                // Just drop the column, FK likely doesn't exist if previous migration failed early
                $table->dropColumn('brand_id');
            });
        }
    }

    public function down()
    {
    }
};
