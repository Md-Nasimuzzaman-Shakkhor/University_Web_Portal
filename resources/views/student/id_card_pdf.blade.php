<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            margin: 0; 
            padding: 0;
            background-color: #ffffff;
        }
        
        .id-card {
            width: 350px;
            height: 520px;
            /* CHANGE BACKGROUND COLOR HERE */
            background-color: #002147; 
            margin: 20px auto;
            border-radius: 15px;
            text-align: center;
            color: white;
            position: relative;
        }

        .university-name {
            padding: 30px 0 10px 0;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #fbbf24; /* Gold text */
        }

        .photo-box {
            margin: 20px auto;
        }

        .photo-box img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            border: 4px solid white;
            object-fit: cover;
        }

        .student-name {
            font-size: 24px;
            margin: 10px 0;
            text-transform: uppercase;
            font-weight: 900;
        }

        .student-dept {
            font-size: 14px;
            color: #fbbf24;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .details-grid {
            width: 80%;
            margin: 0 auto;
            text-align: left;
            font-size: 12px;
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 20px;
        }

        .detail-row {
            margin-bottom: 10px;
            display: block;
        }

        .label {
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            font-size: 10px;
            margin-bottom: 2px;
        }

        .value {
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0,0,0,0.2);
            padding: 15px 0;
            font-size: 10px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    </style>
</head>
<body>

    <div class="id-card">
        <div class="university-name">UNIVERSITY PORTAL</div>
        
        <div class="photo-box">
            <img src="{{ $photo }}" alt="Student Photo">
        </div>

        <h1 class="student-name">{{ $name }}</h1>
        <p class="student-dept">{{ $course }}</p>

        <div class="details-grid">
            <div class="detail-row">
                <div class="label">Student ID</div>
                <div class="value">#{{ str_pad($id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            
            <table width="100%">
                <tr>
                    <td>
                        <div class="label">Blood Group</div>
                        <div class="value">{{ $blood_group }}</div>
                    </td>
                    <td>
                        <div class="label">Contact</div>
                        <div class="value">{{ $emergency_contact }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            OFFICIAL DIGITAL STUDENT IDENTIFICATION • VALID UNTIL 2028
        </div>
    </div>

</body>
</html>