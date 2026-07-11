<?php

namespace App\Http\Controllers\Api\DrivingSchool;

use App\Http\Controllers\Controller;
use App\Models\DrivingSchoolRegistration;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller 
{
    public function index()
    {
        $user = auth('sanctum')->user();

        $courses = Course::all()->map(function ($course) use ($user) {
            $alreadyEnrolled = false;

            if ($user) {
                $alreadyEnrolled = DrivingSchoolRegistration::where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->exists();
            }

            $course->already_enrolled = $alreadyEnrolled;
            return $course;
        });

        return response()->json([
            'data' => $courses
        ]);
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'surname' => 'nullable|string|max:255',
        'othername' => 'nullable|string|max:255',
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'date_of_birth' => 'required|date',
        'address' => 'required|string',
        'license_type' => 'required|string',
        'additional_info' => 'nullable|string',
        'passport_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'agent_token' => 'nullable|string',
        'course_id' => 'required|integer',
        'final_amount' => 'required|numeric',
        'selected_tier_key' => 'nullable|string',
        'gender' => 'required|string',
        'marital_status' => 'required|string',
        'mothers_maiden_name' => 'required|string|max:255',
        'blood_group' => 'required|string',
        'height' => 'required|string',
        'facial_mark' => 'required|boolean',
        'requires_glasses' => 'required|boolean',
        'has_disability' => 'required|boolean',
        'disability_details' => 'nullable|string',
        'nin_number' => 'required|string|size:11',
        'next_of_kin_phone' => 'required|string',
        'state_of_origin' => 'required|string',
        'local_govt' => 'required|string',
    ]);

    $userId = auth()->id();

    $passportPath = null;
    if ($request->hasFile('passport_photo')) {
        $passportPath = $request->file('passport_photo')->store('passports', 'public');
    }

    $agentLinkId = null;
    if ($request->filled('agent_token')) {
        $agentLink = \App\Models\AgentLink::where('unique_link', $request->agent_token)
            ->where('is_active', true)
            ->first();

        if ($agentLink) {
            $agentLinkId = $agentLink->id;
        }
    }

    $registration = DrivingSchoolRegistration::create([
        'user_id' => $userId,
        'course_id' => $validated['course_id'],
        'agent_link_id' => $agentLinkId,
        'selected_tier_key' => $validated['selected_tier_key'],
        'final_amount' => $validated['final_amount'],
        'first_name' => $request->first_name,
        'surname' => $request->surname,
        'othername' => $request->othername,
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'date_of_birth' => $validated['date_of_birth'],
        'gender' => $validated['gender'],
        'marital_status' => $validated['marital_status'],
        'mothers_maiden_name' => $validated['mothers_maiden_name'],
        'blood_group' => $validated['blood_group'],
        'height' => $validated['height'],
        'facial_mark' => $validated['facial_mark'],
        'requires_glasses' => $validated['requires_glasses'],
        'has_disability' => $validated['has_disability'],
        'disability_details' => $validated['disability_details'],
        'state_of_origin' => $validated['state_of_origin'],
        'local_govt' => $validated['local_govt'],
        'address' => $validated['address'],
        'nin_number' => $validated['nin_number'],
        'next_of_kin_phone' => $validated['next_of_kin_phone'],
        'license_type' => $validated['license_type'],
        'additional_info' => $validated['additional_info'],
        'status' => 'pending',
        'passport_photo' => $passportPath,
    ]);

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'message' => 'Registration submitted successfully.',
            'data' => $registration
        ], 201);
    }

    return redirect()->route('driving-school.register')
        ->with('success', 'Registration submitted successfully.');
}

    public function show($id)
    {
        $reg = DrivingSchoolRegistration::findOrFail($id);

        $reg->append('passport_url');

        return response()->json([
            'data' => $reg
        ]);
    }
}