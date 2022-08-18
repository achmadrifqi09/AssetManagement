@extends('layout/index')

@section('title')
<title>Akun Saya</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/add-data-account.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
<h2>Akun Saya</h2>
@include('sweetalert::alert')
<div class="content-wrapper">
    <form action="/account-management/edit" method="POST">
        @method('PUT')
        @csrf
        <div class="wrap-input">
            <label for="name">Nama</label>
            <input type="text" class="form-data" id="name" name="name"  value="{{ old('name', auth()->user()->name) }}">
        </div>
        <div class="wrap-input">
            <label for="email">Email</label>
            <input type="email" autocomplete="off" class="form-data" id="email" name="email" required value="{{ old('email', auth()->user()->email) }}">
        </div>
       <div class="wrap-right-button mb-3">
            <a href="/account-management/update-password" class="text-link">Perbarui passowrd anda ?</a>
       </div>
        <div class="wrap-right-button mt-5">
            @if (auth()->user()->level == 'Administrator')
                <button  class="button-danger me-2"><a href="/">Batalkan</a></button>
            @else
                <button  class="button-danger me-2"><a href="/account-management">Batalkan</a></button>
            @endif
           
            <button type="submit" class="button-primary">Simpan</button>
        </div>
    </form>
</div>


@endsection

@section('content-delivery-js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $(document).ready(function () {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    });
</script>
@endsection
