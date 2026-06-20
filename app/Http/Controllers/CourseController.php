<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Application;
use App\Models\User; // Added this to make it cleaner
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // --- STUDENT SIDE ---
    
    // 1. Show all available courses
    public function index() {
        $courses = Course::all();
        return view('student.courses', compact('courses'));
    }

    // 2. Process Enrollment (Moved this to its own section)
    public function enroll($id) {
        $user = User::find(Auth::id()); 
        
        if($user) {
            $user->course_id = $id;
            $user->save();
            return redirect('/student/dashboard')->with('success', 'Successfully enrolled in the course!');
        }
        return redirect()->back()->with('error', 'Enrollment failed. User not found.');
    }

    // 3. Show Admission Portal
    public function showAdmission() {
        $departments = Course::all();
        return view('student.admission', compact('departments'));
    }

    // 4. Submit Admission Form
    public function submitApplication(Request $request) {
        $request->validate([
            'course_id' => 'required',
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'ssc_result' => 'required',
            'hsc_result' => 'required',
        ]);

        Application::create([
            'course_id' => $request->course_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'ssc_result' => $request->ssc_result,
            'hsc_result' => $request->hsc_result,
            'status' => 'pending'
        ]);

        return redirect('/student/dashboard')->with('success', 'Application submitted!');
    }

    // --- ADMIN SIDE: COURSE MANAGEMENT ---

    public function adminIndex() {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create() {
        return view('admin.courses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        Course::create($request->all());
        return redirect('/admin/courses')->with('success', 'Department added successfully!');
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id) {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect('/admin/courses')->with('success', 'Department updated!');
    }

    public function destroy($id) {
        Course::find($id)->delete();
        return redirect('/admin/courses')->with('success', 'Department deleted!');
    }

    // --- ADMIN SIDE: APPLICATIONS ---
    public function adminApplications() {
        $applications = Application::with('course')->latest()->get();
        return view('admin.applications', compact('applications'));
    }

    public function updateStatus(Request $request, $id) {
        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();
        return redirect()->back()->with('success', 'Status updated!');
    }

    // Add this to CourseController.php

public function withdraw() {
    $user = User::find(Auth::id());

    if($user) {
        $user->course_id = null; // Remove the course link
        $user->save();

        return redirect('/student/dashboard')->with('success', 'You have successfully withdrawn from the course.');
    }

    return redirect()->back()->with('error', 'Action failed.');
}

}