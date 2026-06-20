@extends('layouts.student')

@section('title', 'Research Board | Student Portal')

@section('content')
    <style>
        /* Specific styles for Research Projects */
        .page-header { margin-bottom: 30px; }
        .page-header h2 { font-size: 24px; color: var(--dark-navy); font-weight: 700; }

        .research-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .research-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .research-card:hover { transform: translateY(-5px); border-color: var(--primary); }

        .tag {
            display: inline-block;
            padding: 4px 12px;
            background: #e6f7ff;
            color: var(--primary);
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .apply-btn {
            margin-top: 20px;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }
        .apply-btn:hover { background: #40a9ff; }
    </style>

    <div class="page-header">
        <h2>Available Research Opportunities</h2>
        <p style="color: #64748b;">Participate in cutting-edge projects and earn academic credits.</p>
    </div>

    @if(session('success'))
        <div class="animate__animated animate__fadeInDown" style="background: #f6ffed; border: 1px solid #b7eb8f; color: #52c41a; padding: 15px; border-radius: 10px; margin-bottom: 25px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="research-grid">
        @forelse($projects as $project)
            <div class="research-card animate__animated animate__fadeInUp">
                <div>
                    <span class="tag">Academic Research</span>
                    <h3 style="margin-bottom: 10px; color: var(--dark-navy);">{{ $project->title }}</h3>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.6;">{{ $project->description }}</p>
                </div>
                
                <form action="{{ route('research.apply', $project->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="apply-btn">Express Interest</button>
                </form>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 50px; background: white; border-radius: 16px;">
                <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #cbd5e1; margin-bottom: 15px;"></i>
                <p style="color: #64748b;">No research projects are currently available for application.</p>
            </div>
        @endforelse
    </div>
@endsection