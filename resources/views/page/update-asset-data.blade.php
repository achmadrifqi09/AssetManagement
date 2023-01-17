@extends('layout/index')
@section('title')
    <title>Update Data Aset</title>
@endsection 

@section('content-delivery')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('view-of-content')
<h2>Update Data</h2>
<div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="form-title">Kolom bertanda * wajib diisi.</p>
    <i>*Jika aset sudah terdaftar dalam BAST dan ada perubahan terhadap pengguna aset maka data pengguna dalam BAST akan berubah</i>
    <form method="POST" action="/asset-management/{{ $asset->id }}/edit" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="wrap-input gap-input">
            <label for="item_category">Ketegori Barang*</label>
            <select type="text" id="item_category" name="item_category" required>
                @if (old('item_category', $asset->item_category) == 'Berwujud')
                    <option value="Berwujud" selected>Berwujud</option>
                    <option value="Tak Berwujud">Tak Berwujud</option>
                @elseif(old('item_category', $asset->item_category) == 'Tak Berwujud')
                    <option value="Berwujud">Berwujud</option>
                    <option value="Tak Berwujud" selected>Tak Berwujud</option>
                @else
                    <option value="Berwujud">Berwujud</option>
                    <option value="Tak Berwujud">Tak Berwujud</option>
                @endif
            </select>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="item_code">Kode Barang*</label>
                <input type="text" id="item_code" name="item_code" required value="{{ old('item_code', $asset->item_code) }}">
            </div>
            <div class="wrap-input">
                <label for="registration">Registrasi</label>
                <input type="text" id="registration" name="registration" value="{{ old('registration', $asset->registration) }}">
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="item_name">Nama Barang*</label>
                <input type="text" id="item_name" name="item_name" value="{{ old('item_name', $asset->item_name) }}" required>
            </div>
            <div class="wrap-input">
                <label for="brand">Merk / Type</label>
                <input type="text" id="brand" name="brand" value="{{ old('brand', $asset->brand) }}">
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="certification_number">No Sertif/No Pabrik/Casis/Mesi</label>
                <input type="text" id="certification_number" name="certification_number" value="{{ old('certification_number', $asset->certification_number) }}">
            </div>
            <div class="wrap-input">
                <label for="ingredient">Bahan</label>
                <input type="text" id="ingredient" name="ingredient" value="{{ old('ingredient', $asset->ingredient) }}">
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="how_to_earn">Asal Barang / Cara Perolehan</label>
                <select name="how_to_earn" id="how_to_earn">
                    @if (old('how_to_earn', $asset->how_to_earn) == "Pembelian")
                        <option value="Pembelian" selected>Pembelian</option>
                        <option value="Hibah" selected>Hibah</option>
                    @elseif(old('how_to_earn', $asset->how_to_earn) == "Hibah")
                        <option value="Pembelian" selected>Pembelian</option>
                        <option value="Hibah" selected>Hibah</option>
                    @else
                        <option value="Pembelian" selected>Pembelian</option>
                        <option value="Hibah" selected>Hibah</option>
                    @endif

                </select>
            </div>
            <div class="wrap-input">
                <label for="item_year">Tahun*</label>
                <input type="number" id="item_year" name="item_year" value="{{ old('item_year', $asset->item_year) }}" required>
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="item_size">Ukuran</label>
                <input type="text" id="item_size" name="item_size" value="{{ old('item_size'), $asset->item_size }}">
            </div>
            <div class="wrap-input">
                <label for="item_condition">Keadaan Barang*</label>
                <select id="item_condition" name="item_condition" required>
                    @if (old('item_condition', $asset->item_condition) == "Baik")
                        <option value=""></option>
                        <option value="Baik" selected>Baik</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    @elseif(old('item_condition',  $asset->item_condition)) == "Rusak Berat")
                        <option value=""></option>
                        <option value="Baik" >Baik</option>
                        <option value="Rusak Berat" selected>Rusak Berat</option>
                    @else
                    <option value="" selected></option>
                    <option value="Baik" >Baik</option>
                    <option value="Rusak Berat" selected>Rusak Berat</option>
                    @endif     
                </select>
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="unit">Satuan</label>
                <input type="number" id="unit" name="unit" value="{{ old('unit', $asset->unit) }}">
            </div>
            <div class="wrap-input">
                <label for="price">Harga Barang*</label>
                <input type="number" id="price" value="{{ old('price', $asset->price) }}" name="price" required>
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="total">Jumlah barang*</label>
                <input type="number" id="total" name="total" value="1" required readonly>
            </div>
            <div class="wrap-input">
                <label for="location">Lokasi Barang</label>
                <input type="text" id="location" value="{{ old('location', $asset->location) }}" name="location">
            </div>
        </div>
        <div class="input-two-column">
            <div class="wrap-input gap-input">
                <label for="creator">Pencipta</label>
                <input type="text" id="creator" name="creator" value="{{ old('creator', $asset->creator) }}" >
            </div>
            <div class="wrap-input">
                <label for="title">Judul / Nama</label>
                <input type="text" id="title" value="{{ old('title', $asset->title) }}" name="title" >
            </div>
        </div>
        <div class="wrap-input">
            <label for="user">Pengguna</label>
            <select class="user-select" name="user" id="user" style="width:100%">
                <option value="">-</option>
                @foreach ($users as $user)
                    @if (old('user', $asset->user) == $user->name)
                        <option value="{{ $user->name }}" selected>{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->name}}">{{ $user->name }}</option> 
                    @endif
                @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="spesification">Spesifikasi</label>
            <input type="text" id="spesification" value="{{ old('spesification', $asset->spesification) }}" name="spesification" >
        </div>

        <div class="wrap-input mt-4">
            <label for="physical_evidence">Bukti Fisik</label>
            @if ($asset->physical_evidence)
                <img src="{{ route('physical-pictures', substr($asset->physical_evidence, 18)) }}" class="img-preview img-fluid col-sm-5" style="display: block">
            @else
                <img class="img-preview img-fluid col-sm-5">
            @endif
            <div class="wrap-file mt-2">
                <div class="border-file">
                    <input type="file" id="physical_evidence" hidden accept="image/png, image/gif, image/jpeg" name="physical_evidence" onchange="previewImg()"/>
                    <label for="physical_evidence" class="button-file">Pilih File</label>

                    @if ($asset->physical_evidence)
                        <span id="file-chosen" class="ms-2">{{ substr($asset->physical_evidence, 18) }}</span>
                    @else
                        <span id="file-chosen" class="ms-2">Tidak ada file</span>
                    @endif
                   
                </div>
            </div>
        </div>
        <div class="wrap-input mt-4">
            <label for="file_bast">Dokumen BAST Aktif</label>
            @if ($asset->file_bast)
                <iframe src="{{ route('show-bast', substr($asset->file_bast, 10))}}" class="preview-bast" frameborder="0" class="mt-3"></iframe>
            @else
                <iframe class="preview-bast" style="display:none;"></iframe>
            @endif
            <div class="wrap-file mt-2">
                <div class="border-file">
                    <input type="file" id="file_bast" hidden accept="application/pdf" name="file_bast" onchange="previewBast()" />
                    <label for="file_bast" class="button-file">Pilih File</label>
                    @if ($asset->file_bast)
                        <span id="file-chosen-bsat" class="ms-2">{{ substr($asset->file_bast, 10) }}</span>
                    @else
                        <span id="file-chosen-bsat" class="ms-2">Tidak ada file.</span>
                    @endif
                   
                </div>
            </div>
        </div>

        <input type="hidden" value="{{ $asset->physical_evidence }}" name="old_physical_evidence">
        <input type="hidden" value="{{ $asset->file_bast }}" name="old_file_bast">


        <div class="wrap-input mt-4">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="10">{{ old('description', $asset->description) }}</textarea>
        </div>
       
        <div class="wrap-right-button">
            <button class="button-danger me-2"><a href="/asset-management">Kembali</a></button>
            <button type="submit" class="button-primary">Simpan</button>
        </div>

    </form>
</div>
@endsection

@section('content-delivery-js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const btn = document.getElementById('physical_evidence');
        const fileChosen = document.getElementById('file-chosen');

        btn.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
        });


        const btnFileBsat = document.getElementById('file_bast');
        const fileChosenBsat = document.getElementById('file-chosen-bsat');
        btnFileBsat.addEventListener('change', function () {
            fileChosenBsat.textContent = this.files[0].name
        });


        function previewImg(){
            const image = document.querySelector('#physical_evidence');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result; 
            }

        }

        function previewBast(){
            const doc = document.querySelector('#file_bast');
            const bastPreview = document.querySelector('.preview-bast');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(doc.files[0]);

            oFReader.onload = function(oFREvent){
                bastPreview.src = oFREvent.target.result; 
                bastPreview.style.display = 'block';
            }

        }
        $(document).ready(function() {
        $('.user-select').select2();

    });

    </script>
@endsection