<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="{{ asset('/css/error-page.css') }}">
    <link rel="icon" href="{{ asset('assets/img/logo-pemkab.svg') }}">
</head>

<body>
    <div class="container">
        
        <div class="wrapper-img">
            <img src="{{ asset('assets/img/img-404.png') }}" alt="404 error image">
        </div>
        <h1>Halaman Tidak Ditemukan</h1>
        <p>Mohon maaf, kami tidak dapat menemukan halaman tersebut</p>
        <button class="back-btn" onclick="history.back()">Kembali</button>
    </div>
  
</body>

</html>
