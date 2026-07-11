<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driving_school_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('agent_link_id')->nullable()->constrained('agent_links')->onDelete('set null');

            $table->unsignedBigInteger('course_id');
            $table->string('selected_tier_key')->nullable();
            $table->decimal('final_amount', 10, 2);
            
            $table->string('first_name');
            $table->string('surname');
            $table->string('othername')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('date_of_birth');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('mothers_maiden_name');
            $table->string('blood_group');
            $table->string('height');
            $table->boolean('facial_mark')->default(false);
            $table->boolean('requires_glasses')->default(false);
            $table->boolean('has_disability')->default(false);
            $table->text('disability_details')->nullable();
            $table->string('state_of_origin');
            $table->string('local_govt');
            $table->string('address');
            $table->string('nin_number');
            $table->string('next_of_kin_phone');
            $table->string('license_type');
            $table->text('additional_info')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driving_school_registrations');
    }
};