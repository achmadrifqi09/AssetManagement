@extends('layout/index')

@section('title')
   <title>Update Data Karyawan</title>
@endsection

@section('content-delivery')
    <link rel="stylesheet" href="{{ asset('/css/update-data-employee.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
    <h2>Update Data Karyawan</h2>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        </div>
        </div>
    </div>
    <div class="content-wrapper">
        <form method="POST" action="/employee-list/{{ $employee->id }}/edit" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="wrap-input">
                <label for="name">Nama*</label>
                <input type="text" id="name" value="{{ old('name' , $employee->name) }}" required name="name">
            </div>
            <div class="wrap-input">
                <label for="rank">Pangkat</label>
                <input type="text" id="rank" name="rank" value="{{ old('rank', $employee->rank) }}">
            </div>
            <div class="wrap-input">
                <label for="position">Jabatan</label>
                <input type="text" id="position" name="position" value="{{ old('position', $employee->position) }}">
            </div>
            <div class="wrap-input">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip', $employee->nip) }}">
            </div>
            <div class="wrap-input">
                <label for="group">Golongan</label>
                <input type="text" id="group" name="group" value="{{ old('group', $employee->group) }}">
            </div>
            <div class="wrap-right-button">
                <button type="reset"class="button-danger me-2"><a href="/employee-list">Batalkan</a></button>
                <button type="submit"class="button-primary">Simpan</button>
            </div>
        </form>
    </div>
        
@endsection

@section('content-delivery-js')
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="{{ asset('/js/table.js') }}"></script>

@endsection