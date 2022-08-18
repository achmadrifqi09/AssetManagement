@extends('layout/index')

@section('title')
<title>Label Aset</title>
@endsection

@section('content-delivery')
    <link rel="stylesheet" href="{{ asset('css/label.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('view-of-content')
    <div class="content-wrapper">
        <p>Unduh file dalam format JGP</p>
        <a class="button-primary" style="width: 140px;" id="download">Unduh Label</a>
        <a class="button-warm" style="width: 140px;" href="/asset-management">Kembali</a>
    </div>
    <div id="out-image"></div>
    <div class="content-wrapper">
       <div class="d-flex justify-content-center flex-column align-items-center">
            <div class="canvas" id="capture">
                <div class="rectangular">
                    <div class="box-logo">
                        <img src="{{ asset('assets/img/logo-pemkab.svg') }}" alt="">
                    </div>
                    <div class="box-description">
                        <div class="col1">
                           <b> BMD - TA {{ $asset->item_year }}</b>
                        </div>
                        <div class="col2">
                            Kode Barang - Registrasi<br>
                            {{ $asset->item_code }} - {{ $asset->registration }} - {{ $asset->internal_code }}
                        </div>
                        <div class="col3">
                            Nama Barang - Merk <br>
                            {{ $asset->item_name }} - {{ $asset->brand }}
                        </div>
                        <div class="col4">
                            <b>DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN MALANG</b>
                        </div>
                    </div>
                </div>
            </div>            
       </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#download').on('click', function(){
                html2canvas($('#capture')[0]).then((canvas)=>{
                    console.log('done ...');
                    var imageData = canvas.toDataURL('image/jpg');
                    var newdData = imageData.replace(/^data:image\/jpg/, 'data:application/octet-stream');

                    $('#download').attr('download', 'image.jpg').attr('href', newdData);

                    $('#download').click();
                });  
            });
        });
    </script>
@endsection

{{-- @section('content-delivery-js')
  
@endsection --}}

