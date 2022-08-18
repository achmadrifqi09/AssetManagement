<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <title>Daftar Pengguna (PNS)</title>
    <style type="text/css">
        @font-face {
            font-family: 'arial';
            src: url('assets/font/arial.ttf') format('truetype');
            font-weight: 400; 
            font-style: normal; 
        }   
        @page { margin: 56pt ; }
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
            font-weight: 700;
        }

        .f-normal {
            font-size: 11pt;
        }

        .link {
            color: blue;
        }

        .medium {
            font-size: 14pt;
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
                    <span class="h1">DINAS KOMUNIKASI DAN INFORMATIKA KAB. MALANG</span><br>
                    <span class="h2">DATA PNS DINAS KOMUNIKASI DAN INFORMATIKA</span><br>
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
   
   
    <table style="margin-top: 24px">
        <thead>
            <tr>
                <td class="border f-normal">No</td>
                <td class="border f-normal">Nama</td>
                <td class="border f-normal">NIP</td>
                <td class="border f-normal">Pangkat</td>
                <td class="border f-normal">Golongan</td>
                <td class="border f-normal">Jabatan</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
               <tr>
                    <td class="border f-normal start-text">{{ $loop->iteration }}</td>
                    <td class="border f-normal start-text">{{ $employee->name }}</td>
                    <td class="border f-normal start-text">{{ $employee->nip }}</td>
                    <td class="border f-normal start-text">{{ $employee->rank }}</td>
                    <td class="border f-normal start-text">{{ $employee->group }}</td>
                    <td class="border f-normal start-text">{{ $employee->position }}</td>
               </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
