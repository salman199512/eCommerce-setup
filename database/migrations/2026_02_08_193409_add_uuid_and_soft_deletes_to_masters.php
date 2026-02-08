<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique();
            $table->softDeletes()->after('updated_at');
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique();
            $table->softDeletes()->after('updated_at');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique();
            // Note: Orders already has softDeletes from the previous migration I checked.
        });
    }

    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'deleted_at']);
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'deleted_at']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['uuid']);
        });
    }
};
