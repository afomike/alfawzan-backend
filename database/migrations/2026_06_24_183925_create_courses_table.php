<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type'); // 'certification', 'training', 'licence_processing'
            $table->text('description');
            $table->text('target_audience'); // Explains exactly who it's for
            $table->decimal('base_price', 10, 2)->default(0.00); 
            $table->string('duration')->nullable();
            $table->json('pricing_tiers')->nullable(); // For options like 3-year vs 5-year NDL options
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        if (Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->foreignId('course_id')->nullable()->after('user_id');
                $table->string('selected_tier_key')->nullable()->after('course_id'); // e.g., '3_years' or '5_years'
                $table->decimal('final_amount', 10, 2)->nullable()->after('selected_tier_key');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
        
        if (Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->dropColumn(['course_id', 'selected_tier_key', 'final_amount']);
            });
        }
    }
};