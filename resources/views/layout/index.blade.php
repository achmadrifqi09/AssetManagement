<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <link rel="icon" href="{{ asset('assets/img/logo-pemkab.svg') }}">
    @yield('title')
    <link rel="icon" href="{{ asset('public/assets/img/logo-pemkab.svg') }}">
    @yield('content-delivery')
</head>

<body id="body">

    <nav class="navigation-bar"">
        <div class="navigation-brand">
            <div class="wrapper-image-brand">
                <img src="{{ asset('assets/img/logo-pemkab.svg') }}" alt="Logo PEMKAB">
            </div>
            <div class="wrapper-text-brand ">
                <p class="brand-title">DINAS KOMINFO</p>
                <p class="brand-desc">Kabupaten Malang</p>
            </div>
        </div>
        <div class="navbar-menus d-flex flex-column align-content-between">
            <ul class="list-menus">
                <li class="navbar-link" id="dashboard">
                    <a href="/" class="wrapper-menu">
                        <img class="ic_menu" src="{{ asset('/assets/icon/ic_dashboard.svg') }}" alt="icon dashboard">
                        Dashboard</a>
                </li>
                <li class="navbar-link">
                    <a href="/asset-management" class="wrapper-menu" >
                        <img class="ic_menu" src="{{ asset('/assets/icon/ic_asset.svg') }}" alt="icon dashboard">
                        Asset Management</a>
                </li>
                <li class="navbar-link">
                    <a href="/bast" class="wrapper-menu">
                        <img class="ic_menu" src="{{ asset('/assets/icon/ic_bast.svg') }}" alt="icon asset">
                        BAST Aset</a>
                </li>
                @if (auth()->user()->level == 'Administrator')   
                    <li class="navbar-link">
                        <a href="/account-management" class="wrapper-menu">
                            <img class="ic_menu" src="{{ asset('assets/icon/ic_account.svg') }}" alt="icon account">
                            Kelola Akun</a>
                    </li>
                @endif
                <li class="navbar-link">
                    <a href="/employee-list" class="wrapper-menu">
                        <img class="ic_menu" src="{{ asset('assets/icon/ic_employee.svg') }}" alt="icon employee">Daftar Pengguna</a>
                </li>
                <li class="navbar-link">
                    <a href="/docs-history" class="wrapper-menu">
                        <img class="ic_menu" src="{{ asset('assets/icon/ic_history.svg') }}" alt="icon employee">Penyimpanan Riwayat BAST</a>
                </li>
            </ul>
            <div class="light-border mt-auto">
                <div class="box-user-login ">
                    <div class="wrapper-user-login">
                        <div class="wrapper-avatar">
                            <img class="avatar" src="{{ asset('assets/img/avatar.svg') }}" alt="">
                        </div>
                        <div class="wrapper-text-user-login">
                            <p class="user-login-desc">Login sebagai :</p>
                            <p class="user-login-name">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                   <form method="post" class="mt-3" action="/logout">
                        @csrf
                        <button class="btn-logout mt-2" type="submit">Logout</button>
                   </form>
                   <button class="btn-edit mt-2" type="submit"> <a href="/account-management/edit">Akun Saya</a> </button>
                </div>
            </div>
        </div>
        <div class="toggle-button">
            <input type="checkbox" id="toggle-nav">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <main class="content" id="content">
        @yield('view-of-content')
        <a href="" class="user-guide">
            <img src="{{ asset('assets/icon/user-guide.svg') }}" alt="user guide icon">
        </a>
    </main>


    <script src="{{ asset('/js/app.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @yield('content-delivery-js')
</body>

</html>
