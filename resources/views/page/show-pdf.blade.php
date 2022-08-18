@extends('layout/index')

@section('title')
<title>Dokumen BAST</title>
@endsection


@section('view-of-content')
    <div class="content-wrapper">
        <div class="wrap-componet-menus">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <p class="desc-item-name">Dokumen BAST dari :</p>
                    <h5 class="item-name">{{ $name }}</h5>
                </div>
                <a href="/asset-management" class="button-warm">Kembali</a>
            </div>
                @if ($file)
                    <iframe src="{{ route('show-bast', $file)}}" frameborder="0" class="mt-3"></iframe>
                @else 
                   <div class="container d-flex justify-content-center align-items-center" style="min-height : 50vh">
                       <div class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/document_not_found.svg') }}" alt="picture not found" style="width:88px;">
                            <h6 class="mt-4">Belum ada dokumen BAST yang diunggah.</h6>
                       </div>
                   </div>
                @endif
            </div>
        </div>
    </div>
@endsection

