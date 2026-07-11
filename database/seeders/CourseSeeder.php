<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'Driving School Certificate Enrollment',
                'slug' => Str::slug('Driving School Certificate Enrollment'),
                'type' => 'certification',
                'description' => 'Fast-track certification verification stream. Includes compulsory theory assessment modules required to validate driving competence.',
                'target_audience' => "For applicants who already know how to drive but require an official certificate to process their driver's licence.",
                'base_price' => 10000.00,
                'duration' => '25 Days',
                'pricing_tiers' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comprehensive Beginner Drivers Training Program',
                'slug' => Str::slug('Comprehensive Beginner Drivers Training Program'),
                'type' => 'training',
                'description' => 'Full-scale foundational driving instruction combining intensive 2-week practical road sessions with rigorous technical classroom theory. Includes official graduation certification processing.',
                'target_audience' => "For complete beginners who want to learn how to drive safely and obtain the certificate required for their driver's licence.",
                'base_price' => 70000.00,
                'duration' => '2 Weeks',
                'pricing_tiers' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}