@extends('layouts.admin')

@section('title', 'Manage Student Life | UNI_ADMIN')

@section('content')
<style>
    .main-content { padding: 40px; }
    .page-header { margin-bottom: 30px; }
    .page-header h2 { color: var(--dark-navy); font-weight: 700; font-size: 26px; }

    .layout-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 30px; align-items: start; }

    /* --- FORM CARD --- */
    .form-card {
        background: white; padding: 30px; border-radius: 16px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-bottom: 4px solid var(--primary);
        position: sticky; top: 100px; /* Adjusted for header height */
    }
    .form-card h3 { color: var(--dark-navy); font-size: 18px; margin-bottom: 20px; font-weight: 700; }
    
    input, textarea, select {
        width: 100%; padding: 12px 15px; border: 2px solid #f1f5f9; border-radius: 10px;
        background: #f8fafc; transition: 0.3s; font-size: 14px; margin-bottom: 15px;
    }
    input:focus, textarea:focus, select:focus { border-color: var(--primary); outline: none; background: white; }

    .btn-post {
        background: var(--primary); color: white; border: none; padding: 15px; 
        width: 100%; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 15px;
        transition: 0.3s;
    }
    .btn-post:hover { background: #0050b3; transform: translateY(-2px); }

    /* --- TABLE CARD --- */
    .table-card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 15px; background: #f8fafc; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; }
    td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    
    .cat-badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
    .cat-General { background: #e6f7ff; color: #1890ff; }
    .cat-Clubs { background: #f9f0ff; color: #722ed1; }
    .cat-Sports { background: #fff7e6; color: #fa8c16; }
    .cat-Events { background: #f6ffed; color: #52c41a; }
</style>

<div class="main-content">
    <div class="page-header animate__animated animate__fadeInDown">
        <h2>Student Life Studio</h2>
        <p style="color: #64748b; font-size: 14px;">Publish updates, club news, and campus events to the student portal.</p>
    </div>

    @if(session('success'))
        <div class="animate__animated animate__fadeIn" style="background: #f6ffed; color: #389e0d; padding: 15px; border-radius: 10px; margin-bottom: 25px; border: 1px solid #b7eb8f;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="layout-grid">
        <div class="form-card animate__animated animate__fadeInLeft">
            <h3><i class="fa-solid fa-pen-nib"></i> New Post</h3>
            <form action="{{ route('admin.student-life.store') }}" method="POST">
                @csrf
                <label style="font-size: 12px; font-weight: 600; color: #64748b;">HEADLINE</label>
                <input type="text" name="title" placeholder="e.g. Annual Tech Symposium 2026" required>
                
                <label style="font-size: 12px; font-weight: 600; color: #64748b;">CATEGORY</label>
                <select name="category">
                    <option value="General">General News</option>
                    <option value="Clubs">Clubs & Societies</option>
                    <option value="Sports">Sports</option>
                    <option value="Events">Campus Events</option>
                </select>
                
                <label style="font-size: 12px; font-weight: 600; color: #64748b;">CONTENT</label>
                <textarea name="description" rows="5" placeholder="Write the story here..." required></textarea>
                
                <label style="font-size: 12px; font-weight: 600; color: #64748b;">COVER IMAGE URL</label>
                <input type="text" name="image_url" placeholder="https://source.unsplash.com/..." value="https://images.unsplash.com/photo-1523050853063-915894367ef7?q=80&w=800">
                
                <button type="submit" class="btn-post">
                    <i class="fa-solid fa-paper-plane me-2"></i> Publish to Portal
                </button>
            </form>
        </div>

        <div class="table-card animate__animated animate__fadeInRight">
            <h3 style="margin-bottom: 20px; font-weight: 700; color: var(--dark-navy);">Live Portal Feed</h3>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Headline & Preview</th>
                            <th>Category</th>
                            <th>Posted On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $item)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: var(--dark-navy);">{{ $item->title }}</div>
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 3px; max-width: 300px;">
                                    {{ \Illuminate\Support\Str::limit($item->description, 60) }}
                                </div>
                            </td>
                            <td>
                                <span class="cat-badge cat-{{ $item->category }}">{{ $item->category }}</span>
                            </td>
                            <td style="color: #94a3b8; font-size: 13px; white-space: nowrap;">
                                <i class="fa-regular fa-calendar me-1"></i> {{ $item->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i class="fa-solid fa-newspaper d-block mb-3" style="font-size: 30px; opacity: 0.3;"></i>
                                No posts have been published yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection