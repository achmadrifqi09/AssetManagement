@extends('layout/index')

@section('title')
<title>Tambah Data BAST</title>
@endsection

@section('content-delivery')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('view-of-content')
<h2>Tambah Data BAST</h2>
@include('sweetalert::alert')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="content-wrapper">
    @include('sweetalert::alert')
    <form method="POST" action="/bast/add-bast">
        @csrf
        <div class="wrap-input">
            <label for="selectAsset">Nama Aset* <br><i>*Jika Anda memasukkan lebih dari 1 aset pastikan memiliki internal kode yang sama</i></label>
            
            <select class="select" name="asset_id[]" id="selectAsset" style="width:100%" required autofocus multiple="multiple">
               @foreach ($assets as $asset)
                    @if ($asset->used != 0 || $asset->user != null)
                        <option value="{{ $asset->id }}" disabled>
                            {{ $asset->item_name }} - 
                            {{ $asset->brand }} - 
                            {{ $asset->registration }} - 
                            {{ $asset->item_year }} -
                            Pengguna : {{ $asset->user }}
                        </option>
                    @else    
                        @if (old('asset_id') == $asset->id)
                            <option value="{{ $asset->id }}" selected>
                                {{ $asset->item_name }} - 
                                {{ $asset->brand }} - 
                                {{ $asset->registration }} - 
                                {{ $asset->item_year }} -
                               (internal kode :{{ $asset->internal_code }})
                            </option>
                        @else
                            <option value="{{ $asset->id }}">
                                {{ $asset->item_name }} - 
                                {{ $asset->brand }} - 
                                {{ $asset->registration }} - 
                                {{ $asset->item_year }} -
                               (internal kode :{{ $asset->internal_code }})
                            </option>
                        @endif
                    @endif
               @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="selectEmployee">Pihak Yang Menerima*</label>
            <select class="select" name="employee_id" id="selectEmployee" style="width:100%" required>
               @foreach ($employees as $employee)
                    @if (old('employee_id') == $employee->id)
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option> 
                    @endif
                  
               @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="selectSupervisor">Pihak Yang Menyerahkan*</label>
            <select class="select" name="supervisor_id" id="selectSupervisor" style="width:100%" required>
               @foreach ($employees as $employee)
                    @if (old('supervisor_id') == $employee->id)
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option> 
                    @endif
               @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="selectFinanceAsset">Kepala Dinas*</label>
            <select class="select" name="finance_and_assets_subsection_id" id="selectFinanceAsset" style="width:100%" required>
               @foreach ($employees as $employee)
                    @if (old('finance_and_assets_subsection_id') == $employee->id)
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option> 
                    @endif
               @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="selectItemManager">Sub Bag.Keuangan & Aset*</label>
            <select class="select" name="user_item_manager_id" id="selectItemManager" style="width:100%" required>
               @foreach ($employees as $employee)
                    @if (old('user_item_manager_id') == $employee->id)
                        <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                    @else
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option> 
                    @endif
               @endforeach
            </select>
        </div>
        <div class="wrap-input">
            <label for="reference_number">Nomor Surat*</label>
            <input type="text" id="reference_number" name="reference_number" required value="{{ old('reference_number') }}">
        </div>
        <div class="wrap-input">
            <label for="field">Bidang/Sekretariat*</label>
            <input type="text" id="field" name="field" required value="{{ old('field') }}">
        </div>
        <div class="wrap-input">
            <label for="necessity">Keperluan*</label>
            <input type="text" id="necessity" name="necessity" required value="{{ old('necessity') }}">
        </div>
        <div class="wrap-input">
            <label for="date">Tanggal BAST</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}">
        </div>
        <div class="wrap-input">
            <label for="text_date">Tanggal dalam bentuk kalimat*</label>
            <input type="text" id="text_date" name="text_date" required value="{{ old('text_date') }}" placeholder="Senin Tanggal Dua Bulan..">
        </div>
        <div class="wrap-input">
            <label for="description">Keterangan Barang*</label>
            <select name="description" id="description" required>
                @if (old('description') == 'Baru')
                    <option value="Baru" selected>Baru</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                @elseif(old('description') == 'Baik')
                    <option value="Baru">Baru</option>
                    <option value="Baik" selected>Baik</option>
                    <option value="Rusak">Rusak</option>
                @elseif(old('description') == 'Rusak')
                    <option value="Baru">Baru</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak" selected>Rusak</option>
                @else
                    <option value="Baru" selected>Baru</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                @endif
                
            </select>
        </div>
        <div class="wrap-input">
            <label for="used_item">Jumlah barang yang akan didistribusikan*</label>
            <input type="number" id="used_item" name="used_item" required value="{{ old('used_item') }}">
        </div>
        <div class="wrap-input">
            <label for="location">Lokasi Barang</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}">
        </div>
        <div class="wrap-right-button">
            <button  class="button-danger me-2"><a href="/bast">Batalkan</a></button>
            <button type="submit" class="button-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection

@section('content-delivery-js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.select').select2();

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    });
</script>

@endsection
