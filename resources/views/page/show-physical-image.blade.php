@extends('layout/index')

@section('title')
<title>Detail Bukti Fisik</title>
@endsection


@section('view-of-content')
    <div class="content-wrapper">
        <div class="wrap-componet-menus">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <p class="desc-item-name">Bukti fisik dari asset :</p>
                    <h5 class="item-name">{{ $name }}</h5>
                </div>
                <a href="/asset-management" class="button-warm">Kembali</a>
            </div>
                @if ($img)
                    <img src="{{ route('physical-pictures', $img)}}" alt="foto asset" class="mt-3" style="border-radius: 7px; ">
                @else 
                   <div class="container d-flex justify-content-center align-items-center" style="min-height : 50vh">
                       <div class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{ asset('assets/img/no_picture.svg') }}" alt="picture not found" style="width:88px;">
                            <h6 class="mt-4">Belum ada bukti fisik yang diunggah.</h6>
                       </div>
                   </div>
                @endif
            </div>
        </div>
    </div>
@endsection

