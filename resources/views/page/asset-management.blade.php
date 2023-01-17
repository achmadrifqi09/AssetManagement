@extends('layout/index')

@section('title')
<title>Kelola Aset</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('/css/table.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection


@section('view-of-content')
<h2>Kelola Aset</h2>
@include('sweetalert::alert')
<div class="content-wrapper">
    <div class="wrap-componet-menus">
        <p>Pilihan Menu</p>
        <div class="wrapper-button">
            <div class="row row-cols-auto gy-4">
                <div class="col">
                    <a class="button-primary mt-2" href="/asset-management/add-asset-data">Tambah Data</a>
                </div>
                <div class="col">
                    <a class="button-primary mt-2" data-bs-toggle="modal" data-bs-target="#addDataModal">Import Excel</a>
                </div>
                <div class="col">
                    <a class="button-primary mt-2" role="button" data-bs-toggle="modal" data-bs-target="#formExportModal">Export Excel</a>
                </div>
                <div class="col">
                    <a class="button-primary mt-2" data-bs-toggle="modal" data-bs-target="#formExportModalPDF">Eksport PDF / Print</a>
                </div>
                <div class="col">
                    <a class="button-primary mt-2" data-bs-toggle="modal" data-bs-target="#formExportRecapitulation">Rekapitulasi</a>
                </div>
              </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addDataModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title mb-3">Import Data</h5>
                <form action="/asset-management/import-data" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="wrap-input">
                        <label for="item_category">Kategori Barang</label>
                        <select name="item_category" id="item_category" required>
                            <option value="Berwujud">Berwujud</option>
                            <option value="Tak Berwujud">Tak Berwujud</option>
                        </select>
                    </div>
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

<div class="modal fade" id="formExportModal" tabindex="-1" aria-labelledby="formExportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formExportModalLabel">Export File Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/asset-management/export-data" method="POST">
            @csrf
              <div class="wrap-input">
                    <label for="category">Kategori Barang</label>
                    <select name="category" id="category" required>
                        <option value="Berwujud">Berwujud</option>
                        <option value="Tak Berwujud">Tak Berwujud</option>
                    </select>
                </div>
                <div class="wrap-input">
                    <label for="name">Nama Barang / Merk</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="input-two-column">
                    <div class="wrap-input">
                        <label for="start_year">Dari Tahun</label>
                        <select name="start_year" id="start_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                       
                    </div>
                    <div class="wrap-input ms-2">
                        <label for="end_year">Sampai Tahun</label>
                        <select name="end_year" id="end_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <button type="submit" class="button-primary" data-bs-dismiss="modal">Export</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="formExportModalPDF" tabindex="-1" aria-labelledby="formExportModalPDFLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formExportModalPDFLabel">Export File PDF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/asset-management/export-data-pdf" method="POST">
            @csrf
                <div class="wrap-input">
                    <label for="category">Kategori Barang</label>
                    <select name="category" id="category" required>
                        <option value="Berwujud">Berwujud</option>
                        <option value="Tak Berwujud">Tak Berwujud</option>
                    </select>
                </div>
                <div class="wrap-input mt-4">
                    <label for="title">Judul Berkas</label>
                    <input type="text" name="title" id="title">
                </div>
                <div class="wrap-input mt-4">
                    <label for="name">Nama Barang / Merk</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="wrap-input">
                    <label for="user">Pengguna</label>
                    <select name="user" id="user">
                        <option value="">-</option>
                        @foreach ($employees as $employee)
                            
                        <option value="{{$employee->name}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-two-column">
                    <div class="wrap-input">
                        <label for="start_year">Dari Tahun</label>
                        <select name="start_year" id="start_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                       
                    </div>
                    <div class="wrap-input ms-2">
                        <label for="end_year">Sampai Tahun</label>
                        <select name="end_year" id="end_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="button-primary" data-bs-dismiss="modal">Export</button>
            </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="formExportRecapitulation" tabindex="-1" aria-labelledby="formExportRecapitulationLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formExportRecapitulationLabel">Export File Rekapitulasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/asset-management/recapitulation" method="POST">
            @csrf
                <div class="wrap-input">
                    <label for="category">Kategori Barang</label>
                    <select name="category" id="category" required>
                        <option value="Berwujud">Berwujud</option>
                        <option value="Tak Berwujud">Tak Berwujud</option>
                    </select>
                </div>
                <div class="wrap-input">
                    <label for="name">Nama Barang / Merk</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="input-two-column">
                    <div class="wrap-input">
                        <label for="start_year">Dari Tahun</label>
                        <select name="start_year" id="start_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                       
                    </div>
                    <div class="wrap-input ms-2">
                        <label for="end_year">Sampai Tahun</label>
                        <select name="end_year" id="end_year" >
                            @foreach ($itemsYear as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="button-primary" data-bs-dismiss="modal">Export</button>
            </form>
        </div>
      </div>
    </div>
  </div>


<div class="content-wrapper mt-4">
    <div class="box-table">
        <h5 class="text-center">Tabel Barang Berwujud</h5>
        <table id="example" class=" nowrap table" style="width:100%">
            <thead>
                <tr>
                    <th>BAST</th>
                    <th>Bukti Fisik</th>
                    <th>Aksi</th>
                    <th>Kode Barang</th>
                    <th>Kode Register</th>
                    <th>Kode Internal</th>
                    <th>Nama Barang</th>
                    <th>Merk/Type</th>
                    <th>No Sertif/No Pabrik/Casis/Mesi</th>
                    <th>Bahan</th>
                    <th>Asal Barang/Cara Perolehan</th>
                    <th>Tahun</th>
                    <th>Ukuran</th>
                    <th>Keadaan Barang</th>
                    <th>Satuan</th>
                    <th>Jumlah</th>
                    <th>Digunakan</th>
                    <th>Harga Barang</th>
                    <th>Pengguna</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($tangibleAssets as $tangibleAsset)
                <div class="modal fade" id="practice_modal">
                    <div class="modal-dialog">
                        <p class="show-data"></p>
                    </div>
                </div>

                <tr>
                    <td>
                        @if ($tangibleAsset->file_bast == null)
                            <a href="/asset-management/show-bast/{{ $tangibleAsset->id }}" class="button-danger" data-bs-toggle="tooltip" data-bs-title="Lihat BAST"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @else
                            <a href="/asset-management/show-bast/{{ $tangibleAsset->id }}" class="button-primary" data-bs-toggle="tooltip" data-bs-title="Lihat BAST"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @endif
                    </td>
                    <td>
                        @if ($tangibleAsset->physical_evidence == null)
                            <a href="/asset-management/show-image/{{ $tangibleAsset->id}}" class="button-danger" data-bs-toggle="tooltip" data-bs-title="Lihat Bukti Fisik"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @else
                            
                            <a href="/asset-management/show-image/{{ $tangibleAsset->id}}" class="button-primary" data-bs-toggle="tooltip" data-bs-title="Lihat Bukti Fisik"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @endif

                    </td>
                    <td>
                        <a class="button-warning" href="/asset-management/{{ $tangibleAsset->id }}/edit" data-bs-toggle="tooltip" data-bs-title="Update Aset"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <form action="/asset-management/{{ $tangibleAsset->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="button-danger" onclick="return confirm('Anda yakin menghapus data asset {{ $tangibleAsset->item_name }} ?')" data-bs-toggle="tooltip" data-bs-title="Hapus Asset"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        <a class="button-warm" href="/asset-management/label/{{ $tangibleAsset->id }}" data-bs-toggle="tooltip" data-bs-title="Cetak Label"><i class="fa fa-tag" aria-hidden="true"></i></a>
                    </td>
                    <td>{{ $tangibleAsset->item_code }}</td>
                    <td>{{ $tangibleAsset->registration }}</td>
                    <td>{{ $tangibleAsset->internal_code }}</td>
                    <td>{{ $tangibleAsset->item_name }}</td>
                    <td>{{ $tangibleAsset->brand }}</td>
                    <td>{{ $tangibleAsset->certification_number }}</td>
                    <td>{{ $tangibleAsset->ingredient }}</td>
                    <td>{{ $tangibleAsset->how_to_earn }}</td>
                    <td>{{ $tangibleAsset->item_year }}</td>
                    <td>{{ $tangibleAsset->item_size }}</td>
                    <td>{{ $tangibleAsset->item_condition }}</td>
                    <td>{{ $tangibleAsset->unit }}</td>
                    <td>{{ $tangibleAsset->total }}</td>
                    <td>{{ $tangibleAsset->used }}</td>
                    <td>{{ "Rp " . number_format($tangibleAsset->price ,2,',','.');}}</td>
                    <td>{{ $tangibleAsset->user }}</td>
                    <td>{{ $tangibleAsset->location }}</td>
                    <td>{{ $tangibleAsset->description }}</td>
                    
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <i>*Jika tombol 'TAMPILKAN' kolom BAST berwarna merah menandakan belum ada file yang di unggah</i><br>
    <i>*Jika tombol 'LIHAT' kolom Bukti Fisik berwarna merah menandakan belum ada file yang di unggah</i>
</div>


<div class="content-wrapper mt-4">
    <div class="box-table">
        <h5 class="text-center">Tabel Barang Tak Berwujud</h5>
        <table id="table-2" class=" nowrap table" style="width:100%">
            <thead>
                <tr>
                    <th>BAST</th>
                    <th>Bukti Fisik</th>
                    <th>Aksi</th>
                    <th>Jenis Barang / Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Registrasi</th>
                    <th>Kode Internal</th>
                    <th>Tahun Pengadaan</th>
                    <th>Judul / Nama</th>
                    <th>Penctipta</th>
                    <th>Spesifikasi</th>
                    <th>Kondisi</th>
                    <th>Asal Usul</th>
                    <th>Pengguna</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($intangibleAssets as $intangibleAsset)

                <tr>
                    <td>
                        @if ($intangibleAsset->file_bast == null)
                            <a href="/asset-management/show-bast/{{ $intangibleAsset->id }}" class="button-danger" data-bs-toggle="tooltip" data-bs-title="Lihat BAST"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @else
                            <a href="/asset-management/show-bast/{{ $intangibleAsset->id }}" class="button-primary" data-bs-toggle="tooltip" data-bs-title="Lihat BAST"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @endif
                       
                    </td>
                    <td>
                        @if ( $intangibleAsset->physical_evidence == null)
                            <a href="/asset-management/show-image/{{ $intangibleAsset->id}}"
                            class="button-danger" data-bs-toggle="tooltip" data-bs-title="Lihat Bukti Fisik"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @else
                            <a href="/asset-management/show-image/{{ $intangibleAsset->id}}"
                            class="button-primary" data-bs-toggle="tooltip" data-bs-title="Lihat Bukti Fisik"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        @endif
                    </td>
                    <td>
                        <a class="button-warning" href="/asset-management/{{ $intangibleAsset->id }}/edit" data-bs-toggle="tooltip" data-bs-title="Update Aset"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <form action="/asset-management/{{ $intangibleAsset->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="button-danger" onclick="return confirm('Anda yakin menghapus data asset {{ $intangibleAsset->item_name }} ?')" data-bs-toggle="tooltip" data-bs-title="Hapus Aset"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        <a class="button-warm" href="/asset-management/label/{{ $intangibleAsset->id }}" data-bs-toggle="tooltip" data-bs-title="Cetak Label"><i class="fa fa-tag" aria-hidden="true"></i></a>
                    </td>
                    <td>{{ $intangibleAsset->item_name }}</td>
                    <td>{{ $intangibleAsset->item_code }}</td>
                    <td>{{ $intangibleAsset->registration }}</td>
                    <td>{{ $intangibleAsset->internal_code }}</td>
                    <td>{{ $intangibleAsset->item_year }}</td>
                    <td>{{ $intangibleAsset->title }}</td>
                    <td>{{ $intangibleAsset->creator }}</td>
                    <td>{{ $intangibleAsset->spesification }}</td>
                    <td>{{ $intangibleAsset->item_condition }}</td>
                    <td>{{ $intangibleAsset->how_to_earn }}</td>
                    <td>{{ $intangibleAsset->user }}</td>
                    <td>{{ "Rp " . number_format($intangibleAsset->price ,2,',','.');}}</td>
                    <td>{{ $intangibleAsset->description }}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <i>*Jika tombol 'TAMPILKAN' kolom BAST berwarna merah menandakan belum ada file yang di unggah</i><br>
    <i>*Jika tombol 'LIHAT' kolom Bukti Fisik berwarna merah menandakan belum ada file yang di unggah</i>
</div>


@endsection

@section('content-delivery-js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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
    });

    $(document).ready(function () {
        const date = new Date();

        $('#table-2').DataTable({
            "scrollX": true,
            "info": false,
            "bLengthChange": false,
            pagingType: "numbers",
        });

        

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                // location.reload(true);
            });
        }, 2000);
    });
   
</script>
@endsection
