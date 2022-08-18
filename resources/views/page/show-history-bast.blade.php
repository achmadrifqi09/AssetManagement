@extends('layout/index')

@section('title')
<title>Riwayat BAST</title>
@endsection


@section('view-of-content')
    <div class="content-wrapper">
        <div class="wrap-componet-menus">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <p class="desc-item-name">Detail BAST</p>
                    <h5 class="item-name">{{ $fileName }}</h5>
                </div>
                <a href="/docs-history" class="button-warm">Kembali</a>
            </div>
                <iframe src="{{ route('history-bast', $file)}}" frameborder="0" class="mt-3"></iframe>
            </div>
        </div>
    </div>
@endsection

