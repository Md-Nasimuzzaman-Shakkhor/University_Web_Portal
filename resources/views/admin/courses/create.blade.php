@extends('layouts.admin')

@section('title', 'Add Department | UNI_ADMIN')

@section('content')
<style>
    .main-content { 
        padding: 40px; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
    }
    
    .form-card { 
        background: white; 
        padding: 40px; 
        width: 100%; 
        max-width: 600px; 
        border-radius: 16px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        border: 1px solid #e2e8f0;
    }

    .form-header { margin-bottom: 30px; border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; }
    .form-header h2 { color: var(--dark-navy); font-size: 24px; font-weight: 700; }
    .form-header p { color: #64748b; font-size: 14px; margin-top: 5px; }

    label { display: block; font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
    
    input, textarea { 
        width: 100%; 
        padding: 12px 15px; 
        margin-bottom: 20px; 
        border: 2px solid #f1f5f9; 
        border-radius: 10px; 
        box-sizing: border-box; 
        font-family: 'Inter', sans-serif;
        transition: 0.3s;
        background: #f8fafc;
    }

    input:focus, textarea:focus { 
        border-color: var(--primary); 
        outline: none; 
        background: white;
        box-shadow: 0 0 0 4px rgba(24, 144, 255, 0.1);
    }

    .btn-group { display: flex; gap: 15px; margin-top: 10px; }

    .btn-save { 
        background: var(--primary); 
        color: white; 
        border: none; 
        padding: 15px 25px; 
        flex: 2;
        border-radius: 10px; 
        cursor: pointer; 
        font-weight: 700;
        font-size: 15px;
        transition: 0.3s;
    }

    .btn-save:hover { background: #0050b3; transform: translateY(-2px); }

    .btn-cancel { 
        text-align: center;
        text-decoration: none;
        color: #64748b;
        padding: 15px;
        flex: 1;
        border-radius: 10px;
        background: #f1f5f9;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-cancel:hover { background: #e2e8f0; color: var(--dark-navy); }
</style>

<div class="main-content">
    <div class="form-card animate__animated animate__fadeInUp">
        <div class="form-header">
            <h2><i class="fa-solid fa-graduation-cap" style="color: var(--primary); margin-right: 10px;"></i>Add New Department</h2>
            <p>Enter the details below to establish a new academic faculty.</p>
        </div>

        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf
            
            <label for="title">Department Title</label>
            <input type="text" name="title" id="title" placeholder="e.g., Computer Science & Engineering" required>

            <label for="price">Initial Admission Fee ($)</label>
            <input type="number" name="price" id="price" placeholder="e.g., 1500" required>

            <label for="description">Short Overview</label>
            <textarea name="description" id="description" placeholder="Provide a brief summary of the department's focus..." rows="5" required></textarea>

            <div class="btn-group">
                <a href="{{ route('admin.courses.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-circle-plus me-2"></i> Create Department
                </button>
            </div>
        </form>
    </div>
</div>
@endsection