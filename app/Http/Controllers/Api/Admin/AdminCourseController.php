<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminCourseController extends Controller
{
    /**
     * Display a comprehensive course list for control panels.
     */
    public function index(): JsonResponse
    {
        // Admins view all courses (active or disabled) with structural metadata
        $courses = Course::latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $courses->items(),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page'    => $courses->lastPage(),
                'total'        => $courses->total(),
            ]
        ]);
    }

    /**
     * Add a fresh course configuration profile to database tables.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:courses,slug',
            'type'            => 'required|string|max:100',
            'description'     => 'nullable|string',
            'target_audience' => 'nullable|string|max:255',
            'base_price'      => 'required|numeric|min:0',
            'duration'        => 'required|string|max:100',
            'pricing_tiers'   => 'nullable|array',
            'is_active'       => 'boolean',
        ]);

        $course = Course::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course configuration registered successfully.',
            'data'    => $course
        ], 201);
    }

    /**
     * Get details for an exact course record.
     */
    public function show(Course $course): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $course
        ]);
    }

    /**
     * Modify target parameters on an existing course structural layout.
     */
    public function update(Request $request, Course $course): JsonResponse
    {
        $validated = $request->validate([
            'title'           => 'sometimes|required|string|max:255',
            'slug'            => 'sometimes|required|string|max:255|unique:courses,slug,' . $course->id,
            'type'            => 'sometimes|required|string|max:100',
            'description'     => 'nullable|string',
            'target_audience' => 'nullable|string|max:255',
            'base_price'      => 'sometimes|required|numeric|min:0',
            'duration'        => 'sometimes|required|string|max:100',
            'pricing_tiers'   => 'nullable|array',
            'is_active'       => 'boolean',
        ]);

        $course->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course information updated successfully.',
            'data'    => $course
        ]);
    }

    /**
     * Delete a course structure safely.
     */
    public function destroy(Course $course): JsonResponse
    {
        // Business restriction: Prevent deletion if any user registries are linked
        if ($course->registrations()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete course. Existing student application profiles are linked to this record.'
            ], 422);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course successfully purged from database files.'
        ]);
    }
}