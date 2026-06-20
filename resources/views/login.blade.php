<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Student Excellence Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary: #1890ff;
            --primary-glow: rgba(24, 144, 255, 0.3);
            --dark-navy: #001529;
            --soft-bg: #f8fafc;
            --admin-red: #ff4d4f;
            --student-blue: #1890ff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background: var(--soft-bg);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* --- LEFT SIDE: BRANDING, TECH BRAND & SPECS --- */
        .branding-section {
            flex: 1.2;
            background: linear-gradient(rgba(0, 21, 41, 0.88), rgba(0, 21, 41, 0.88)), 
                        url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 60px 80px;
            color: white;
            position: relative;
        }

        /* Signature WebTech Premium Header */
        .brand-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-logo-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(45deg, #00f2fe, #4facfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0, 242, 254, 0.4);
        }
        .brand-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .branding-content h1 { font-size: 3.2rem; line-height: 1.1; margin-bottom: 15px; font-weight: 700; }
        .branding-content p { font-size: 1.05rem; opacity: 0.75; margin-bottom: 30px; }

        /* Project Core Blueprint Cards */
        .project-specs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .spec-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 15px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }
        .spec-card h3 { font-size: 13px; color: #4facfe; text-transform: uppercase; margin-bottom: 5px; font-weight: 700; letter-spacing: 0.5px;}
        .spec-card p { font-size: 12px; opacity: 0.7; margin: 0; line-height: 1.4; }

        .news-ticker {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            padding: 18px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        /* --- RIGHT SIDE: LOGIN FORM & GUEST ENTRY --- */
        .login-section {
            flex: 0.8;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 80px;
            box-shadow: -10px 0 30px rgba(0,0,0,0.05);
            z-index: 2;
        }

        .login-header h2 { font-size: 2.2rem; color: var(--dark-navy); margin-bottom: 8px; font-weight: 700; }
        .login-header p { color: #64748b; margin-bottom: 35px; font-size: 15px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #475569; font-weight: 600; font-size: 14px; }
        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
        }
        .form-group input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px var(--primary-glow); }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--dark-navy);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-login:hover { background: var(--primary); transform: translateY(-1px); box-shadow: 0 4px 12px var(--primary-glow); }

        /* --- HIGH-TECH SHOWCASE BYPASS PANEL --- */
        .divider-container {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .divider-container::before, .divider-container::after {
            content: '';
            flex: 1;
            border-bottom: 1px dashed #cbd5e1;
        }
        .divider-container:not(:empty)::before { margin-right: .5em; }
        .divider-container:not(:empty)::after { margin-left: .5em; }

        .showcase-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .btn-showcase {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 12px;
            text-decoration: none;
            border-radius: 10px;
            border: 2px solid transparent;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.25s ease;
        }
        .btn-showcase .role-subtitle {
            font-size: 10px;
            font-weight: 400;
            opacity: 0.8;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-admin-bypass {
            background: rgba(255, 77, 79, 0.06);
            color: var(--admin-red);
            border-color: rgba(255, 77, 79, 0.15);
        }
        .btn-admin-bypass:hover {
            background: var(--admin-red);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 77, 79, 0.3);
            transform: translateY(-2px);
        }

        .btn-student-bypass {
            background: rgba(24, 144, 255, 0.06);
            color: var(--student-blue);
            border-color: rgba(24, 144, 255, 0.15);
        }
        .btn-student-bypass:hover {
            background: var(--student-blue);
            color: white;
            box-shadow: 0 4px 15px rgba(24, 144, 255, 0.3);
            transform: translateY(-2px);
        }

        /* --- POP-UP AD (SUBTLE) --- */
        #promo-popup {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #e2e8f0;
            animation: slideInUp 1s;
        }
        #promo-popup .icon { font-size: 24px; }
        #promo-popup button { background: none; border: none; font-weight: bold; cursor: pointer; color: var(--primary); }

        @media (max-width: 1150px) {
            .branding-section { display: none; }
        }
    </style>
</head>
<body>

    <div class="branding-section">
        <div class="brand-header animate__animated animate__fadeInDown">
            <div class="brand-logo-text">Signature WebTech</div>
            <div class="brand-badge">Engineered Demo v1.1</div>
        </div>

        <div class="branding-content animate__animated animate__fadeInLeft">
            <span class="news-badge">CSE 470 Capstone</span>
            <h1>Knowledge <br>Beyond Borders.</h1>
            <p>An enterprise-grade orchestration portal combining course deployment, administrative workflows, and structured student metrics tracking systems.</p>
            
            <div class="project-specs">
                <div class="spec-card">
                    <h3>⚡ Admin Engine</h3>
                    <p>Encompasses full course CRUD operations, active application request statuses, global notices, and tracking dashboards.</p>
                </div>
                <div class="spec-card">
                    <h3>🎓 Student Core</h3>
                    <p>Live course routines, seamless enrollment workflows, research submissions, and programmatic digital ID generation mechanisms.</p>
                </div>
            </div>

            <div class="news-ticker">
                <strong style="color: #4facfe">SYSTEM STATUS:</strong>
                <span style="font-size: 13px; opacity: 0.9;">Connected to isolated secure cloud database cluster. Operations optimal.</span>
            </div>
        </div>
        
        <div style="font-size: 11px; opacity: 0.4;">© 2026 Signature WebTech Systems. All rights targeted for academic presentation.</div>
    </div>

    <div class="login-section animate__animated animate__fadeIn">
        <div class="login-header">
            <h2>Welcome Back!</h2>
            <p>Enter your credentials or use the engineering fast-pass toggles below.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Institutional Email</label>
                <input type="email" name="email" placeholder="e.g. j.doe@uni.edu" required>
            </div>

            <div class="form-group">
                <label>Secure Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Authorize & Sign In</button>
        </form>

        <div class="divider-container">Evaluation Fast-Pass</div>
        
        <div class="showcase-grid">
            <a href="/guest-login/admin" class="btn-showcase btn-admin-bypass">
                <span>Launch Admin Console</span>
                <span class="role-subtitle">Full Authority Overlook</span>
            </a>
            <a href="/guest-login/student" class="btn-showcase btn-student-bypass">
                <span>Launch Student Node</span>
                <span class="role-subtitle">Standard Portal Metrics</span>
            </a>
        </div>

        <div style="margin-top: 35px; text-align: center; color: #64748b; font-size: 14px;">
            Don't have an account? <a href="{{ url('/register') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Get Started</a>
        </div>
    </div>

    <div id="promo-popup">
        <span class="icon">🚀</span>
        <div>
            <div style="font-size: 12px; font-weight: bold; color: #1e293b;">SIGNATURE TECH FEATURE</div>
            <div style="font-size: 11px; color: #64748b;">Responsive engine scaling configured for external display.</div>
        </div>
        <button onclick="this.parentElement.style.display='none'">Dismiss</button>
    </div>

</body>
</html>