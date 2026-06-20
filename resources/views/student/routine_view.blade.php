@extends('layouts.student')

@section('content')
<style>
    .routine-container { background: white; border: 2px solid #001529; border-radius: 0; position: relative; padding: 40px; box-shadow: 10px 10px 0px #001529; }
    .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-45deg); font-size: 80px; color: rgba(0,0,0,0.03); font-weight: 900; pointer-events: none; white-space: nowrap; }
    .table-routine th { background: #001529 !important; color: white !important; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; }
    .table-routine td { border: 1px solid #ddd !important; vertical-align: middle; height: 70px; }
    .class-box { font-weight: 700; color: #001529; line-height: 1.2; }
    .room-tag { display: block; font-size: 10px; color: #d46b08; margin-top: 4px; font-weight: 800; }
    @media print { .no-print { display: none; } .routine-container { box-shadow: none; border: 1px solid #000; } }
</style>

<div class="container py-5">
    <div class="routine-container animate__animated animate__fadeIn">
        <div class="watermark">OFFICIAL SCHEDULE</div>
        
        <div class="row align-items-center mb-4">
            <div class="col-2 text-center">
                <i class="fa-solid fa-building-columns" style="font-size: 60px; color: #001529;"></i>
            </div>
            <div class="col-8 text-center">
                <h1 style="font-weight: 900; margin: 0; color: #001529; text-transform: uppercase;">University Academic Council</h1>
                <p style="letter-spacing: 3px; font-weight: 600; margin: 0;">OFFICIAL CLASS ROUTINE - SPRING 2026</p>
                <div style="width: 100px; height: 4px; background: #001529; margin: 10px auto;"></div>
            </div>
            <div class="col-2 text-end">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ url()->current() }}" alt="QR Verification">
            </div>
        </div>

        <div style="background: #f0f2f5; padding: 15px; display: flex; justify-content: space-between; margin-bottom: 30px; border: 1px solid #001529;">
            <span><strong>PROGRAM:</strong> {{ strtoupper($course->title) }}</span>
            <span><strong>STUDENT:</strong> {{ strtoupper(Auth::user()->name) }}</span>
            <span><strong>ISSUED:</strong> {{ date('d-M-Y') }}</span>
        </div>

        @if($myRoutine)
            <table class="table table-bordered table-routine text-center">
                <thead>
                    <tr>
                        <th>DAY</th>
                        <th>09:00 AM - 10:30 AM</th>
                        <th>11:00 AM - 12:30 PM</th>
                        <th>02:00 PM - 03:30 PM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myRoutine as $day => $classes)
                        <tr>
                            <td style="background: #f8fafc; font-weight: 900; width: 120px;">{{ strtoupper($day) }}</td>
                            @foreach(['09:00', '11:00', '02:00'] as $time)
                                <td>
                                    @if(isset($classes[$time]))
                                        @php $parts = explode('[', $classes[$time]); @endphp
                                        <div class="class-box">{{ $parts[0] }}</div>
                                        @if(isset($parts[1]))
                                            <span class="room-tag">[{{ $parts[1] }}</span>
                                        @endif
                                    @else
                                        <span style="color: #ccc; font-style: italic; font-size: 11px;">RECESS</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row mt-5 pt-4 text-center">
                <div class="col-4">
                    <p style="border-top: 1px solid #000; display: inline-block; width: 150px; padding-top: 5px;">Head of Dept.</p>
                </div>
                <div class="col-4">
                    <div style="border: 2px solid #cf1322; color: #cf1322; display: inline-block; padding: 5px 10px; font-weight: 900; transform: rotate(-5deg);">APPROVED</div>
                </div>
                <div class="col-4">
                    <p style="border-top: 1px solid #000; display: inline-block; width: 150px; padding-top: 5px;">Registrar Office</p>
                </div>
            </div>
        @endif

        <div class="mt-5 no-print d-flex gap-2">
            <a href="{{ url('/student/dashboard') }}" class="btn btn-dark px-4">Dashboard</a>
            <button onclick="window.print()" class="btn btn-primary px-4">Print Official Copy</button>
        </div>
    </div>
</div>
@endsection