@extends('layouts.admin')

@section('title', 'Manage Departments | UNI_ADMIN')

@section('content')
<style>
    .main-content { padding: 40px; }
    
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .page-header h2 { color: var(--dark-navy); font-weight: 700; font-size: 26px; }

    /* --- TABLE CARD --- */
    .card {
        background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden; border: 1px solid #e2e8f0;
    }
    table { width: 100%; border-collapse: collapse; }
    th { 
        background: #f8fafc; color: #64748b; font-size: 12px; font-weight: 700; 
        text-transform: uppercase; padding: 18px 20px; text-align: left;
    }
    td { padding: 18px 20px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #334155; }
    
    .price-badge {
        background: #e6f7ff; color: var(--primary); padding: 5px 12px; 
        border-radius: 6px; font-weight: 700; font-size: 13px;
    }

    /* --- BUTTONS --- */
    .btn-add { 
        background: var(--primary); color: white; padding: 12px 20px; 
        text-decoration: none; border-radius: 10px; font-weight: 600; 
        display: flex; align-items: center; gap: 8px; transition: 0.3s;
    }
    .btn-add:hover { background: #40a9ff; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(24, 144, 255, 0.3); }

    .action-link { text-decoration: none; margin-right: 15px; font-weight: 600; font-size: 13px; transition: 0.2s; }
    .edit-link { color: var(--primary); }
    .delete-btn { color: var(--danger); background: none; border: none; cursor: pointer; font-weight: 600; font-size: 13px; }
    .action-link:hover, .delete-btn:hover { opacity: 0.7; }

    /* --- ALERT --- */
    .alert-success {
        background: #f6ffed; border: 1px solid #b7eb8f; color: #389e0d;
        padding: 12px 20px; border-radius: 8px; margin-bottom: 25px; font-weight: 500;
    }
</style>

<div class="main-content">
    <div class="page-header animate__animated animate__fadeInDown">
        <div>
            <h2>University Departments</h2>
            <p style="color: #64748b; font-size: 14px;">View and manage all available academic courses.</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Add New Department
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success animate__animated animate__fadeIn">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card animate__animated animate__fadeInUp">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Department Title</th>
                        <th>Admission Fee</th>
                        <th>Action Center</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: var(--dark-navy);">{{ $course->title }}</div>
                            <div style="color: #94a3b8; font-size: 12px;">ID: #DEPT-{{ 1000 + $course->id }}</div>
                        </td>
                        <td>
                            <span class="price-badge">${{ number_format($course->price) }}</span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="action-link edit-link">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Archive this department?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 60px;">
                            <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                            <p style="color: #94a3b8;">No departments available yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection