<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Student Excellence Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary: #1890ff;
            --dark-navy: #001529;
            --soft-bg: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            background: var(--soft-bg);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* --- LEFT SIDE: BRANDING & NEWS --- */
        .branding-section {
            flex: 1.2;
            background: linear-gradient(rgba(0, 21, 41, 0.85), rgba(0, 21, 41, 0.85)), 
                        url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
            color: white;
            position: relative;
        }

        .news-badge {
            display: inline-block;
            background: rgba(24, 144, 255, 0.2);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            border: 1px solid var(--primary);
        }

        .branding-section h1 { font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; }
        .branding-section p { font-size: 1.1rem; opacity: 0.8; margin-bottom: 40px; }

        .news-ticker {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        /* --- RIGHT SIDE: LOGIN FORM --- */
        .login-section {
            flex: 0.8;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
            box-shadow: -10px 0 30px rgba(0,0,0,0.05);
            z-index: 2;
        }

        .login-header h2 { font-size: 2rem; color: var(--dark-navy); margin-bottom: 10px; }
        .login-header p { color: #64748b; margin-bottom: 40px; }

        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #475569; font-weight: 600; font-size: 14px; }
        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
        }
        .form-group input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px rgba(24, 144, 255, 0.1); }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }
        .btn-login:hover { background: #0056b3; transform: translateY(-2px); }

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

        @media (max-width: 1024px) {
            .branding-section { display: none; }
        }
    </style>
</head>
<body>

    <div class="branding-section">
        <div class="animate__animated animate__fadeInLeft">
            <span class="news-badge">Campus News</span>
            <h1>Knowledge <br>Beyond Borders.</h1>
            <p>Join over 5,000+ students and 50+ expert coaches today. Your journey to excellence starts with a single click.</p>
            
            <div class="news-ticker">
                <strong style="color: var(--primary)">LATEST UPDATE:</strong>
                <span style="font-size: 14px;">Scholarship applications for the 2026 Batch are now open! Apply before Dec 31.</span>
            </div>
        </div>
    </div>

    <div class="login-section animate__animated animate__fadeIn">
        <div class="login-header">
            <h2>Welcome Back!</h2>
            <p>Enter your credentials to access your dashboard.</p>
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

        <div style="margin-top: 30px; text-align: center; color: #64748b; font-size: 14px;">
            Don't have an account? <a href="{{ url('/register') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Get Started</a>
        </div>
    </div>

    <div id="promo-popup">
        <span class="icon">🚀</span>
        <div>
            <div style="font-size: 12px; font-weight: bold; color: #1e293b;">NEW FEATURE</div>
            <div style="font-size: 11px; color: #64748b;">Download our official Mobile App!</div>
        </div>
        <button onclick="this.parentElement.style.display='none'">Dismiss</button>
    </div>

</body>
</html>