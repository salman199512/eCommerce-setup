<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['categories', 'sub_categories', 'brands', 'products'];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (!Schema::hasColumn($tableName, 'slug')) {
                        $table->string('slug')->nullable()->after('id');
                    }
                    if (!Schema::hasColumn($tableName, 'meta_title')) {
                        $table->string('meta_title')->nullable();
                    }
                    if (!Schema::hasColumn($tableName, 'meta_description')) {
                        $table->text('meta_description')->nullable();
                    }
                    if (!Schema::hasColumn($tableName, 'meta_keywords')) {
                        $table->text('meta_keywords')->nullable();
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['categories', 'sub_categories', 'brands', 'products'];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn(['slug', 'meta_title', 'meta_description', 'meta_keywords']);
                });
            }
        }
    }
};
