<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    // --- ADMIN: Manage Resources ---
    public function adminIndex() 
    {
        // Fetch all materials and join with courses to show the course name
        $resources = DB::table('course_materials')
            ->join('courses', 'course_materials.course_id', '=', 'courses.id')
            ->select('course_materials.*', 'courses.title as course_name')
            ->get();

        $courses = Course::all(); // For the dropdown in the upload form
        
        return view('admin.manage_resources', compact('resources', 'courses'));
    }

    // --- STUDENT: Search Resources ---
    public function studentIndex() 
    {
        $resources = DB::table('course_materials')
            ->join('courses', 'course_materials.course_id', '=', 'courses.id')
            ->select('course_materials.*', 'courses.title as course_name')
            ->get();

        return view('student.resources', compact('resources'));
    }

    // --- ADMIN: Upload Logic ---
    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'file' => 'required|file|mimes:pdf,docx,jpg,png,zip|max:10240', // 10MB Limit
        ]);

        // Store file in 'storage/app/public/materials'
        $path = $request->file('file')->store('materials', 'public');

        DB::table('course_materials')->insert([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'file_path' => $path,
            'type' => $request->file('file')->getClientOriginalExtension(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Resource uploaded successfully!');
    }

    // --- ADMIN: Delete Logic ---
    public function destroy($id) 
    {
        $resource = DB::table('course_materials')->where('id', $id)->first();
        
        if ($resource) {
            // Remove physical file from storage
            Storage::disk('public')->delete($resource->file_path);
            // Remove database record
            DB::table('course_materials')->where('id', $id)->delete();
        }

        return back()->with('success', 'Resource deleted.');
    }
}