@extends('layouts.student')

@section('title', 'Dashboard | Student Portal')

@section('content')
    <style>
        .greeting-card { background: linear-gradient(135deg, #001529 0%, #002147 100%); padding: 40px; border-radius: 20px; color: white; position: relative; overflow: hidden; margin-bottom: 20px; box-shadow: 0 10px 30px rgba(0,33,71,0.2); }
        
        .routine-highlight { background: linear-gradient(90deg, #1890ff 0%, #0050b3 100%); padding: 20px 30px; border-radius: 16px; color: white; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 8px 20px rgba(24, 144, 255, 0.2); }
        .routine-btn { background: white; color: #0050b3; padding: 12px 25px; border-radius: 10px; text-decoration: none; font-weight: 800; font-size: 14px; transition: 0.3s; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .routine-btn:hover { background: #f0f5ff; transform: scale(1.05); color: #0050b3; }

        .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 16px; border: 1px solid #edf2f7; text-align: center; }
        .dashboard-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
        .activity-item { position: relative; padding-left: 30px; border-left: 2px solid #eef2f6; margin-bottom: 20px; }
        .activity-item::before { content: ''; position: absolute; left: -7px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: var(--primary); }
        
        .btn-certificate { background: #52c41a; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 13px; box-shadow: 0 4px 10px rgba(82, 196, 26, 0.3); transition: 0.3s; }
        .btn-certificate:hover { background: #389e0d; color: white; transform: translateY(-2px); }

        /* Classy Notice Board Scroll styling */
        .notice-feed::-webkit-scrollbar { width: 4px; }
        .notice-feed::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .notice-badge { font-size: 10px; padding: 3px 12px; border-radius: 50px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; margin-bottom: 8px; }
    </style>

    <div class="greeting-card animate__animated animate__fadeIn">
        <h1 style="font-weight: 800;">Hi, {{ Auth::user()->name }}! 👋</h1>
        <p>Welcome back to your academic command center. Here is what's happening today.</p>
        <i class="fa-solid fa-graduation-cap" style="position: absolute; right: 20px; bottom: -10px; font-size: 120px; opacity: 0.1;"></i>
    </div>

    @php
        $researchApps = \DB::table('research_applications')
            ->join('research_opportunities', 'research_applications.project_id', '=', 'research_opportunities.id')
            ->where('student_id', Auth::id())
            ->select('research_applications.*', 'research_opportunities.title')
            ->get();
        $course = \App\Models\Course::find(Auth::user()->course_id);
        $materialsCount = \DB::table('course_materials')->where('course_id', Auth::user()->course_id)->count();
    @endphp

    @if(Auth::user()->course_id)
    <div class="routine-highlight animate__animated animate__pulse">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="background: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-clock-rotate-left" style="font-size: 28px;"></i>
            </div>
            <div>
                <h4 style="margin: 0; font-weight: 800; letter-spacing: 0.5px;">YOUR DAILY SCHEDULE</h4>
                <p style="margin: 0; opacity: 0.9; font-size: 13px;">Check your upcoming classes for {{ $course->title }}</p>
            </div>
        </div>
        <a href="{{ route('student.routine') }}" class="routine-btn">
            <i class="fa-solid fa-calendar-day me-2"></i> VIEW ROUTINE
        </a>
    </div>
    @endif

    <div class="stat-grid animate__animated animate__fadeInUp">
        <div class="stat-card">
            <i class="fa-solid fa-flask-vial text-primary" style="font-size: 24px; margin-bottom: 10px;"></i>
            <h2 style="font-weight: 800;">{{ $researchApps->count() }}</h2>
            <p class="text-muted small">Research Apps</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-file-lines" style="color: var(--success); font-size: 24px; margin-bottom: 10px;"></i>
            <h2 style="font-weight: 800;">{{ $materialsCount }}</h2>
            <p class="text-muted small">Resources Available</p>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-user-check" style="color: #fa8c16; font-size: 24px; margin-bottom: 10px;"></i>
            <h2 style="font-weight: 800;">Active</h2>
            <p class="text-muted small">Portal Status</p>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="left-column">
            <div class="glass-card animate__animated animate__fadeInLeft" style="background: #fffbe6; border-left: 4px solid #faad14; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0; font-size: 16px; color: #873800;"><i class="fa-solid fa-id-card me-2"></i> Official Documents</h3>
                        <p style="font-size: 12px; color: #d48806; margin-top: 5px;">Download your ID and Course Certificates.</p>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('student.id.form') }}" class="btn" style="background: #faad14; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 13px; box-shadow: 0 4px 10px rgba(250, 173, 20, 0.3);">ID Card</a>
                        
                        @if(Auth::user()->course_id)
                            <a href="{{ route('student.certificate.download') }}" class="btn-certificate">
                                <i class="fa-solid fa-certificate me-1"></i> Certificate
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="glass-card animate__animated animate__fadeInLeft">
                <h3 style="margin-bottom: 20px; font-size: 18px;"><i class="fa-solid fa-satellite-dish me-2 text-primary"></i> Research Status Tracker</h3>
                @forelse($researchApps as $app)
                    <div class="activity-item">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <h4 style="font-size: 14px; font-weight: 700;">{{ $app->title }}</h4>
                                <p class="text-muted small">Applied: {{ date('M d, Y', strtotime($app->applied_on)) }}</p>
                            </div>
                            <span class="status-pill" style="background: {{ $app->application_status == 'accepted' ? '#f6ffed' : '#fff7e6' }}; color: {{ $app->application_status == 'accepted' ? '#52c41a' : '#fa8c16' }};">
                                {{ strtoupper($app->application_status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-muted small">No active applications.</p>
                        <a href="{{ url('/student/research') }}" style="color: var(--primary); font-size: 12px; font-weight: 600; text-decoration: none;">Apply for a Project &rarr;</a>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="right-column">
            <div class="glass-card animate__animated animate__fadeInRight" style="margin-bottom: 20px;">
                <h3 style="margin-bottom: 15px; font-size: 18px;"><i class="fa-solid fa-book me-2 text-success"></i> Enrolled In</h3>
                <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 4px solid var(--success);">
                    <h4 style="font-weight: 800; color: var(--dark-navy); font-size: 15px; margin: 0;">{{ $course->title ?? 'Pending Enrollment' }}</h4>
                </div>
            </div>

            <div class="glass-card animate__animated animate__fadeInRight">
                <h3 style="font-size: 18px; margin-bottom: 25px; font-weight: 800; color: #001529;">
                    <i class="fa-solid fa-bullhorn text-danger me-2"></i> Notice Board
                </h3>

                <div class="notice-feed" style="max-height: 500px; overflow-y: auto; padding-right: 8px;">
                    
                    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                        <span class="notice-badge" style="background: #e6f7ff; color: #1890ff;">Admission</span>
                        <h5 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Spring 2026 Intake Now Open</h5>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 8px; line-height: 1.5;">Applications for the Spring semester are being accepted. Refer a friend and earn credits!</p>
                        <div style="font-size: 10px; color: #94a3b8; font-weight: 600;"><i class="fa-regular fa-clock me-1"></i> 2 hours ago</div>
                    </div>

                    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                        <span class="notice-badge" style="background: #fff7e6; color: #fa8c16;">Exam</span>
                        <h5 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Final Exam Routine Published</h5>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 8px; line-height: 1.5;">The Fall 2025 final examination schedule is now live. Please check your student email for the PDF.</p>
                        <div style="font-size: 10px; color: #94a3b8; font-weight: 600;"><i class="fa-regular fa-clock me-1"></i> 5 hours ago</div>
                    </div>

                    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                        <span class="notice-badge" style="background: #f6ffed; color: #52c41a;">Holiday</span>
                        <h5 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Winter Vacation Notice</h5>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 8px; line-height: 1.5;">The university will remain closed from Dec 24th to Jan 2nd for winter break. Enjoy your holidays!</p>
                        <div style="font-size: 10px; color: #94a3b8; font-weight: 600;"><i class="fa-regular fa-clock me-1"></i> 1 day ago</div>
                    </div>

                    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f5f9;">
                        <span class="notice-badge" style="background: #fff1f0; color: #f5222d;">Event</span>
                        <h5 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Annual Research Symposium</h5>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 8px; line-height: 1.5;">Join us for the 2026 Research Excellence Awards. Guest speakers from MIT and Oxford will attend.</p>
                        <div style="font-size: 10px; color: #94a3b8; font-weight: 600;"><i class="fa-regular fa-clock me-1"></i> 3 days ago</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection