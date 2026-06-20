<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; text-align: center; padding: 50px; }
        .border { border: 10px solid #782121; padding: 50px; }
        h1 { font-size: 50px; color: #333; }
        .content { font-size: 25px; margin-top: 30px; }
        .course-name { font-weight: bold; color: #782121; text-decoration: underline; }
        .footer { margin-top: 100px; }
    </style>
</head>
<body>
    <div class="border">
        <h1>CERTIFICATE</h1>
        <p class="content">This is to certify that</p>
        <h2>{{ $name }}</h2>
        <p class="content">has successfully completed the course</p>
        <h3 class="course-name">{{ $course }}</h3>
        <div class="footer">
            <p>Issued on: {{ $date }}</p>
            <p>____________________<br>University Registrar</p>
        </div>
    </div>
</body>
</html>