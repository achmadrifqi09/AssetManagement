@extends('layout/index')

@section('title')
<title>Penyimpanan Riwayat BAST</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('/css/table.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('view-of-content')
<h2>Penyimpanan Riwayat BAST</h2>
@include('sweetalert::alert')
<div class="content-wrapper">
    <div class="wrap-componet-menus">
        <p>Pilihan Menu</p>
        <div class="row row-cols-auto gy-4">
            <div class="col">
                <a class="button-primary me-2 mb-3" data-bs-toggle="modal" data-bs-target="#addDataModal" role="button">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addDataModal"  aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title mb-3">Tambah File</h5>
                <form action="/docs-history" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="wrap-file">
                        <div class="border-file">
                            <input name="file" type="file" id="bast_data" hidden accept="application/pdf" required/>
                            <label for="bast_data" class="button-file">Pilih File</label>
                            <span id="file-chosen" class="ms-2">Tidak ada file</span>
                        </div>
                    </div>
                    <div class="input-two-column mt-3">
                        <div class="wrap-input me-1">
                            <label for="selectAsset">Nama Aset*</label>
                            <select class="select" name="asset" id="selectAsset" style="width:100%" required autofocus>
                               @foreach ($assets as $asset)
                                    @if (old('asset') == "$asset->item_name - $asset->registration - $asset->brand - $asset->item_year")
                                        <option value="{{ $asset->item_name }} - {{ $asset->registration }} - {{ $asset->brand }} - {{ $asset->item_year }}" selected>{{ $asset->item_name }} - {{ $asset->registration }} - {{ $asset->brand }} - {{ $asset->item_year }}</option>
                                    @else  
                                        <option value="{{ $asset->item_name }} - {{ $asset->registration }} - {{ $asset->brand }} - {{ $asset->item_year }}">{{ $asset->item_name }} - {{ $asset->registration }} - {{ $asset->brand }} - {{ $asset->item_year }}</option> 
                                    @endif
                               @endforeach
                            </select>
                        </div>
                        <div class="wrap-input ms-1">
                            <label for="selectEmployee">Pihak Yang Menerima*</label>
                            <select class="select" name="employee" id="selectEmployee" style="width:100%" required>
                               @foreach ($employees as $employee)
                                    @if (old('employee') == $employee->name)
                                        <option value="{{ $employee->name }}" selected>{{ $employee->name }}</option>
                                    @else
                                        <option value="{{ $employee->name }}">{{ $employee->name }}</option> 
                                    @endif
                                  
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="wrap-button">
                        <button type="button" class="button-warm mt-3 me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button-primary mt-3" data-bs-dismiss="modal">simpan</button>
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
                    <th>BAST</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historyData as $data)
                <tr>
                    <td>{{ $data->desc }}</td>
                    <td>
                        <a href="/docs-history/show/{{ $data->id }}" class="button-primary">Lihat</a>
                        <form action="/docs-history/delete/{{ $data->id }}/" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="button-danger" onclick="return confirm('Anda yakin menghapus data BAST {{ $data->desc }} ?')">Delete</button>
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
    <script src="{{ asset('/js/table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const btn = document.getElementById('bast_data');
        const fileChosen = document.getElementById('file-chosen');
        btn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name
        });

        $(document).ready(function () {
            $('.select').select2();
        });
    </script>
@endsection
