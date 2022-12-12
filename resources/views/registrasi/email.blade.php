<!DOCTYPE html>
<html>
<head>
    <title>SiPenata</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <a href="http://127.0.0.1:8000/verifikasi/{{ $details['token'] }}"><button type="button" style="fill: blue">Aktifasi Akun</button></a>
   
    <p>Thank you</p>
</body>
</html>