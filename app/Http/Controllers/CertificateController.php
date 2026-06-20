<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;

class CertificateController extends Controller
{
    public function download()
    {
        // Get the logged-in student with their course info
        $user = Auth::user();

        // Check if the student is actually enrolled in a course
        if (!$user->course_id) {
            return redirect()->back()->with('error', 'You are not enrolled in any course yet.');
        }

        // Load the course details from the relationship
        $course = $user->course; 

        $data = [
            'name' => $user->name,
            'course' => $course->title,
            'date' => date('d M, Y'),
        ];

        // Generate the PDF from a new blade file
        $pdf = Pdf::loadView('student.certificate_pdf', $data)
                  ->setPaper('a4', 'landscape');

        return $pdf->download($user->name . '_Certificate.pdf');
    }
}