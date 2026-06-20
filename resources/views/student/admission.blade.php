@extends('layouts.student')

@section('title', 'Admission Portal | UNI_PORTAL')

@section('content')
    <style>
        /* Specific styles for Admission Page */
        .admission-grid {
            display: grid; grid-template-columns: 1fr 1.5fr;
            gap: 30px; margin-top: 20px;
        }

        .info-card {
            background: white; padding: 30px; border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #e2e8f0;
        }

        .schedule-item {
            position: relative; padding-left: 30px; padding-bottom: 25px;
            border-left: 2px dashed #e2e8f0;
        }
        .schedule-item::before {
            content: ''; position: absolute; left: -7px; top: 0;
            width: 12px; height: 12px; background: var(--primary); border-radius: 50%;
        }
        .schedule-item:last-child { border-left: none; }

        .form-card {
            background: white; padding: 40px; border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-top: 5px solid var(--primary);
        }

        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px; }
        
        input, select {
            width: 100%; padding: 12px 15px; border: 2px solid #f1f5f9;
            border-radius: 10px; background: #f8fafc; font-size: 15px; transition: all 0.3s;
        }
        input:focus, select:focus {
            border-color: var(--primary); background: white; outline: none;
            box-shadow: 0 0 0 4px rgba(24, 144, 255, 0.1);
        }

        .btn-submit {
            width: 100%; padding: 16px; background: var(--dark-navy); color: white;
            border: none; border-radius: 10px; font-size: 16px; font-weight: 700;
            cursor: pointer; transition: 0.3s; margin-top: 10px;
        }
        .btn-submit:hover { background: #002d5a; transform: translateY(-2px); }

        .form-header { margin-bottom: 30px; }
        .form-header h2 { color: var(--dark-navy); font-size: 24px; }
    </style>

    <div class="header-top animate__animated animate__fadeIn">
        <h1 style="font-weight: 800; color: var(--dark-navy); font-size: 28px;">Spring 2026 Admissions</h1>
        <p style="color: #64748b;">Complete your profile to secure your seat in the upcoming session.</p>
    </div>

    <div class="admission-grid">
        
        <div class="info-card animate__animated animate__fadeInLeft">
            <h3 style="margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-calendar-days" style="color: var(--primary);"></i> Test Schedule
            </h3>
            
            @foreach($departments as $dept)
            <div class="schedule-item">
                <div style="font-weight: 700; color: var(--dark-navy); font-size: 15px;">{{ $dept->title }}</div>
                <div style="font-size: 13px; color: var(--primary); font-weight: 600;">Date: Jan 15, 2026</div>
                <div style="font-size: 12px; color: #94a3b8;">Location: Main Campus, Hall A</div>
            </div>
            @endforeach

            <div style="background: #fffbe6; padding: 15px; border-radius: 10px; border: 1px solid #ffe58f; margin-top: 20px;">
                <p style="font-size: 12px; color: #856404; line-height: 1.5;">
                    <i class="fa-solid fa-circle-info"></i> Ensure all your GPA information matches your official certificates. Discrepancies may lead to rejection.
                </p>
            </div>
        </div>

        <div class="form-card animate__animated animate__fadeInRight">
            <div class="form-header">
                <h2>Application Form</h2>
                <p style="color: #64748b; font-size: 14px;">Fill in your academic and personal details below.</p>
            </div>

            <form action="{{ route('admission.submit') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <label>Preferred Department</label>
                    <select name="course_id" required>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label>Candidate Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter your full name" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" readonly style="background: #f1f5f9; cursor: not-allowed;">
                    </div>
                    <div class="input-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="+880 1XXX-XXXXXX" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
                    <div class="input-group" style="margin-bottom: 0;">
                        <label>SSC GPA</label>
                        <input type="text" name="ssc_result" placeholder="e.g. 5.00" required>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <label>HSC GPA</label>
                        <input type="text" name="hsc_result" placeholder="e.g. 5.00" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> Finalize Application
                </button>
            </form>
        </div>

    </div>
@endsection