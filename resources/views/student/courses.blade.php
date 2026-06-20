@extends('layouts.student')

@section('title', 'Browse Courses | Student Portal')

@section('content')
    <style>
        /* Specific styles for Course Cards */
        .header-top {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;
        }
        .course-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px;
        }
        .course-card {
            background: white; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: 0.3s;
            border: 1px solid #e2e8f0; display: flex; flex-direction: column;
        }
        .course-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.08); }
        .course-header { background: #f8fafc; padding: 25px; border-bottom: 1px solid #f1f5f9; position: relative; }
        .course-icon {
            width: 45px; height: 45px; background: white; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 15px; color: var(--primary);
        }
        .course-body { padding: 25px; flex-grow: 1; }
        .course-title { font-size: 18px; font-weight: 700; color: var(--dark-navy); margin-bottom: 10px; }
        .course-desc { font-size: 14px; color: #64748b; line-height: 1.6; }
        .course-footer { padding: 20px 25px; background: #fff; border-top: 1px dotted #e2e8f0; }
        
        /* Buttons */
        .btn-enroll {
            width: 100%; padding: 12px; background: var(--primary); color: white;
            border: none; border-radius: 10px; font-weight: 600; cursor: pointer;
            transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-enroll:hover { background: #0056b3; }
        .btn-withdraw {
            width: 100%; padding: 10px; background: #fff1f0; color: #ff4d4f;
            border: 1px solid #ffccc7; border-radius: 10px; font-weight: 600;
            cursor: pointer; margin-top: 10px; font-size: 13px;
        }
        .btn-withdraw:hover { background: #ff4d4f; color: white; }
        .enrolled-tag {
            background: #f6ffed; color: var(--success); font-size: 12px; font-weight: 700;
            padding: 6px 12px; border-radius: 50px; border: 1px solid #b7eb8f;
            display: inline-flex; align-items: center; gap: 5px; width: 100%; justify-content: center;
        }
    </style>

    <div class="header-top">
        <div>
            <h2 style="font-weight: 700; color: var(--dark-navy);">Available Courses</h2>
            <p style="color: #64748b; font-size: 14px;">Select a program to enhance your skills today.</p>
        </div>
        <a href="{{ url('/student/dashboard') }}" style="text-decoration: none; color: var(--primary); font-weight: 600; font-size: 14px;">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="course-grid">
        @foreach($courses as $course)
            <div class="course-card animate__animated animate__fadeInUp">
                <div class="course-header">
                    <div class="course-icon">
                        <i class="fa-solid fa-graduation-cap fa-lg"></i>
                    </div>
                    <div class="course-title">{{ $course->title }}</div>
                </div>
                
                <div class="course-body">
                    <p class="course-desc">{{ $course->description ?? 'Explore our curriculum and mastering professional techniques in this comprehensive course.' }}</p>
                </div>

                <div class="course-footer">
                    @if(Auth::user()->course_id == $course->id)
                        <div class="enrolled-tag">
                            <i class="fa-solid fa-circle-check"></i> Enrolled
                        </div>
                        <form action="{{ route('withdraw') }}" method="POST" onsubmit="return confirm('Withdraw from {{ $course->title }}?')">
                            @csrf
                            <button type="submit" class="btn-withdraw">Withdraw</button>
                        </form>
                    @else
                        <form action="{{ route('enroll', $course->id) }}" method="POST" onsubmit="return confirm('Join {{ $course->title }}?')">
                            @csrf
                            <button type="submit" class="btn-enroll">
                                Enroll Now <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection