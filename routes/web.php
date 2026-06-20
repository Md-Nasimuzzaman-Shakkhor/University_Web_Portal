<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentLifeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResearchController; // Research Controller
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Application;
use App\Models\Course;
use App\Http\Controllers\CertificateController;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- Root Route ---
Route::get('/', function () {
    return redirect('/login'); 
});

// --- Public Routes ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- Auth Protected Routes (Must be logged in) ---
Route::middleware('auth')->group(function () {

    // ==========================================
    // --- ADMIN ROUTES ---
    // ==========================================
    Route::get('/admin/dashboard', function() {
        
        // ⚡ TEMPORARY CLOUD DATABASE BOOTSTRAPPER ⚡
        // This will automatically run on Render to build your missing tables!
        try {
            Illuminate\Support\Facades\DB::unprepared("
            CREATE TABLE IF NOT EXISTS `courses` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `code` varchar(255) NOT NULL,
              `description` text DEFAULT NULL,
              `credits` int(11) NOT NULL DEFAULT 3,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `courses_code_unique` (`code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE IF NOT EXISTS `applications` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `user_id` bigint(20) unsigned NOT NULL,
              `course_id` bigint(20) unsigned NOT NULL,
              `status` varchar(255) NOT NULL DEFAULT 'pending',
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ");
        } catch (\Exception $e) {
            // Already created or skipped silently
        }

        // Standard Dashboard Data Queries
        $studentCount = User::where('role', 'student')->count();
        $courseCount = Course::count();
        $applicationCount = Application::count(); 
        
        $enrolledStudents = User::where('role', 'student')
                                ->whereNotNull('course_id')
                                ->with('course') 
                                ->get();

        return view('admin.dashboard', compact('studentCount', 'courseCount', 'applicationCount', 'enrolledStudents'));
    })->name('admin.dashboard');

    // Admin - Student Life
    Route::get('/admin/manage-student-life', [StudentLifeController::class, 'adminIndex'])->name('admin.student-life.index');
    Route::post('/admin/manage-student-life', [StudentLifeController::class, 'store'])->name('admin.student-life.store');

    // Admin - Application Management
    Route::get('/admin/applications', [CourseController::class, 'adminApplications'])->name('admin.applications');
    Route::post('/admin/applications/{id}/status', [CourseController::class, 'updateStatus'])->name('admin.applications.update');

    // Admin - Course Management (CRUD)
    Route::get('/admin/courses', [CourseController::class, 'adminIndex'])->name('admin.courses.index');
    Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('/admin/courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

    // Admin - Resource Management
    Route::get('/admin/resources', [ResourceController::class, 'adminIndex'])->name('admin.resources.index');
    Route::post('/admin/resources', [ResourceController::class, 'store'])->name('admin.resources.store');
    Route::delete('/admin/resources/{id}', [ResourceController::class, 'destroy'])->name('admin.resources.destroy');

    // --- RESEARCH ADMIN ROUTES ---
    Route::get('/admin/research-applications', [ResearchController::class, 'adminViewApplications'])->name('admin.research.index');
    Route::post('/admin/research/store', [ResearchController::class, 'store'])->name('admin.research.store');
    Route::post('/admin/research/status/{id}', [ResearchController::class, 'updateStatus'])->name('admin.research.updateStatus');

    // Route to save a new notice
    Route::post('/admin/notice/store', function(Request $request) {
        Notice::create($request->all());
        return back()->with('success', 'Notice posted successfully!');
    })->name('admin.notice.store');

    // Route to delete a notice
    Route::get('/admin/notice/delete/{id}', function($id) {
        Notice::findOrFail($id)->delete();
        return back()->with('success', 'Notice deleted!');
    })->name('admin.notice.delete');

    // ==========================================
    // --- STUDENT ROUTES ---
    // ==========================================
    Route::get('/student/dashboard', function() { 
        return view('student.dashboard'); 
    })->name('student.dashboard');
    
    // Student - Courses & Enrollment
    Route::get('/student/courses', [CourseController::class, 'index'])->name('student.courses');
    Route::post('/student/enroll/{id}', [CourseController::class, 'enroll'])->name('enroll');
    Route::post('/student/withdraw', [CourseController::class, 'withdraw'])->name('withdraw');
    
    // Student - Student Life
    Route::get('/student/student-life', [StudentLifeController::class, 'index'])->name('student.student-life');
    
    // Student - Admission Portal
    Route::get('/student/admission', [CourseController::class, 'showAdmission'])->name('admission.index');
    Route::post('/student/admission/apply', [CourseController::class, 'submitApplication'])->name('admission.submit');

    // Student - Resource View
    Route::get('/student/resources', [ResourceController::class, 'studentIndex'])->name('student.resources');

    // --- RESEARCH STUDENT ROUTES ---
    Route::get('/student/research', [ResearchController::class, 'studentViewProjects'])->name('student.research');
    Route::post('/research/apply/{id}', [ResearchController::class, 'apply'])->name('research.apply');
    
    // --- STUDENT ID CARD ROUTES ---
    Route::get('/student/generate-id', [StudentLifeController::class, 'showIdForm'])->name('student.id.form');
    Route::post('/student/generate-id', [StudentLifeController::class, 'generateIdCard'])->name('student.id.generate');
    
    // --- STUDENT CERTIFICATE ---
    Route::get('/student/certificate/download', [CertificateController::class, 'download'])
         ->name('student.certificate.download');

    // --- STUDENT COURSE ROUTINE ---
    Route::get('/student/routine', [App\Http\Controllers\RoutineController::class, 'index'])->name('student.routine');

}); // End of Auth Middleware Group

// 🚀 ONE-CLICK DEMO LOGIN ROUTE (Uses your exact phpMyAdmin SQL records!)
Route::get('/guest-login/{role}', function ($role) {
    // 1. Map 'admin' or 'student' to the exact emails inside your imported SQL file
    $email = ($role === 'admin') ? 'admin@test.com' : 'student@test.com';

    // 2. Find that exact user from your database
    $user = User::where('email', $email)->first();
    
    // 3. If they don't exist yet, build them using the correct credentials fallback
    if (!$user) {
        $user = User::create([
            'name' => ucfirst($role) . ' User',
            'email' => $email,
            'password' => bcrypt('password'),
            'role' => $role
        ]);
    }

    // 4. Authenticate the session
    Auth::login($user);

    // 5. Send them straight into their proper home dashboards
    return ($role === 'admin') ? redirect('/admin/dashboard') : redirect('/student/dashboard');
});