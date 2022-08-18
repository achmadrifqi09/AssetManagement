<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <title>BAST Versi 2</title>
    <style type="text/css">
        @page { margin: 56pt ; }
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
            font-size: 18pt;
            font-weight: 700;
        }

        .h1 {
            font-size: 16pt;
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
    <img src="assets/img/pemkab.png" alt="logo Pemkab" width="64px;">
    <table class="t1">
        <tr>
            <td colspan="5" class="td-header" >
                <p>
                    <span class="h1">PEMERINTAH KABUPATEN MALANG</span><br>
                    <span class="h2">DINAS KOMUNIKASI DAN INFORMATIKA</span><br>
                    <span class="f-normal">Jalan A. Yani Utara No. 348 Telp/Fax (0341) 408788</span><br>
                    <span class="f-normal"><i>Website :
                            <span class="link">https://kominfo.malangkab.go.id</span>
                            Email : kominfo@malangkab.go.id</i></span><br>
                    <span class="f-normal"><b><u>MALANG&nbsp;&nbsp;&nbsp;&nbsp;65126</u></b></span>
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
        <tr>
            <td colspan="5"><span class="f-normal "><b><u>BERITA ACARA SERAH TERIMA</u></b></span><br>
                <span class="f-normal">Nomor : {{ Str::substr($dist->reference_number, 0, 3) }}/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/{{ Str::substr($dist->reference_number, 4) }}</span> </span>
            </td>

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="start-text">
                <span class="f-normal"><span class="tab">Pada hari ini</span>
                    {{ $dist->text_date }} ({{date('d-m-Y', strtotime($dist->date)); }}) yang bertanda tangan dibawah
                    ini :</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">NAMA</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->supervisor->name == '')
                <td class="f-normal start-text" colspan="2"><b>-</b></td>
            @else
                <td class="f-normal start-text" colspan="2"><b>{{ $dist->supervisor->name }}</b></td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">NIP</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->supervisor->nip == '')
                <td class="f-normal start-text" colspan="2">-</td>
            @else
                <td class="f-normal start-text" colspan="2">{{ $dist->supervisor->nip }}</td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">PANGKAT</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->supervisor->rank == '')
                <td class="f-normal start-text" colspan="2">-</td>
            @else
                <td class="f-normal start-text" colspan="2">{{ $dist->supervisor->rank }}</td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">JABATAN</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->supervisor->position == '')
                <td class="f-normal start-text" colspan="2">-</td>
            @else
                <td class="f-normal start-text" colspan="2">{{ $dist->supervisor->position }}</td>
            @endif
        </tr>
        <tr>
            <td colspan="5" class="f-normal start-text">Selanjutnya disebut sebagai <b><i>Pihak Pertama</i></b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">NAMA</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->employee->name == '')
                <td class="f-normal start-text" colspan="2"><b>-</b></td>
            @else
                <td class="f-normal start-text" colspan="2"><b>{{ $dist->employee->name }}</b></td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">NIP</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->employee->nip == '')
                <td class="f-normal start-text" colspan="2">-</td>
            @else 
                <td class="f-normal start-text" colspan="2">{{ $dist->employee->nip }}</td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">PANGKAT</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->employee->rank =='')
                <td class="f-normal start-text" colspan="2">-</td>  
            @else
                <td class="f-normal start-text" colspan="2">{{ $dist->employee->rank }}</td>
            @endif
        </tr>
        <tr>
            <td colspan="1" class="f-normal start-text" style="width: 96px;">JABATAN</td>
            <td colspan="1" style="width: 24px !important;" class="f-normal start-text">:</td>
            @if ($dist->employee->position == '')
                <td class="f-normal start-text" colspan="2">-</td>
            @else
                <td class="f-normal start-text" colspan="2">{{ $dist->employee->position }}</td>
            @endif
            
        </tr>
        <tr>
            <td colspan="5" class="f-normal start-text">Selanjutnya disebut sebagai <b><i>Pihak Kedua</i></b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal justify-text">
                Berdasarkan Peraturan Menteri Dalam Negeri Nomor 19 Tahun 2016 tentang Pedoman Pengelolaan
                Barang Milik Daerah, maka Kedua Belah Pihak dalam kedudukanya sebagaimana tersebut diatas,
                sepakat untuk membuat dan menandatangani Berta Acara Sera Terima Barang Inventaris Milik
                Daerah Kabupaten Malang, dengan ketentuan sebagai berikut:
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal"><b>Pasal 1<br>Macam / Jenis / Barang</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal justify-text">
                <ol>
                    <li>PIHAK PERTAMA menyerahkan {{ $dist->used_item }} ({{ $dist->text_used_item }}) unit
                        @foreach ($assets as $asset)
                            <b>{{ $asset->item_name }}</b>
                            @break
                        @endforeach
                        kepada PIHAK KEDUA dan
                        PIHAK KEDUA siap menyatakan menerima atas penyerahan PIHAK PERTAMA dalam keadaan
                        benar dan lengkap.</li>
                    <li>
                        Barang Inventaris Milik Pemerintah Kabupaten Malang dimaksud pada ayat (1) dipergunakan untuk
                        menunjang kegiatan penyelenggaraan tugas pokok dan fungsi pada Bidang Komunikasi Dinas
                        Komunikasi dan Informatika Kabupaten Malang.
                    </li>
                    <li>
                        Barang Inventaris Milik Pemerintah Daerah Kabupaten Malang yang diserahkan sebagaimana di
                        maksud pada ayat (1) dengan data sebagai berikut:
                    </li>
                </ol>
            </td>
        </tr>
    </table>
    <table id="table_item">
        <tr>
            <td class="f-normal start-text border" style="max-width: 100px;">Barang yang diserahkan</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal start-text border"><b>
                @foreach ($assets as $asset)
                    {{ $asset->item_name }} / {{ $asset->brand }}
                    @break
                @endforeach
            </b></td>
        </tr>
        <tr>
            <td class="f-normal border start-text" style="max-width: 100px;">Tahun Pembelian</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal start-text border">
                @foreach ($assets as $asset)
                    {{ $asset->item_year }}
                    @break
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="f-normal border start-text"style="max-width: 100px;">Kode Barang - No. Reg</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal start-text border">
                @foreach ($assets as $asset)
                    {{ $asset->item_code }} -
                    @break
                @endforeach
                <?php
                    $x = 1 ;
                ?>
                @foreach ($assets as $asset)
                    @if ($x++ == $assets->count())
                        {{ $asset->registration }} 
                    @else
                        {{ $asset->registration }},
                    @endif
                @endforeach
                @foreach ($assets as $asset)
                    - {{ $asset->internal_code }}
                    @break
                 @endforeach
            </td>
        </tr>
        <tr>
            <td class="f-normal border start-text"style="max-width: 100px;">Keterangan Barang</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal border start-text">{{ $dist->description }}</td>
        </tr>
        <tr>
            <td class="f-normal border start-text"style="max-width: 100px;">Keperluan</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal border start-text">{{ $dist->necessity }}</td>
        </tr>
        <tr>
            <td class="f-normal border start-text"style="max-width: 100px;">Pengguna Barang</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal border start-text">{{ $dist->employee->name }}</td>
        </tr>
        <tr>
            <td class="f-normal border start-text"style="max-width: 100px;">Terhitung Masa Penyerahan</td>
            <td class="f-normal border" style="width: 20px;">:</td>
            <td class="f-normal border start-text">{{date('d-m-Y', strtotime($dist->date)); }}</td>
        </tr>
    </table>

    <table style="margin-top: 22px;">
        <tr>
            <td colspan="5" class="f-normal"><b>Pasal 2<br>Penyerahan Barang</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal justify-text">
                Terhitung Sejak ditandatangani Berita Acara Serah Terima ini, maka Hak dan Wewenang serta
                tanggung jawab untuk melakukan pemeliharaan, perbaikan dan kehilangan barang tersebut yang telah
                diserahkan oleh PIHAK PERTAMA kepada PIHAK KEDUA menjadi tanggung jawab PIHAK KEDUA
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal"><b>Pasal 3<br>Penutup</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" class="f-normal justify-text">
                Demikian Berita Acara Serah Terima Barang in dibuat rangkap 2 (dua) untuk dipergunakan
                sebagaimana mestinya dan berlaku sejak ditandatangani.
            </td>
        </tr>
    </table>
    <table style="margin-top: 32px;">
        <tr>
            <td class="f-normal" style="width: 45%;">Yang Menerima<br>Pihak Kedua</td>
            <td style="width: 10%;"></td>
            <td class="f-normal" style="width: 50%;">Yang Menyerahkan<br>Pihak Pertama</td>
        </tr>
        <tr>
            <td style="height: 80px;"></td>
            <td style="height: 80px;"></td>
            <td style="height: 80px;"></td>
        </tr>
        <tr>
            <td class="f-normal" style="width: 45%;">
                <u><b>{{ $dist->employee->name }}</b></u><br>
                @if ($dist->employee->nip == '')
                    NIP. -
                @else
                    NIP. {{ $dist->employee->nip }}
                @endif
            
            </td>
            <td style="width: 10%;"></td>
            <td class="f-normal" style="width: 50%;"><u><b>{{ $dist->supervisor->name }}</b></u><br>
                @if ($dist->supervisor->nip == '')
                    NIP. -
                @else
                    NIP. {{ $dist->supervisor->nip }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3" style="height: 62px;"></td>
        </tr>
        <tr>
            <td class="f-normal" colspan="5">Mengetahui<br>Sub Bag.Keuangan & Aset</td>
        </tr>
        <tr>
            <td style="height: 80px;"></td>
            <td style="height: 80px;"></td>
            <td style="height: 80px;"></td>
        </tr>
        <tr>
            <td class="f-normal" colspan="5">
                <u><b>{{ $dist->financeasset->name }}</b></u><br>
                @if ($dist->financeasset->nip == '')
                   NIP. -
                @else
                    NIP. {{ $dist->financeasset->nip }}
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
