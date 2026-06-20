<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentLife;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
class StudentLifeController extends Controller
{
    // For Students: View all Student Life activities
    public function index() {
        $activities = StudentLife::latest()->get();
        return view('student.student_life', compact('activities'));
    }

    // For Admins: Show the list to manage
    public function adminIndex() {
        $activities = StudentLife::all();
        return view('admin.manage_student_life', compact('activities'));
    }

    // For Admins: Store a new activity
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        StudentLife::create($request->all());
        return redirect()->back()->with('success', 'New Student Life activity added!');
    }
    public function showIdForm() {
    $user = Auth::user();
    $course = Course::find($user->course_id);
    return view('student.id_form', compact('user', 'course'));
    }

    public function generateIdCard(Request $request) {
    // 1. Check if data is arriving
    // dd($request->all()); 

    $request->validate([
        'blood_group' => 'required',
        'emergency_contact' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();
    $course = \App\Models\Course::find($user->course_id);
    
    // 2. Check if file is being captured
    if (!$request->hasFile('photo')) {
        return back()->withErrors(['photo' => 'Photo was not uploaded correctly.']);
    }

    $image = $request->file('photo');
    $base64 = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode(file_get_contents($image));

    $data = [
        'name' => $user->name,
        'id' => $user->id,
        'email' => $user->email,
        'course' => $course->title ?? 'N/A',
        'blood_group' => $request->blood_group,
        'emergency_contact' => $request->emergency_contact,
        'photo' => $base64
    ];

    $pdf = Pdf::loadView('student.id_card_pdf', $data);
    
    // IMPORTANT: Try 'stream' instead of 'download' for testing
    // This will open the PDF in the browser instead of forcing a download
    return $pdf->stream('Student_ID.pdf');
}
}