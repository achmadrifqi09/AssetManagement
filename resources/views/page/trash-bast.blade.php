@extends('layout/index')

@section('title')
    <title>Riwayat BAST</title>
@endsection

@section('content-delivery')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/table.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('view-of-content')
    <h2>Riwayat BAST</h2>
    @include('sweetalert::alert')
    <div class="content-wrapper mt-4">
        <div class="box-table">
            <table id="example" class=" nowrap table" style="width:100%">
                <thead >
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>BAST V1</th>
                        <th>BAST V2</th>
                        <th>Aksi</th>
                    </tr>
                </thead >
                <tbody >
                    
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->name }}</td>
                                <td>
                                    <a href="/bast/trash-bast/view-v1/{{ $file->id}}"
                                        class="button-primary">Lihat</a>
                                </td>
                                <td>
                                    <a href="/bast/trash-bast/view-v2/{{ $file->id}}"
                                        class="button-primary">Lihat</a>
                                </td>
                                <td>                     
                                    <form action="/bast/trash-bast/force-delete/{{ $file->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                    <button class="button-danger" onclick="return confirm('Anda yakin menghapus data BSAT dengan nama penerima {{ $file->name }} ?')">Delete</button>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="{{ asset('/js/table.js') }}"></script>
    <script>
        $(document).ready(function() {
    
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 5000);
        });
    </script>

@endsection