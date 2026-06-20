@extends('layouts.student')

@section('title', 'Student Life | UNI_PORTAL')

@section('content')
    <style>
        /* Specific styles for Student Life Page */
        .life-hero {
            background: linear-gradient(rgba(0, 33, 71, 0.8), rgba(0, 33, 71, 0.8)), 
                        url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            padding: 60px;
            border-radius: 20px;
            color: white;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .activity-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .activity-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

        .card-visual { height: 8px; width: 100%; background: var(--primary); }
        .category-sports { background: #52c41a; }
        .category-academic { background: #1890ff; }
        .category-cultural { background: #722ed1; }

        .card-body { padding: 25px; flex-grow: 1; }
        .tag {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            padding: 4px 10px; border-radius: 4px; background: #f1f5f9;
            color: #64748b; margin-bottom: 12px; display: inline-block;
        }

        .card-title { font-size: 19px; font-weight: 700; color: var(--dark-navy); margin-bottom: 12px; }
        .card-desc { font-size: 14px; color: #64748b; line-height: 1.6; }

        .card-footer {
            padding: 15px 25px; background: #f8fafc; border-top: 1px solid #f1f5f9;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; color: #94a3b8;
        }
    </style>

    <div class="life-hero animate__animated animate__fadeIn">
        <h1 style="font-size: 32px; margin-bottom: 10px;">Campus Life & Pulse</h1>
        <p style="opacity: 0.9;">Stay updated with the latest events, clubs, and student stories.</p>
    </div>

    <div class="activity-grid">
        @forelse($activities as $activity)
            @php
                $catClass = strtolower($activity->category);
                $visualClass = 'category-academic'; // default
                if(str_contains($catClass, 'sport')) $visualClass = 'category-sports';
                if(str_contains($catClass, 'cultur')) $visualClass = 'category-cultural';
            @endphp

            <div class="activity-card animate__animated animate__zoomIn">
                <div class="card-visual {{ $visualClass }}"></div>
                <div class="card-body">
                    <span class="tag">{{ $activity->category }}</span>
                    <h3 class="card-title">{{ $activity->title }}</h3>
                    <p class="card-desc">{{ Str::limit($activity->description, 120) }}</p>
                </div>
                <div class="card-footer">
                    <span><i class="fa-regular fa-calendar-check"></i> {{ $activity->created_at->format('M d, Y') }}</span>
                    <a href="#" style="color: var(--primary); text-decoration: none; font-weight: 600;">Details →</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                <i class="fa-solid fa-mug-hot" style="font-size: 50px; color: #cbd5e1; margin-bottom: 20px;"></i>
                <h3 style="color: #94a3b8;">It's a quiet day on campus. Check back later!</h3>
            </div>
        @endforelse
    </div>
@endsection