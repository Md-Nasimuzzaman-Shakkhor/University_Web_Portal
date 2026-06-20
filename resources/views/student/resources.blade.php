@extends('layouts.student')

@section('title', 'Resources | Student Portal')

@section('content')
    <style>
        /* Specific styles only for the Resource page */
        .search-box {
            width: 100%; padding: 15px 20px; padding-left: 45px;
            border-radius: 12px; border: 1px solid #e2e8f0; outline: none;
            font-size: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 30px;
        }
        .resource-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .resource-card {
            background: white; padding: 25px; border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #edf2f7;
            display: flex; flex-direction: column; justify-content: space-between; transition: 0.3s;
        }
        .resource-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .file-tag { background: #e6f7ff; color: var(--primary); padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .download-btn {
            background: var(--primary); color: white; text-decoration: none; text-align: center;
            padding: 12px; border-radius: 8px; font-weight: 600; margin-top: 20px; transition: 0.3s;
        }
        .download-btn:hover { background: #40a9ff; }
    </style>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-weight: 700; color: #1e293b;">Learning Resources</h2>
        <div style="color: #64748b; font-size: 14px;">Total Files: {{ count($resources) }}</div>
    </div>

    <div style="position: relative;">
        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 18px; top: 18px; color: #94a3b8;"></i>
        <input type="text" id="resourceSearch" class="search-box" placeholder="Search by title, course, or file type...">
    </div>

    <div class="resource-grid" id="resourceGrid">
        @forelse($resources as $resource)
        <div class="resource-card animate__animated animate__fadeIn">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <span class="file-tag">{{ $resource->course_name }}</span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">{{ strtoupper($resource->type) }}</span>
                </div>
                <h3 style="font-size: 18px; color: var(--dark-navy); margin-bottom: 10px;">{{ $resource->title }}</h3>
                <p style="font-size: 13px; color: #64748b;">Added on {{ date('M d, Y', strtotime($resource->created_at)) }}</p>
            </div>

            <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="download-btn">
                <i class="fa-solid fa-file-arrow-down mr-2"></i> View / Download
            </a>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #94a3b8;">
            <i class="fa-solid fa-folder-open" style="font-size: 40px; margin-bottom: 10px;"></i>
            <p>No resources found for your course yet.</p>
        </div>
        @endforelse
    </div>

    <script>
        document.getElementById('resourceSearch').addEventListener('keyup', function() {
            let searchTerm = this.value.toLowerCase();
            let cards = document.querySelectorAll('.resource-card');

            cards.forEach(card => {
                let text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? "flex" : "none";
            });
        });
    </script>
@endsection