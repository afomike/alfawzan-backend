<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\DrivingSchoolRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = DrivingSchoolRegistration::with('user')
            ->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', "%{$request->search}%")
                  ->orWhere('first_name', 'like', "%{$request->search}%")
                  ->orWhere('surname', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%")
                  ->orWhere('nin_number', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $students = $query->paginate(20);
        return response()->json(['data' => $students->items(), 'meta' => [
            'current_page' => $students->currentPage(),
            'last_page'    => $students->lastPage(),
            'total'        => $students->total(),
        ]]);
    }

    public function show($id)
    {
        $student = DrivingSchoolRegistration::with('user')->findOrFail($id);
        if ($student->passport_photo) {
            $student->passport_url = Storage::url($student->passport_photo);
        }
        return response()->json(['data' => $student]);
    }

    public function update(Request $request, $id)
    {
        $student = DrivingSchoolRegistration::findOrFail($id);
        $data = $request->only([
            'full_name','first_name','surname','othername','mothers_maiden_name',
            'email','phone','date_of_birth','address','license_type','additional_info',
            'status','gender','blood_group','facial_mark','height','next_of_kin_phone',
            'state_of_origin','local_govt','nin_number','marital_status',
            'requires_glasses','has_disability','disability_details',
        ]);
        $student->update($data);
        return response()->json(['data' => $student, 'message' => 'Student updated successfully.']);
    }

    public function destroy($id)
    {
        $student = DrivingSchoolRegistration::findOrFail($id);
        if ($student->passport_photo) {
            Storage::delete($student->passport_photo);
        }
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully.']);
    }

    public function uploadPassport(Request $request, $id)
    {
        $request->validate(['passport' => 'required|image|max:2048']);
        $student = DrivingSchoolRegistration::findOrFail($id);

        if ($student->passport_photo) {
            Storage::delete($student->passport_photo);
        }

        $path = $request->file('passport')->store('passports', 'public');
        $student->update(['passport_photo' => $path]);

        return response()->json([
            'message'      => 'Passport uploaded successfully.',
            'passport_url' => Storage::url($path),
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $student = DrivingSchoolRegistration::findOrFail($id);
        $student->update(['status' => $request->status]);
        return response()->json(['message' => 'Status updated.', 'data' => $student]);
    }
}
