@extends('layouts.student')

@section('title', 'Generate Student ID')

@section('content')
<style>
    /* Modern Color Palette */
    :root {
        --primary-deep: #002147;
        --accent-gold: #fbbf24;
        --soft-bg: #f1f5f9;
        --glass-white: rgba(255, 255, 255, 0.95);
    }

    body { background-color: var(--soft-bg); }

    .id-container {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 20px;
    }

    /* Informative Side Card */
    .guide-card {
        background: linear-gradient(135deg, var(--primary-deep) 0%, #004080 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        box-shadow: 0 20px 40px rgba(0, 33, 71, 0.3);
        position: sticky;
        top: 20px;
    }

    .guide-card h3 { color: var(--accent-gold); font-size: 24px; margin-bottom: 20px; }

    .requirement-badge {
        background: rgba(255, 255, 255, 0.1);
        padding: 10px 15px;
        border-radius: 12px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Modern Form Styling */
    .form-card {
        background: var(--glass-white);
        border-radius: 24px;
        padding: 45px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid white;
    }

    .section-title {
        color: var(--primary-deep);
        font-weight: 800;
        font-size: 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modern-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc;
        font-weight: 500;
    }

    .modern-input:focus {
        border-color: var(--accent-gold);
        background: white;
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.2);
        outline: none;
    }

    /* The "Vibrant" Button */
    .btn-generate {
        width: 100%;
        background: linear-gradient(135deg, var(--accent-gold) 0%, #f59e0b 100%);
        color: var(--primary-deep);
        padding: 18px;
        border: none;
        border-radius: 16px;
        font-weight: 800;
        font-size: 18px;
        cursor: pointer;
        margin-top: 30px;
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-generate:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4);
    }

    .file-upload-zone {
        border: 2px dashed #cbd5e1;
        background: #f1f5f9;
        padding: 30px;
        border-radius: 16px;
        text-align: center;
        transition: 0.3s;
        cursor: pointer;
    }

    .file-upload-zone:hover {
        border-color: var(--accent-gold);
        background: #fffdf5;
    }

    @media (max-width: 900px) { .id-container { grid-template-columns: 1fr; } }
</style>

<div class="id-container animate__animated animate__fadeIn">
    
    <div class="guide-panel">
        <div class="guide-card">
            <h3><i class="fa-solid fa-circle-info"></i> ID Portal</h3>
            <p style="opacity: 0.9; line-height: 1.6;">Welcome to the Digital ID Gateway. Your identity card is your key to the campus ecosystem.</p>
            
            <div style="margin: 30px 0;">
                <div class="requirement-badge"><i class="fa-solid fa-camera text-warning"></i> Passport Size Photo</div>
                <div class="requirement-badge"><i class="fa-solid fa-droplet text-danger"></i> Blood Group Details</div>
                <div class="requirement-badge"><i class="fa-solid fa-shield-halved text-success"></i> Emergency Contact</div>
            </div>

            <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 15px; font-size: 13px;">
                <p style="margin:0;"><i class="fa-solid fa-triangle-exclamation" style="color: var(--accent-gold);"></i> <strong>Final Step:</strong> Once generated, the PDF cannot be modified. Please double-check your entries.</p>
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-card">
            
            @if ($errors->any())
                <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #fecaca; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-weight: 600;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('student.id.generate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="section-title"><i class="fa-solid fa-user-graduate" style="color: var(--accent-gold);"></i> Academic Profile</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #94a3b8; margin-bottom: 5px; display: block;">FULL NAME</label>
                        <input type="text" value="{{ $user->name }}" disabled class="modern-input" style="opacity: 0.7;">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #94a3b8; margin-bottom: 5px; display: block;">FACULTY</label>
                        <input type="text" value="{{ $course->title ?? 'N/A' }}" disabled class="modern-input" style="opacity: 0.7;">
                    </div>
                </div>

                <div class="section-title"><i class="fa-solid fa-heart-pulse" style="color: #ef4444;"></i> Vital Information</div>
                <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #94a3b8; margin-bottom: 5px; display: block;">BLOOD GROUP</label>
                        <select name="blood_group" required class="modern-input">
                            <option value="">Select Group</option>
                            <option value="O+">A+</option><option value="AB+">A-</option>
                            <option value="A+">B+</option><option value="B+">B-</option>
                            <option value="O+">O+</option><option value="AB+">O-</option>
                            <option value="O+">AB+</option><option value="AB+">AB-</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #94a3b8; margin-bottom: 5px; display: block;">EMERGENCY PHONE</label>
                        <input type="text" name="emergency_contact" placeholder="+880 1XXX XXXXXX" required class="modern-input">
                    </div>
                </div>

                <div class="section-title"><i class="fa-solid fa-image" style="color: var(--accent-gold);"></i> Profile Display</div>
                <div class="file-upload-zone" onclick="document.getElementById('photoInput').click()">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 40px; color: var(--accent-gold); margin-bottom: 15px;"></i>
                    <h5 style="margin:0; color: var(--primary-deep);">Upload Passport Photo</h5>
                    <p style="font-size: 12px; color: #64748b;" id="fileName">Drag files here or click to browse</p>
                    <input type="file" name="photo" id="photoInput" hidden required onchange="updateFileName(this)">
                </div>

                <button type="submit" class="btn-generate">
                    <i class="fa-solid fa-certificate me-2"></i> Confirm & Generate ID
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            document.getElementById('fileName').innerHTML = `<span style="color: #059669; font-weight:700;">✓ ${fileName} selected</span>`;
        }
    }
</script>
@endsection