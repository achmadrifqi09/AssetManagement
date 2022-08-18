@extends('layout/index')

@section('title')
<title>View Riwayat BAST V2</title>
@endsection


@section('view-of-content')
    <div class="content-wrapper">
        <div class="wrap-componet-menus">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <p class="desc-item-name">Nama Pengguna</p>
                    <h5 class="item-name">{{ $name }}</h5>
                </div>
                <a href="/bast/trash-bast" class="button-warm">Kembali</a>
            </div>
                <iframe src="{{ route('trash-bast-v2', $file)}}" frameborder="0" class="mt-3"></iframe>
            </div>
        </div>
    </div>
@endsection

