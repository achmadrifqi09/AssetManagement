@extends('layout/index')

@section('title')
<title>Tambah Akun</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/add-data-account.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
<h2>Tambah Akun</h2>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="content-wrapper">
    <form action="/account-management/add-account" method="POST">
        @csrf
        <div class="wrap-input">
            <label for="name">Nama</label>
            <input type="text" class="form-data" id="name" name="name"  value="{{ old('name') }}"  autocomplete="off">
        </div>
        <div class="wrap-input">
            <label for="email">Email</label>
            <input type="email" autocomplete="off" class="form-data" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div class="wrap-input">
            <label for="password">Password</label>
            <input type="password" autocomplete="new-password" class="form-data @error('password') is-invalid @enderror" id="password" name="password" required>
            <p><i>*Password minimal 6 karakter.</i></p>
        </div>
        <div class="wrap-input">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" class="form-data" id="confirm_password" name="confirm_password" name="confirm_password" required>
            <p><i>*Password minimal 6 karakter.</i></p>
        </div>
        @error('password')
            <p class="error-message"><i>Password harus lebih dari 6 karakter</i></p>
        @enderror
        @error('confirm_password')
             <p class="error-message"><i>Konfirmasi password harus sama dengan password</i></p>
        @enderror
        <div class="wrap-right-button">
            <button  class="button-danger me-2"><a href="/account-management">Batalkan</a></button>
            <button type="submit" class="button-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection

@section('content-delivery-js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- buttton -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="{{ asset('/js/table.js') }}"></script>

@endsection
