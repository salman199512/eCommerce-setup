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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('content');
            $table->boolean('status')->default(true);
            $table->uuid('uuid')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->longText('logistics_care')->nullable()->after('description');
            $table->boolean('is_tax_included')->default(true)->after('returned_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['logistics_care', 'is_tax_included']);
        });
    }
};
