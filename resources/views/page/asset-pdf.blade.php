<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eksport File PDF</title>
    <style type="text/css">
        @page { margin: 28pt ; }
        @font-face {
            font-family: 'arial';
            src: url('assets/font/arial.ttf') format('truetype');
            font-weight: 400; 
            font-style: normal; 
        }   

        body {
            font-family: arial, sans-serif;
            padding: 0px;
            margin: 0px;
        }

        .t1 th,
        td {
            padding: 3px;
            text-align: center;
        }

        p {
            margin: 0px;
            padding: 0px;
        }

        .h2 {
            font-size: 14pt;
            font-weight: 700;
        }

        .h1 {
            font-size: 14pt;
            font-weight: 700;
        }

        .f-normal {
            font-size: 8pt;
        }

        .f-12{
            font-size: 12px;
        }

        .link {
            color: blue;
        }

        .medium {
            font-size: 14px;
            font-weight: 400;
        }

        img {
            position: absolute;
        }

        .start-text {
            text-align: left;
        }

        .tab {
            margin-left: 48px;
        }

        table {
            width: 100% ;
            border-collapse: collapse;
        }

        .justify-text {
            text-align: justify;
        }


        .border {
            border: solid 1px black;
        }

    </style>
</head>

<body>
    <img src="assets/img/pemkab.png" alt="logo Pemkab" width="64px">
    <table class="t1">
        <tr>
            <td colspan="5" class="td-header" style="width: 137px; padding-top:24px;">
                <p>
                    <span class="h2">{{$firstTitle}}</span><br>
                    <span class="h2">{{ $secondTitle }}</span>
                </p>
            </td>

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
    </table>
    @if ($category == 'Berwujud')
        <table style="margin-top: 48px">
            <thead>
               <tr>
                    <td class="border f-normal" style="max-width: 20px !important;"><b>No</b></td>
                    <td class="border f-normal" style="width : 30px;"><b>Kode Barang</b></td>
                    <td class="border f-normal" style="maxwidth: 30px !important;"><b>Register</b></td>
                    <td class="border f-normal" style="width : 30px !important;"><b>Nama / Jenis<br>Barang</b></td>
                    <td class="border f-normal"><b>Merk / Type</b></td>
                    <td class="border f-normal"><b>Asal / Cara Perolehan Barang</b></td>
                    <td class="border f-normal"><b>Tahun Pembelian</b></td>
                    <td class="border f-normal"><b>Lokasi</b></td>
                    <td class="border f-normal" style=" max-width: 80px !important;"><b>Pengguna</b></td>
                    <td class="border f-normal"><b>Keadaan Barang</b></td>
                    <td class="border f-normal"><b>Jumlah Barang</b></td>
                    <td class="border f-normal"><b>Harga (Rp)</b></td>
                    <td class="border f-normal"style="max-width: 300px;"><b>Keterangan</b></td>
               </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                    <tr>
                        <td class="border f-normal" style="max-width: 20px !important;" >{{ $loop->iteration }}</td>
                        <td class="border f-normal" style="width: 30px !important;">{{ $asset->item_code }}</td>
                        <td class="border f-normal" style="width: 30px !important;">{{ $asset->registration }}</td>
                        <td class="border f-normal">{{ $asset->item_name }}</td>
                        <td class="border f-normal">{{ $asset->brand }}</td>
                        <td class="border f-normal">{{ $asset->how_to_earn }}</td>
                        <td class="border f-normal">{{ $asset->item_year }}</td>
                        <td class="border f-normal">{{ $asset->location }}</td>
                        <td class="border f-normal" style=" max-width: 80px !important;">{{ $asset->user }}</td>
                        <td class="border f-normal">{{ $asset->item_condition }}</td>
                        <td class="border f-normal">{{ $asset->total }}</td>
                        <td class="border f-normal">{{  number_format($asset->price ,2,',','.');}}</td>
                        <td class="border f-normal" style="max-width: 300px;">{{ $asset->description }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border f-normal" colspan="10"><b>Total</b></td>
                    <td class="border f-normal"><b>{{ $totalItem }}</b></td>
                    <td class="border f-normal"><b>{{  number_format($totalPrice ,2,',','.');}}</b></td>
                    <td class="border f-normal">&nbsp;</td>
                </tr>
            </tbody>

        </table>
    @else
    <table style="margin-top: 48px">
        <thead>
           <tr>
                <td class="border f-normal"><b>No</b></td>
                <td class="border f-normal" style=" width: 40px !important;"><b>Nama Barang</b></td>
                <td class="border f-normal" style=" width: 30px !important;"><b>Kode Barang</b></td>
                <td class="border f-normal" style=" width: 30px !important;"><b>Registrasi</b></td>
                <td class="border f-normal" style=" width: 30px !important;"><b>Tahun Pengadaan</b></td>
                <td class="border f-normal" style=" width: 80px !important;"><b>Judul / Nama</b></td>
                <td class="border f-normal"><b>Pembuat</b></td>
                <td class="border f-normal"><b>Spesifikasi</b></td>
                <td class="border f-normal"><b>Kondisi</b></td>
                <td class="border f-normal"><b>Asal-Usul</b></td>
                <td class="border f-normal"><b>Harga</b></td>
                <td class="border f-normal" style="max-width: 200px;"><b>Keterangan</b></td>
           </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td class="border f-normal" >{{ $loop->iteration }}</td>
                    <td class="border f-normal" style=" width: 40px !important;">{{ $asset->item_name }}</td>
                    <td class="border f-normal" style=" width: 30px !important;">{{ $asset->item_code }}</td>
                    <td class="border f-normal" style=" width: 30px !important;">{{ $asset->registration }}</td>
                    <td class="border f-normal" style=" width: 30px !important;">{{ $asset->item_year }}</td>
                    <td class="border f-normal" style=" width: 80px !important;">{{ $asset->title }}</td>
                    <td class="border f-normal">{{ $asset->creator }}</td>
                    <td class="border f-normal">{{ $asset->spesification }}</td>
                    <td class="border f-normal">{{ $asset->item_condition }}</td>
                    <td class="border f-normal">{{ $asset->how_to_earn }}</td>
                    <td class="border f-normal">{{ "Rp " . number_format($asset->price ,2,',','.');}}</td>
                    <td class="border f-normal" f-normal" style="width: 180px;">{{ $asset->description }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="border f-normal" colspan="10"><b>Total</b></td>
                <td class="border f-normal"><b>{{ $totalItem }}</b></td>
                <td class="border f-normal"><b>{{  number_format($totalPrice ,2,',','.');}}</b></td>
                <td class="border f-normal">&nbsp;</td>
            </tr>
        </tbody>

    </table>
    @endif
</body>

</html>
