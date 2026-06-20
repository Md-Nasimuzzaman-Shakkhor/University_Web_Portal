<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    // --- ADMIN: Show all applications from students ---
    public function adminViewApplications()
    {
        $applications = DB::table('research_applications')
            ->join('research_opportunities', 'research_applications.project_id', '=', 'research_opportunities.id')
            ->join('users', 'research_applications.student_id', '=', 'users.id')
            ->select(
                'research_applications.*', 
                'research_opportunities.title as project_name', 
                'users.name as student_name', 
                'users.email as student_email'
            )
            ->orderBy('applied_on', 'desc')
            ->get();

        return view('admin.research_management', compact('applications'));
    }

// --- ADMIN: Post a new Research Opportunity ---
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
    ]);

    DB::table('research_opportunities')->insert([
        'title' => $request->title,
        'description' => $request->description,
        'status' => 'open',
        'created_at' => now(),
        // Removed updated_at because it does not exist in your database table
    ]);

    return back()->with('success', 'Research project posted successfully!');
}

// --- ADMIN: Approve Student Interest ---
public function updateStatus($id)
{
    // Changed 'approved' to 'accepted' to match your SQL file
    DB::table('research_applications')
        ->where('id', $id)
        ->update(['application_status' => 'accepted']); 

    return back()->with('success', 'Application accepted successfully!');
}

    // --- STUDENT: View all available research projects ---
    public function studentViewProjects()
    {
        $projects = DB::table('research_opportunities')
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fixed the view name to match your screenshot
        return view('student.research', compact('projects'));
    }

    // --- STUDENT: Apply Logic ---
    public function apply(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login to apply.');
        }

        $exists = DB::table('research_applications')
            ->where('project_id', $id)
            ->where('student_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already expressed interest!');
        }

        DB::table('research_applications')->insert([
            'project_id' => $id,
            'student_id' => Auth::id(),
            'application_status' => 'pending',
            'applied_on' => now(),
        ]);

        return back()->with('success', 'Interest registered!');
    }
}