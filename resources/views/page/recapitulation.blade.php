<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapitulasi</title>
    <style>
        @page { margin: 28pt ; }
        @font-face {
            font-family: 'arial';
            src: url('assets/font/arial.ttf') format('truetype');
            font-weight: 400; 
            font-style: normal; 
        }   

        body {
            font-family: arial, sans-serif;
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

        table tr .td-header {
            padding-left: 26px;
        }


        .h2 {
            font-size: 14pt;
            font-weight: 700;
        }

        .h1 {
            font-size: 14pt;
        }

        .f-normal {
            font-size: 11pt;
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
            width: 100%;
            border-collapse: collapse;
        }

        .justify-text {
            text-align: justify;
        }

        ol {
            margin-top: 0;
            padding-left: 1em
        }

        li {
            margin-top: 8px;
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
                    <span class="h2">REKAPITULASI BAST BELANJA MODAL {{ $year }}</span><br>
                    <span class="h2">Pengadaaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya</span><br>
                    <span class="h2">({{ $keyword }})</span>
                </p>
            </td>

        </tr>
    </table>
    <table style="margin-top: 24pt">
        <thead>
            <tr>
                <td class="border f-normal"><b>NO</b></td>
                <td class="border f-normal"><b>Nama Barang</b></td>
                <td class="border f-normal"><b>Tahun Pembelian</b></td>
                <td class="border f-normal"><b>Merk</b></td>
                <td class="border f-normal"><b>Kode Barang</b></td>
                <td class="border f-normal"><b>Kode Register</b></td>
                <td class="border f-normal"><b>Pengguna Barang</b></td>
                <td class="border f-normal"><b>Lokasi</b></td>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($assets as $index => $asset)
            <tr>
                <td class="border f-normal">{{ $loop->iteration }}</td>
                <td class="border f-normal">{{ $asset->item_name }}</td>
                <td class="border f-normal">{{ $asset->item_year }}</td>
                <td class="border f-normal">{{ $asset->brand }}</td>
                <td class="border f-normal">{{ $asset->item_code }}</td>
                <td class="border f-normal">{{ $asset->registration }}</td>
                <td class="border f-normal">{{ $asset->user }}</td>
                <td class="border f-normal">{{ $asset->location }}</td>
         
            </tr>
            @endforeach
        </tbody>
    </table>
   {{-- @foreach ($assets as $asset)
       <p>{{ $loop->iteration  }}. {{ $asset->item_name }} - {{ $asset->item_year }}</p>
   @endforeach --}}
</body>
</html>