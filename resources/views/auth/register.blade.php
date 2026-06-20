<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | UNI_PORTAL</title>
    </head>
<body>
    <div class="container">
        <div class="brand-side" style="background: #001529;">
            <h1>Join Us</h1>
            <p style="margin-top: 15px; opacity: 0.8;">Create your student account to start enrolling in world-class courses.</p>
        </div>
        <div class="form-side">
            <h2>Create Account</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="input-box">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required>
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="email@example.com" required>
                </div>
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min. 8 characters" required>
                </div>
                <button type="submit" class="btn" style="background: #001529;">Register Now</button>
            </form>
            <div class="link">
                Already have an account? <a href="{{ url('/login') }}">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>