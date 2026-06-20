@extends('layouts.admin')

@section('title', 'Application Desk | UNI_ADMIN')

@section('content')
<style>
    .main-content { padding: 40px; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
    .page-header h2 { color: var(--dark-navy); font-weight: 700; font-size: 26px; }

    /* --- TABLE DESIGN --- */
    .table-container {
        background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden; border: 1px solid #e2e8f0;
    }
    table { width: 100%; border-collapse: collapse; }
    th { 
        background: #f8fafc; color: #64748b; font-size: 12px; font-weight: 700; 
        text-transform: uppercase; padding: 18px 20px; text-align: left; letter-spacing: 0.5px;
    }
    td { padding: 18px 20px; border-bottom: 1px solid #f1f5f9; font-size: 14px; vertical-align: middle; }
    
    /* --- STATUS BADGES --- */
    .status-badge {
        padding: 6px 12px; border-radius: 6px; font-size: 11px; font-weight: 700;
        display: inline-flex; align-items: center; gap: 5px; text-transform: uppercase;
    }
    .status-badge.pending { background: #fff7e6; color: var(--warning); }
    .status-badge.accepted { background: #f6ffed; color: var(--success); }
    .status-badge.rejected { background: #fff1f0; color: var(--danger); }

    /* --- ACTIONS --- */
    .action-btns { display: flex; gap: 8px; }
    .btn-action {
        width: 36px; height: 36px; border: none; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: 0.2s; color: white;
    }
    .btn-approve { background: var(--success); }
    .btn-approve:hover { background: #389e0d; transform: scale(1.1); }
    .btn-reject { background: var(--danger); }
    .btn-reject:hover { background: #cf1322; transform: scale(1.1); }

    .alert-custom {
        background: #e6f7ff; border: 1px solid #91d5ff; color: #0050b3;
        padding: 15px 20px; border-radius: 10px; margin-bottom: 25px;
        display: flex; align-items: center; gap: 10px; font-weight: 500;
    }
</style>

<div class="main-content">
    <div class="page-header animate__animated animate__fadeInDown">
        <div>
            <h2>Admission Queue</h2>
            <p style="color: #64748b; font-size: 14px;">Review and process incoming student applications.</p>
        </div>
        <div style="background: white; padding: 12px 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
            <span style="font-size: 13px; color: #64748b; font-weight: 500;">Total Pending: </span>
            <strong style="color: var(--warning); font-size: 18px; margin-left: 5px;">
                {{ $applications->where('status', 'pending')->count() }}
            </strong>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-custom animate__animated animate__fadeIn">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container animate__animated animate__fadeInUp">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Candidate Info</th>
                        <th>Applied Program</th>
                        <th>Academic Records</th>
                        <th>Current Status</th>
                        <th>Quick Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: var(--dark-navy);">{{ $app->full_name }}</div>
                            <div style="color: #94a3b8; font-size: 12px;">
                                <i class="fa-regular fa-envelope me-1"></i> {{ $app->email }}
                            </div>
                        </td>
                        <td>
                            <span style="font-weight: 600; color: var(--primary);">
                                {{ $app->course->title ?? 'General Program' }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size: 13px;">
                                <span style="color: #64748b;">SSC:</span> <strong>{{ $app->ssc_result }}</strong> 
                                <span style="margin: 0 8px; color: #cbd5e1;">|</span>
                                <span style="color: #64748b;">HSC:</span> <strong>{{ $app->hsc_result }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $app->status }}">
                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> {{ $app->status }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                @if($app->status === 'pending')
                                    <form action="{{ route('admin.applications.update', $app->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn-action btn-approve" title="Approve Application">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.applications.update', $app->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn-action btn-reject" title="Reject Application">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                @else
                                    <span style="color: #cbd5e1; font-size: 12px; font-style: italic;">Processed</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 60px; color: #94a3b8;">
                            <i class="fa-solid fa-inbox d-block mb-3" style="font-size: 40px; opacity: 0.3;"></i>
                            No applications found in the records.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection