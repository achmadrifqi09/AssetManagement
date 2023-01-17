@extends('layout/index')

@section('title')
<title>Daftar Pengguna</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('/css/table.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
<h2>Kelola Pengguna</h2>
@include('sweetalert::alert')
<div class="content-wrapper">
    <div class="wrap-componet-menus">
        <p>Pilihan Menu</p>

        <div class="row row-cols-auto gy-4">
            <div class="col">
                <a class="button-primary me-2 mb-3" href="/employee-list/add-employee-data">
                    Tambah Data
                </a>
            </div>
            <div class="col">
                <a class="button-primary me-2 " data-bs-toggle="modal" data-bs-target="#addDataModal" role="button">
                    Import Data (Excel)
                </a>
            </div>
            <div class="col">
                <a href="/employee-list/export-data" class="button-primary">
                    Unduh Data Excel
                </a>
            </div>
            <div class="col">
                <a href="/employee-list/data-pdf" class="button-primary">
                   Eksport PDF / Print
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addDataModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title mb-3">Import Data</h5>
                <form action="/employee-list/import-data" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="wrap-file">
                        <div class="border-file">
                            <input name="file_excel" type="file" id="excel_data" hidden
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            <label for="excel_data" class="button-file">Pilih File</label>
                            <span id="file-chosen" class="ms-2">Tidak ada file</span>
                        </div>
                    </div>
                    <div class="wrap-button">
                        <button type="button" class="button-warm mt-3 me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button-primary mt-3" data-bs-dismiss="modal">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper mt-4">
    <div class="box-table">
        <table id="example" class=" nowrap table" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Pangkat</th>
                    <th>Golongan</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->nip }}</td>
                    <td>{{ $employee->rank }}</td>
                    <td>{{ $employee->group }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>
                        <a class="button-warning" href="/employee-list/{{ $employee->id }}/edit" data-bs-toggle="tooltip" data-bs-title="Update Pegawai"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <form action="/employee-list/{{ $employee->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="button-danger"
                                onclick="return confirm('Anda yakin menghapus data pengguna {{ $employee->name }} ?')" data-bs-toggle="tooltip" data-bs-title="Hapus Pegawai"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection

@section('content-delivery-js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="{{ asset('/js/table.js') }}"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))    

    const btn = document.getElementById('excel_data');
    const fileChosen = document.getElementById('file-chosen');
    btn.addEventListener('change', function () {
        fileChosen.textContent = this.files[0].name
    })

    $(document).ready(function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);
    })

</script>

@endsection
