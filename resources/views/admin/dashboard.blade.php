@extends('layouts.admin')

@section('title', 'Command Center | Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .welcome-banner { padding: 40px 40px 20px 40px; }
    .welcome-banner h1 { font-size: 24px; color: var(--dark-navy); font-weight: 800; }
    .welcome-banner p { color: #64748b; font-size: 14px; }

    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; padding: 0 40px 30px 40px; }
    .stat-card {
        background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #edf2f7; position: relative; overflow: hidden;
        transition: all 0.3s ease;
    }
    .stat-card:hover { transform: translateY(-5px); border-color: var(--primary); }
    .stat-card h3 { font-size: 11px; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px; font-weight: 700; }
    .stat-card .value { font-size: 32px; font-weight: 800; color: var(--dark-navy); }
    
    .icon-box {
        position: absolute; right: 20px; bottom: 20px; width: 45px; height: 45px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; font-size: 20px; opacity: 0.8;
    }

    .chart-section { padding: 0 40px 30px 40px; display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
    .chart-card { 
        background: white; padding: 25px; border-radius: 20px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7;
    }

    .content-section { padding: 0 40px 40px 40px; display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
    .table-card { 
        background: white; padding: 25px; border-radius: 20px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7;
    }

    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 15px; color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    td { padding: 15px; border-bottom: 1px solid #f8fafc; font-size: 14px; }
    
    .student-info { display: flex; align-items: center; gap: 12px; }
    .avatar-circle {
        width: 35px; height: 35px; background: var(--primary); color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700;
    }

    .badge-program {
        background: #f0f7ff; color: var(--primary); padding: 4px 10px; 
        border-radius: 6px; font-size: 11px; font-weight: 700;
    }

    .side-card {
        background: var(--dark-navy); color: white; padding: 25px; border-radius: 20px;
        display: flex; flex-direction: column; justify-content: space-between;
    }

    /* --- PULSE ANIMATION --- */
    .status-dot {
        width: 10px; height: 10px; background: #52c41a; border-radius: 50%;
        display: inline-block; margin-right: 8px;
        box-shadow: 0 0 0 rgba(82, 196, 26, 0.4);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(82, 196, 26, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(82, 196, 26, 0); }
        100% { box-shadow: 0 0 0 0 rgba(82, 196, 26, 0); }
    }
</style>

<div class="welcome-banner animate__animated animate__fadeIn">
    <h1>Command Center 👋</h1>
    <p>Real-time analytics and campus management.</p>
</div>

<div class="stats-grid">
    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <h3>Total Students</h3>
        <div class="value">{{ $studentCount }}</div>
        <div class="icon-box" style="background: #e6f7ff; color: #1890ff;"><i class="fa-solid fa-user-graduate"></i></div>
    </div>
    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <h3>Pending Apps</h3>
        <div class="value" style="color: #fa8c16;">{{ $applicationCount }}</div>
        <div class="icon-box" style="background: #fff7e6; color: #fa8c16;"><i class="fa-solid fa-file-signature"></i></div>
    </div>
    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
        <h3>Research Items</h3>
        <div class="value" style="color: #722ed1;">{{ \DB::table('research_applications')->count() }}</div>
        <div class="icon-box" style="background: #f9f0ff; color: #722ed1;"><i class="fa-solid fa-atom"></i></div>
    </div>
    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
        <h3>Departments</h3>
        <div class="value">{{ $courseCount }}</div>
        <div class="icon-box" style="background: #f6ffed; color: #52c41a;"><i class="fa-solid fa-layer-group"></i></div>
    </div>
</div>

<div class="chart-section">
    <div class="chart-card animate__animated animate__fadeInLeft" style="animation-delay: 0.5s">
        <h3 style="font-weight: 800; color: var(--dark-navy); margin-bottom: 20px; font-size: 16px;">
            <i class="fa-solid fa-chart-line" style="margin-right: 8px; color: var(--primary);"></i> Admission Trends (Weekly)
        </h3>
        <canvas id="admissionChart" height="100"></canvas>
    </div>
    
    <div class="chart-card animate__animated animate__fadeInRight" style="animation-delay: 0.5s">
        <h3 style="font-weight: 800; color: var(--dark-navy); margin-bottom: 20px; font-size: 16px;">Program Popularity</h3>
        <canvas id="popularityChart"></canvas>
    </div>
</div>

<div class="content-section">
    <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="font-weight: 800; color: var(--dark-navy);">Recent Enrolments</h3>
            <a href="/admin/applications" style="color: var(--primary); text-decoration: none; font-size: 12px; font-weight: 700;">Process Queue →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Program</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrolledStudents as $student)
                <tr>
                    <td>
                        <div class="student-info">
                            <div class="avatar-circle">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                            <div>
                                <div style="font-weight: 700; color: var(--dark-navy);">{{ $student->name }}</div>
                                <div style="font-size: 11px; color: #94a3b8;">{{ $student->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge-program">{{ $student->course->title ?? 'General' }}</span></td>
                    <td style="color: #64748b; font-size: 12px;">{{ $student->updated_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center; padding: 40px; color: #94a3b8;">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="side-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
        <div>
            <h3 style="font-size: 18px; margin-bottom: 10px;">System Actions</h3>
            <p style="font-size: 13px; opacity: 0.7; margin-bottom: 25px;">Quick access shortcuts.</p>
            
            <a href="/admin/courses" style="display: flex; align-items: center; gap: 10px; color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 12px; border-radius: 12px; margin-bottom: 10px; transition: 0.3s;">
                <i class="fa-solid fa-plus-circle"></i> New Course
            </a>
            <a href="/admin/student-life" style="display: flex; align-items: center; gap: 10px; color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 12px; border-radius: 12px; transition: 0.3s;">
                <i class="fa-solid fa-bullhorn"></i> Announcement
            </a>
        </div>
        
        <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 12px; font-size: 11px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="color: #52c41a; font-weight: 700; margin-bottom: 5px;">
                <span class="status-dot"></span> Server Online
            </div>
            Running version 2.4.0-stable
        </div>
    </div>
</div>

<script>
    // Admission Trends Chart
    const ctx1 = document.getElementById('admissionChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'New Applications',
                data: [5, 12, 8, 15, 10, 20, 18],
                borderColor: '#1890ff',
                backgroundColor: 'rgba(24, 144, 255, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#1890ff'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Popularity Chart
    const ctx2 = document.getElementById('popularityChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['CS', 'EEE', 'BBA', 'Law'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#1890ff', '#52c41a', '#fa8c16', '#722ed1'],
                hoverOffset: 4,
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            }
        }
    });
</script>
@endsection