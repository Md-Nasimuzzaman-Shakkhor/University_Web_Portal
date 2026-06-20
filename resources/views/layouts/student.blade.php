<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary: #1890ff; --dark-navy: #001529; --bg-soft: #f0f2f5;
            --sidebar-width: 260px; --success: #52c41a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg-soft); display: flex; min-height: 100vh; }

        .sidebar {
            width: var(--sidebar-width); background: var(--dark-navy); color: white;
            padding: 30px 20px; display: flex; flex-direction: column;
            position: fixed; height: 100vh; z-index: 100;
        }
        .sidebar .logo { font-size: 22px; font-weight: 700; margin-bottom: 40px; color: var(--primary); padding-left: 10px; }
        .sidebar a { 
            color: #a6adb4; text-decoration: none; padding: 12px 15px; border-radius: 8px; 
            margin-bottom: 8px; transition: 0.3s; display: flex; align-items: center; gap: 12px;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(24, 144, 255, 0.15); color: white; }
        .sidebar a i { width: 20px; }
        .logout-btn { color: #ff4d4f !important; margin-top: auto; }
        .main-container { margin-left: var(--sidebar-width); flex: 1; padding: 40px; }
        
        /* Global Card Styles moved to Layout for consistency */
        .glass-card { background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7; margin-bottom: 25px; }
        .status-pill { padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 700; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">UNI_PORTAL</div>
        <a href="{{ url('/student/dashboard') }}" class="{{ request()->is('student/dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Overview
        </a>
        <a href="{{ url('/student/resources') }}" class="{{ request()->is('student/resources') ? 'active' : '' }}">
            <i class="fa-solid fa-folder-open"></i> Resources
        </a>
        <a href="{{ url('/student/courses') }}" class="{{ request()->is('student/courses') ? 'active' : '' }}">
            <i class="fa-solid fa-book-open"></i> Browse Courses
        </a>
        <a href="{{ url('/student/research') }}" class="{{ request()->is('student/research*') ? 'active' : '' }}">
            <i class="fa-solid fa-microscope"></i> Research Ops
        </a>
        <a href="{{ url('/student/admission') }}" class="{{ request()->is('student/admission') ? 'active' : '' }}">
            <i class="fa-solid fa-file-signature"></i> Admissions
        </a>
        <a href="{{ url('/student/student-life') }}" class="{{ request()->is('student/student-life') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Student Life
        </a>
        <a href="{{ url('/logout') }}" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="main-container">
        @yield('content')
    </div>

</body>
</html>