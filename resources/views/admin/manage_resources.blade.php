@extends('layouts.admin')

@section('title', 'Manage Resources | Admin Portal')

@section('content')
<style>
    .content-section { padding: 40px; }
    .glass-card {
        background: white; padding: 30px; border-radius: 16px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        border: 1px solid #edf2f7; margin-bottom: 30px;
    }

    .form-group label { font-size: 13px; color: #64748b; display: block; margin-bottom: 8px; }
    input, select { 
        width: 100%; padding: 12px; border: 1px solid #e2e8f0; 
        border-radius: 8px; outline: none; transition: 0.3s; background: #fff;
    }
    input:focus, select:focus { border-color: var(--primary); }

    .upload-btn { 
        background: var(--primary); color: white; padding: 12px 25px; 
        border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; 
    }
    .upload-btn:hover { background: #40a9ff; }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th { 
        text-align: left; padding: 15px; background: #f8fafc; color: #64748b; 
        font-size: 13px; font-weight: 600; text-transform: uppercase; 
    }
    td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    
    .resource-badge { 
        background: #e6f7ff; color: var(--primary); padding: 4px 10px; 
        border-radius: 4px; font-size: 12px; font-weight: 500;
    }
    .delete-btn { color: #ff4d4f; text-decoration: none; font-weight: 600; background: none; border: none; cursor: pointer; }
    .delete-btn:hover { text-decoration: underline; }
</style>

<div class="content-section">
    @if(session('success'))
        <div class="animate__animated animate__fadeInDown" style="background: #f6ffed; border: 1px solid #b7eb8f; color: #52c41a; padding: 15px; border-radius: 10px; margin-bottom: 25px;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="glass-card animate__animated animate__fadeIn">
        <h3 style="margin-bottom: 20px; color: var(--dark-navy); font-size: 20px;">Upload New Learning Material</h3>
        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="form-group">
                    <label>Material Title</label>
                    <input type="text" name="title" placeholder="e.g. Week 1 Lecture Notes" required>
                </div>
                <div class="form-group">
                    <label>Course Category</label>
                    <select name="course_id" required>
                        <option value="" disabled selected>Select a course...</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Select File (PDF/DOC/ZIP)</label>
                    <input type="file" name="file" style="padding: 8px;" required>
                </div>
            </div>
            <button type="submit" class="upload-btn" style="margin-top: 20px;">
                <i class="fa-solid fa-upload me-2"></i> Start Upload
            </button>
        </form>
    </div>

    <div class="glass-card animate__animated animate__fadeIn" style="animation-delay: 0.2s">
        <h3 style="margin-bottom: 20px; color: var(--dark-navy); font-size: 20px;">Existing Resources</h3>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Resource Title</th>
                        <th>Associated Course</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resources as $r)
                    <tr>
                        <td style="font-weight: 600; color: var(--dark-navy);">{{ $r->title }}</td>
                        <td><span class="resource-badge">{{ $r->course_name }}</span></td>
                        <td>
                            <form action="{{ route('admin.resources.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="delete-btn">
                                    <i class="fa-solid fa-trash-can me-1"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: #94a3b8; padding: 60px;">
                            <i class="fa-solid fa-folder-open d-block mb-3" style="font-size: 40px; opacity: 0.5;"></i>
                            No resources uploaded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection