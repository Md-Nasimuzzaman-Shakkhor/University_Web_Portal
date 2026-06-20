<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | UNI_PORTAL Coaching Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background: #f4f7f6;
            color: #333;
            line-height: 1.6;
        }

        /* Navigation */
        nav {
            background: white;
            padding: 20px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .logo { font-size: 24px; font-weight: 700; color: #002147; letter-spacing: 1px; }
        .nav-links a {
            text-decoration: none;
            color: #555;
            margin-left: 30px;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-links a:hover { color: #1890ff; }

        /* Hero Section */
        .hero {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(rgba(0, 33, 71, 0.9), rgba(0, 33, 71, 0.9)), 
                        url('https://images.unsplash.com/photo-1523050853063-913ec989e9c3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 0 20px;
        }

        .hero-content h1 { font-size: 3.5rem; margin-bottom: 20px; }
        .hero-content p { font-size: 1.2rem; margin-bottom: 40px; opacity: 0.9; max-width: 700px; margin-left: auto; margin-right: auto; }

        .btn-group { display: flex; gap: 20px; justify-content: center; }
        
        .btn {
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .btn-primary { background: #1890ff; color: white; border: 2px solid #1890ff; }
        .btn-primary:hover { background: #0056b3; border-color: #0056b3; }
        
        .btn-outline { background: transparent; color: white; border: 2px solid white; }
        .btn-outline:hover { background: white; color: #002147; }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 80px;
            background: white;
        }
        .feature-card {
            text-align: center;
            padding: 40px;
            border-radius: 15px;
            background: #f8f9fa;
            transition: 0.3s;
        }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .feature-card h3 { margin-bottom: 15px; color: #002147; }
    </style>
</head>
<body>

    <nav>
        <div class="logo">UNI_PORTAL</div>
        <div class="nav-links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}" style="background: #002147; color: white; padding: 10px 20px; border-radius: 5px;">Join Now</a>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-content">
            <h1>Empowering Your Future</h1>
            <p>Access high-quality coaching, professional courses, and a streamlined admission process all in one digital portal.</p>
            <div class="btn-group">
                <a href="{{ url('/register') }}" class="btn btn-primary">Get Started</a>
                <a href="{{ url('/login') }}" class="btn btn-outline">Student Login</a>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="feature-card">
            <h3>Expert Coaching</h3>
            <p>Learn from industry professionals with years of teaching experience.</p>
        </div>
        <div class="feature-card">
            <h3>Easy Enrollment</h3>
            <p>Browse available courses and join with just one click.</p>
        </div>
        <div class="feature-card">
            <h3>Student Support</h3>
            <p>Dedicated dashboard to manage your applications and learning journey.</p>
        </div>
    </div>

</body>
</html>