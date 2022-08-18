<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/img/logo-pemkab.svg') }}">
</head>

<body>
    <div class="content-wrapper d-flex">
        <div class="side-left">
            <div class="wrapper-position-brand d-flex justify-content-center align-items-center">
                <div class="brand-wrapper">
                    <div class="box-of-brand d-flex align-items-center">
                        <div class="wrapper-logo">
                            <img src="{{ asset('assets/img/logo-pemkab.svg') }}" alt="Logo PEMKAB">
                        </div>
                        <div class="typography-box">
                            <p class="text-light">Monitoring Distribusi Aset</p>
                            <h2 class="second-typography">DINAS KOMUNIKASI <br>DAN INFORMATIKA </h2>
                            <p class="third-typography">Kabupaten Malang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="side-right pb-5">
            <div class="wrapper-position-form d-flex justify-content-center align-items-center">
                <div class="form-wrapper">
                    <div class="wrapper-mobile-only-logo justify-content-center flex-column align-items-center mt-5 mb-3">
                        <img src="{{ asset('assets/img/logo-pemkab.svg') }}" alt="Logo PEMKAB">
                        <p class="text-light">Monitoring Distribusi Aset</p>
                        <h4 class="second-typography">DINAS KOMUNIKASI <br>DAN INFORMATIKA </h4>
                        <p class="text-light">Kabupaten Malang</p>
                    </div>
                    <h2 class="title-form text-center">Selamat Datang 👋</h2> 
                    <p class="desc-form text-center">Silakan masukkan detail Anda.</p>
                
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" placeholder="Alamat Email" id="email" name="email" value="{{ old('email') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                        </div>
                        <div class="box-error">
                            @if (session()->has('loginError'))
                                <p class="error-text">{{ session('loginError') }}</p>
                            @endif
                        </div>
                        <button type="submit" class="btn-submit mt-5">Submit</button>

                       
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>