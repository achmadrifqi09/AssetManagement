@extends('layout/index')

@section('title')
    <title>BAST Aset</title>
@endsection

@section('content-delivery')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/table.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
    @include('sweetalert::alert')
    <h2>BAST Aset</h2>
    <div class="content-wrapper">
        <div class="wrap-componet-menus">
            <p>Pilihan Menu</p>
            <div class="wrapper-button">
                <div class="row row-cols-auto gy-4">
                    <div class="col">
                        <a class="button-primary mt-2" href="/bast/add-bast">Tambah Data</a>
                    </div>
                    <div class="col">
                        <a class="button-primary mt-2" href="/bast/trash-bast">Sampah BAST</a>
                    </div>
                  </div>
    
            </div>
        </div>
    </div>

    <div class="content-wrapper mt-4">
        <div class="box-table">
            <table id="example" class=" nowrap table" style="width:100%">
                <thead >
                    <tr>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Kode Barang</th>
                        <th>Registrasi</th>
                        <th>Pengguna</th>
                        <th>Penanggung Jawab</th>
                        <th>Sub Bag.Keuangan & Aset</th>
                        <th>Pengurus Barang Pengguna</th>
                        <th>BAST</th>
                        <th>Aksi</th>
                    </tr>
                </thead >
                <tbody >
                        @foreach ($distributions as $dist)
                            <tr>
                                <td>
                                    @foreach ($dist->assets as $asset)
                                        {{ $asset->item_name }}
                                        @break
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($dist->assets as $asset)
                                        {{ $asset->brand }}
                                        @break
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($dist->assets as $asset)
                                        {{ $asset->item_code }}
                                        @break
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($dist->assets as $asset)
                                        @if ($i++ < $dist->assets->count())
                                            {{ $asset->registration }}, 
                                        @else
                                            {{ $asset->registration }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $dist->employee->name }}</td>
                                <td>{{ $dist->supervisor->name }}</td>
                                <td>{{ $dist->financeasset->name }}</td>
                                <td>{{ $dist->itemmanager->name }}</td>
                                <td>
                                    <a class="button-primary" href="/bast/{{ $dist->id}}/generate-pdf-v1">BAST V1</a>
                                    <a class="button-primary" href="/bast/{{ $dist->id}}/generate-pdf-v2">BAST V2</a>
                                </td>
                                <td>
                                    <a class="button-warning" href="/bast/{{ $dist->id }}/edit">Update</a>

                                    <form action="/bsat/{{ $dist->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                    <button class="button-danger" onclick="return confirm('Anda yakin menghapus data BSAT dengan nama penerima {{ $dist->employee->name }} ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <i>*BAST V1 : menggunakan 4 tanda tangan.</i><br>
            <i>*BAST V2 : menggunakan 3 tanda tangan.</i>
        </div>
    </div>
@endsection

@section('content-delivery-js')
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/js/table.js') }}"></script>

@endsection