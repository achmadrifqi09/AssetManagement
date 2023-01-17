<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AssetExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{  
    protected $request;

    use Exportable;
    function __construct($request)
    {
       $this->request = $request;
    }


    public function map($asset): array
    {

        if($this->request->category == 'Berwujud'){
            return [
                $asset->item_code,
                $asset->registration,
                $asset->internal_code,
                $asset->item_name,
                $asset->brand,
                $asset->certification_number,
                $asset->ingredient,
                $asset->how_to_earn,
                $asset->item_year,
                $asset->item_size,
                $asset->unit,
                $asset->item_condition,
                $asset->total,
                $asset->price,
                $asset->location,
                $asset->user,
                $asset->description,
            ];
        }else if($this->request->category == 'Tak Berwujud'){
            return [
                $asset->item_name,
                $asset->item_code,
                $asset->registration,
                $asset->internal_code,
                $asset->item_year,
                $asset->title,
                $asset->creator,
                $asset->spesification,
                $asset->item_condition,
                $asset->how_to_earn,
                $asset->price,
                $asset->location,
                $asset->user,
                $asset->description,
            ];
        }
       
    }

    public function headings(): array
    {
        if($this->request->category == 'Berwujud'){
            return [
                'Kode Barang',
                'Registrasi',
                'Kode Internal',
                'Nama Barang',
                'Merk / Tipe',
                'No. Sertifikat',
                'Bahan',
                'Asal / Cara Perolehan',
                'Tahun Pembelian',
                'Ukuran Barang / Konstruksi',
                'Satuan',
                'Keadaan Barang',
                'Jumlah Barang',
                'Harga',
                'Lokasi',
                'Pengguna', 
                'Keterangan'
            ];
        }else if($this->request->category == 'Tak Berwujud'){
            return [
                'Janis Barang / Nama Barang',
                'Kode Barang',
                'Registrasi',
                'Kode Internal' ,
                'Tahun Pengadaan',
                'Judul / Nama',
                'Pencipta',
                'Spesifikasi',
                'Kondisi',
                'Asal-usul Barang',
                'Harga',
                'Lokasi',
                'Pengguna',
                'Keterangan',
            ];
        }
    }

    public function query()
    {
        $keywords = explode(' ', $this->request->name);

        $assets = Asset::where('item_category', '=', $this->request->category)
        ->where('item_year', '>=', $this->request->start_year)
        ->where('item_year', '<=', $this->request->end_year);

        if($this->request->name != null){
            $assets->where(function ($query) use ($keywords){
                foreach($keywords as $keyword){
                    $query->orWhere('item_name', 'like', '%' . $keyword . '%')->orWhere('brand', 'like', '%' . $keyword . '%')
                    ->orWhere('brand', 'like', '%' . $keyword . '%')->orWhere('brand', 'like', '%' . $keyword . '%');
                }
           });
        }

        return $assets;
        
    }
}
