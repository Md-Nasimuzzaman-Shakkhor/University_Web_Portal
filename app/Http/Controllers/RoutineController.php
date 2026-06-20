<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Course;

class RoutineController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = Course::find($user->course_id);

        if (!$course) {
            return redirect()->back()->with('error', 'Enrollment record not found.');
        }

        // We use a more flexible key system here
        $routines = [
            'cse' => [
                'Monday' => ['09:00' => 'CSE-301: Data Structures [R:402, Dr. AK]', '11:00' => 'MAT-202: Discrete Math [R:102, Prof. RS]', '02:00' => 'CSE-301L: DS Lab [Lab: 02]'],
                'Tuesday' => ['09:00' => 'CSE-305: Algorithms [R:405, Dr. SM]', '11:00' => 'PHY-105: Physics II [R:105, Mr. JN]', '02:00' => 'CSE-305L: Algo Lab [Lab: 01]'],
                'Wednesday' => ['09:00' => 'CSE-401: Software Eng [R:202, Dr. LH]', '11:00' => 'CSE-302: Database Sys [R:301, Ms. FB]', '02:00' => 'Technical Seminar [Hall A]'],
                'Thursday' => ['09:00' => 'CSE-302L: DB Lab [Lab: 03]', '11:00' => 'CSE-201: Digital Logic [R:201]', '02:00' => 'Project: System Design'],
                'Friday' => ['09:30' => 'Ethics in IT [R:101]', '11:00' => 'Compiler Design [R:402]', '02:00' => 'Weekly Quiz'],
            ],
            'eee' => [
                'Monday' => ['09:00' => 'EEE-201: Circuit Theory [R:105]', '11:00' => 'MAT-205: Complex Variable', '02:00' => 'Circuit Lab I'],
                'Tuesday' => ['09:00' => 'EEE-302: Power Systems [R:205]', '11:00' => 'EEE-303: Electromagnetics', '02:00' => 'Machine Lab [Lab: 05]'],
            ],
            'ielts' => [
                'Monday' => ['09:00' => 'Academic Writing Task 1', '11:00' => 'Intensive Listening', '02:00' => 'Vocabulary Workshop'],
                'Tuesday' => ['09:00' => 'Speaking: Part 1 & 2 Focus', '11:00' => 'Reading: Skimming & Scanning', '02:00' => 'Full Mock Test 1'],
            ],
        ];

        // Determine which routine to show by checking keywords in the title
        $title = strtolower($course->title);
        $myRoutine = null;

        if (str_contains($title, 'computer') || str_contains($title, 'cse')) {
            $myRoutine = $routines['cse'];
        } elseif (str_contains($title, 'electrical') || str_contains($title, 'eee')) {
            $myRoutine = $routines['eee'];
        } elseif (str_contains($title, 'ielts')) {
            $myRoutine = $routines['ielts'];
        }

        return view('student.routine_view', compact('myRoutine', 'course'));
    }
}