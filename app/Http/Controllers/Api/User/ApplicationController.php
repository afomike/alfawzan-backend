<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\DrivingSchoolRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $apps = DrivingSchoolRegistration::where('user_id', $request->user()->id)
            ->latest()->get();

        return response()->json(['data' => $apps]);
    }

    public function show(Request $request, $id)
    {
        $app = DrivingSchoolRegistration::where('user_id', $request->user()->id)
            ->findOrFail($id);

        if ($app->passport_photo) {
            $app->passport_url = Storage::disk('public')->url($app->passport_photo);
        }

        return response()->json(['data' => $app]);
    }

    public function update(Request $request, $id)
    {
        $app = DrivingSchoolRegistration::where('user_id', $request->user()->id)
            ->findOrFail($id);

        // Only allow updating if still pending
        if ($app->status !== 'pending') {
            return response()->json(['message' => 'Cannot edit an approved or rejected application.'], 422);
        }

        $data = $request->only([
            'first_name','surname','othername','mothers_maiden_name','email','phone',
            'date_of_birth','address','license_type','additional_info','gender',
            'blood_group','facial_mark','height','next_of_kin_phone','state_of_origin',
            'local_govt','nin_number','marital_status','requires_glasses',
            'has_disability','disability_details',
        ]);

        $app->update($data);

        return response()->json(['data' => $app, 'message' => 'Application updated.']);
    }

    public function uploadPassport(Request $request, $id)
    {
        $request->validate(['passport' => 'required|image|max:2048']);
        $app = DrivingSchoolRegistration::where('user_id', $request->user()->id)
            ->findOrFail($id);

        if ($app->passport_photo) {
            Storage::disk('public')->delete($app->passport_photo);
        }

        $path = $request->file('passport')->store('passports', 'public');
        $app->update(['passport_photo' => $path]);

        return response()->json([
            'message'      => 'Passport uploaded.',
            'passport_url' => Storage::disk('public')->url($path),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $app = DrivingSchoolRegistration::where('user_id', $request->user()->id)
            ->findOrFail($id);

        if ($app->status === 'approved') {
            return response()->json(['message' => 'Cannot delete an approved application.'], 422);
        }

        if ($app->passport_photo) {
            Storage::disk('public')->delete($app->passport_photo);
        }

        $app->delete();
        return response()->json(['message' => 'Application deleted.']);
    }
}
