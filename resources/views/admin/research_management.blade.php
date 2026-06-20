@extends('layouts.admin')

@section('title', 'Admin | Research Management')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    :root {
        --success-green: #52c41a;
    }

    .glass-card {
        background: white; border-radius: 16px; border: 1px solid #edf2f7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03); padding: 30px; margin-bottom: 24px;
    }

    .form-control {
        border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0; background: #f8fafc;
    }

    .btn-primary {
        background: #003366; border: none; padding: 12px;
        border-radius: 10px; font-weight: 600; transition: 0.3s; color: white;
    }

    .badge-approved {
        background: #f6ffed; color: var(--success-green); padding: 6px 12px;
        border-radius: 6px; font-weight: 700; font-size: 11px;
    }

    .btn-approve {
        color: var(--success-green); border: 1px solid var(--success-green);
        background: transparent; font-size: 11px; font-weight: 700;
        padding: 4px 10px; border-radius: 6px; transition: 0.3s;
    }
    .btn-approve:hover { background: var(--success-green); color: white; }

    .project-tag {
        background: #e6f7ff; color: #003366; padding: 4px 10px;
        border-radius: 5px; font-size: 12px; font-weight: 600;
    }

    .project-item {
        display: flex; align-items: center;
        padding: 10px 0; border-bottom: 1px solid #f1f5f9;
    }
    .project-item:last-child { border-bottom: none; }
</style>

<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-weight: 700; color: #001f3f;">
            <i class="fa-solid fa-microscope text-primary me-2"></i> Research Management
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="border-radius: 12px;">
            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        {{-- Left Column: Create and Active List --}}
        <div class="col-md-4">
            <div class="glass-card">
                <h5 class="mb-4" style="font-weight: 700;">Broadcast New Project</h5>
                <form action="{{ route('admin.research.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">PROJECT TITLE</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. AI in Education" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">DESCRIPTION</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Explain the research goals..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-paper-plane me-2"></i> Post Opportunity
                    </button>
                </form>
            </div>

            <div class="glass-card">
                <h5 class="mb-3" style="font-weight: 700; font-size: 16px;">Active Opportunities</h5>
                @php $allProjects = \DB::table('research_opportunities')->orderBy('created_at', 'desc')->get(); @endphp
                <div class="project-list">
                    @forelse($allProjects as $proj)
                        <div class="project-item">
                            <span class="small text-truncate" style="max-width: 100%;">
                                <i class="fa-solid fa-circle-dot text-success me-2" style="font-size: 8px;"></i>
                                {{ $proj->title }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted small">No active projects yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right Column: Applications Table --}}
        <div class="col-md-8">
            <div class="glass-card">
                <h5 class="mb-4" style="font-weight: 700;">Student Interest Registry</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Project Title</th>
                                <th>Applied Date</th>
                                <th>Action / Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; color: #001f3f;">{{ $app->student_name }}</div>
                                        <div class="text-muted small">{{ $app->student_email }}</div>
                                    </td>
                                    <td>
                                        <span class="project-tag">{{ $app->project_name }}</span>
                                    </td>
                                    <td class="text-muted small">
                                        {{ date('M d, Y', strtotime($app->applied_on)) }}
                                    </td>
                                    <td>
                                        {{-- Updated to check for 'accepted' status as per database enum --}}
                                        @if($app->application_status == 'pending')
                                            <form action="{{ route('admin.research.updateStatus', $app->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-approve">
                                                    <i class="fa-solid fa-check me-1"></i> Approve
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge-approved">
                                                <i class="fa-solid fa-circle-check me-1"></i> Accepted
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="fa-solid fa-inbox d-block mb-3 text-muted" style="font-size: 30px;"></i>
                                        <span class="text-muted">No applications received yet.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection