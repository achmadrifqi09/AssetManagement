@extends('layout/index')

@section('title')
<title>Perbarui Password</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/add-data-account.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
<h2>Perbarui Password</h2>
@include('sweetalert::alert')
<div class="content-wrapper">
    <form action="/account-management/update-password" method="POST">
        @csrf
        @method('PUT')
        <div class="wrap-input">
            <label for="old_password">Password Lama</label>
            <input type="password" autocomplete="new-password" class="form-data @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required value="{{ old('old_password') }}">
        </div>
        <div class="wrap-input">
            <label for="password">Password Baru</label>
            <input type="password" autocomplete="new-password" class="form-data @error('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password') }}">
            <p><i>*Password minimal 6 karakter.</i></p>
        </div>
        <div class="wrap-input">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <input type="password" class="form-data" id="confirm_password" name="confirm_password" name="confirm_password" required>
            <p><i>*Password minimal 6 karakter.</i></p>
        </div> 
        @error('password')
            <p class="error-message"><i>Password lama tidak sesuai.</i></p>
         @enderror
        @error('password')
            <p class="error-message"><i>Password harus lebih dari 6 karakter</i></p>
        @enderror
        @error('confirm_password')
             <p class="error-message"><i>Konfirmasi password harus sama dengan password</i></p>
        @enderror
        <div class="wrap-right-button">
            <button  class="button-danger me-2"><a href="/">Batalkan</a></button>
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

        window.setTimeout(function() {
            $(".error-message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 2000);
    });
</script>
@endsection
