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
        Schema::table('driving_school_registrations', function (Blueprint $table) {
            // Adds the nullable passport_photo column to hold the file path string
            $table->string('passport_photo')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driving_school_registrations', function (Blueprint $table) {
            $table->dropColumn('passport_photo');
        });
    }
};