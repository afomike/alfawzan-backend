<?php

namespace App\Http\Controllers\DrivingSchool;

use App\Http\Controllers\Controller;
use App\Models\DrivingSchoolRegistration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('driving-school.register');
    }

  
    public function show($id)
    {
        $registration = DrivingSchoolRegistration::find($id);

        if (!$registration) {
            return response()->json([
                'message' => 'Student registration record not found.'
            ], 404);
        }

        return response()->json([
            'data' => $registration
        ], 200);
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
            'passport' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $userId = auth()->id();

        $passportPath = null;
        if ($request->hasFile('passport')) {
            $passportPath = $request->file('passport')->store('passports', 'public');
        }

        $registration = DrivingSchoolRegistration::create([
            'user_id' => $userId,
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'othername' => $request->othername,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'license_type' => $validated['license_type'],
            'additional_info' => $validated['additional_info'],
            'status' => 'pending',
            'passport' => $passportPath,
        ]);

    
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Registration submitted successfully.',
                'data' => $registration
            ], 201);
        }

        return redirect()->route('driving-school.register')
            ->with('success', 'Registration submitted successfully. You can proceed to make payment.');
    }
}