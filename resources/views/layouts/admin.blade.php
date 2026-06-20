<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Command Center | UNI_PORTAL')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary: #1890ff;
            --dark-navy: #001529;
            --sidebar-bg: #001529;
            --bg-soft: #f0f2f5;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg-soft); display: flex; min-height: 100vh; }

        .sidebar {
            width: var(--sidebar-width); background: var(--sidebar-bg); color: white;
            padding: 30px 20px; display: flex; flex-direction: column; position: fixed; height: 100vh; z-index: 100;
        }
        .sidebar .brand { font-size: 20px; font-weight: 800; color: white; margin-bottom: 40px; padding-left: 10px; letter-spacing: 1px; }
        .sidebar .brand span { color: var(--primary); }
        .sidebar a { 
            color: #a6adb4; text-decoration: none; padding: 12px 15px; border-radius: 8px; 
            margin-bottom: 8px; transition: 0.3s; display: flex; align-items: center; gap: 12px; font-size: 14px;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }
        .sidebar a.active { border-left: 4px solid var(--primary); background: rgba(24, 144, 255, 0.1); }

        .main-container { margin-left: var(--sidebar-width); flex: 1; padding: 0; }
        .header-top {
            background: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03); position: sticky; top: 0; z-index: 10;
        }
        .logout-btn { color: #ff4d4f !important; border: 1px solid #ff4d4f; padding: 8px 15px; border-radius: 6px; font-weight: 600; text-decoration: none; font-size: 13px; }
        
        /* Global Admin Card Styles */
        .table-card { background: white; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7; padding: 25px; }
        .badge { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; background: #e0f2fe; color: var(--primary); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">UNI<span>ADMIN</span></div>
        
        <a href="{{ url('/admin/dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>
        <a href="{{ url('/admin/courses') }}" class="{{ Request::is('admin/courses*') ? 'active' : '' }}">
            <i class="fa-solid fa-book"></i> Manage Courses
        </a>
        <a href="{{ url('/admin/research-applications') }}" class="{{ Request::is('admin/research*') ? 'active' : '' }}">
            <i class="fa-solid fa-flask-vial"></i> Research Desk
        </a>
        <a href="{{ url('/admin/resources') }}" class="{{ Request::is('admin/resources*') ? 'active' : '' }}">
            <i class="fa-solid fa-cloud-arrow-up"></i> Resource Repository
        </a>
        <a href="{{ url('/admin/manage-student-life') }}" class="{{ Request::is('admin/manage-student-life*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper"></i> Student Life
        </a> 
        <a href="{{ url('/admin/applications') }}" class="{{ Request::is('admin/applications*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice"></i> Application Desk
        </a>
        
        <div style="margin-top: auto;">
             <a href="{{ url('/logout') }}" style="color: #ff4d4f;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <div class="main-container">
        <div class="header-top">
            <span style="color: #64748b;"><i class="fa-solid fa-user-shield"></i> Admin: <strong>{{ Auth::user()->name }}</strong></span>
            <a href="{{ url('/logout') }}" class="logout-btn">Sign Out</a>
        </div>

        @yield('content')
    </div>
</body>
</html>