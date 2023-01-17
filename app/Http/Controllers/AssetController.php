<?php

namespace App\Http\Controllers;

use App\Exports\AssetExport;
use App\Imports\AssetImport;
use App\Models\Asset;
use App\Models\Distribution;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class AssetController extends Controller
{
   
    public function index()
    {
        $tangibleAssets = Asset::orderBy('created_at', 'desc')->where('item_category', 'Berwujud');
        $assets = Asset::groupBy('item_year')->select('item_year', DB::raw('count(*) as total'))->get();
        $itemsYear = [];
        foreach ($assets as $asset){
            array_push($itemsYear, $asset->item_year);
        }

        $intangibleAssets = Asset::orderBy('created_at', 'desc')->where('item_category', 'Tak Berwujud');
        return view('page/asset-management', [
            'tangibleAssets' => $tangibleAssets->get(),
            'intangibleAssets' => $intangibleAssets->get(),
            'itemsYear' => $itemsYear,
            'employees' => Employee::all()
        ]);
    }

  
    public function create()
    {
        return view('page/add-asset-data', [
            'users' => Employee::all(),
            'assets' => Asset::all()
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_category' => 'required',
            'item_code' => 'required',
            'item_name' => 'required',
            'item_year' => 'required',
            'total' => 'required',
            'item_condition' => 'required',
            'price' =>'required',
            'physical_evidence' => 'max:800'
        ]);

        $code = function(){
            $unique = false;
            $resultCode = 0;
            while($unique == false){
                $internalCode = rand(0, 10000);
                if(Asset::where('internal_code', '=', $internalCode)->count() == 0){
                    $unique = true;
                    if($internalCode < 1000){
                        $resultCode = str_pad((string)$internalCode, 4,"0", STR_PAD_LEFT);
                    }else{
                        $resultCode = $internalCode;
                    }

                }
            }
            return "K-{$resultCode}";
       };

        if($request->file('physical_evidence')){
            $validatedData['physical_evidence'] = $request->file('physical_evidence')->store('physical-pictures');
        }
      
        if($request->file('file_bast')){
            $validatedData['file_bast'] = $request->file('file_bast')->store('file-bast');
        }
   
        if($request->user == null || $request->user == "-"){
            $validatedData['used'] = 0;
        }else{
            $validatedData['used'] = 1;
        }

        if($request->isInternalCode == null){
            $validatedData['internal_code'] = $code();
        }else{
            $validatedData['internal_code'] = $request->internal_code;
        }
        
        $validatedData['registration'] = request('registration',null);
        $validatedData['brand'] = request('brand',null);
        $validatedData['certification_number'] = request('certification_number',null);
        $validatedData['ingredient'] = request('ingredient',null);
        $validatedData['how_to_earn'] = request('how_to_earn',null);
        $validatedData['item_size'] = request('item_size',null);
        $validatedData['description'] = request('description',null);
        $validatedData['creator'] = request('creator',null);
        $validatedData['title'] = request('title',null);
        $validatedData['spesification'] = request('spesification',null);
        $validatedData['location'] = request('location', null);
        $validatedData['user'] = request('user', null);


        Asset::create($validatedData);

        return redirect('/asset-management');
      
    }


    public function show($id)
    {
        $asset = Asset::find($id);
        $imgPatch = $asset->physical_evidence;
        $imgName = substr($imgPatch, 18);


        return view('page/show-physical-image',[
            'img' => $imgName,
            'name' => $asset->item_name

        ]);
    }

    public function showBast($id){
        $asset = Asset::find($id);
        $bastPatch = $asset->file_bast;
        $pdfName = substr($bastPatch, 10);

        return view('page/show-pdf', [
            'name' => $asset->item_name,
            'file' => $pdfName
        ]); 
    }


    public function assetImport(Request $request){
        $data = $request->file('file_excel');

        try{
            Excel::import(new AssetImport($request), $data);
            Alert::toast('Berhasil import data excel', 'success');
            return back();
        }catch(Throwable $e){
            Alert::toast('Gagal import, pastikan kolom excel sudah sesuai ketentuan', 'error');
            return redirect('/asset-management');
        }
        
    }

    public function edit($id)
    {

        return view('page/update-asset-data', [
            'asset' => Asset::find($id),
            'users' => Employee::all(),

        ]);
    }

    
    public function update(Request $request, $id)
    {
        $asset = Asset::find($id);
        $validatedData = $request->validate([
            'item_category' => 'required',
            'item_code' => 'required',
            'item_name' => 'required',
            'item_year' => 'required',
            'total' => 'required',
            'item_condition' => 'required',
            'price' =>'required',
            'physical_evidence'=>'max:800'
        ]);


        if($request->file('physical_evidence')){
            if($request->old_physical_evidence){
                Storage::delete($request->old_physical_evidence);
            }
            $validatedData['physical_evidence'] = $request->file('physical_evidence')->store('physical-pictures');
        }
      
        if($request->file('file_bast')){

            if($request->old_file_bast){
                Storage::delete($request->old_file_bast);
            }
            $validatedData['file_bast'] = $request->file('file_bast')->store('file-bast');
        }

        if($request->user == null || $request->user  =='-'){
            $validatedData['used'] = 0;
        }else{

            $validatedData['used'] = 1;
            if($asset->distribution_id != null){
                $distributions = Distribution::where('id', '=', $asset->distribution_id)->get();
                $user = Employee::where('name', '=', $request->user)->pluck('id');

               foreach($distributions as $dist){
                    $dist->employee_id = $user[0];
                    $dist->save();
               }
            }


        }
    
        $validatedData['registration'] = request('registration', null);
        $validatedData['brand'] = request('brand', null);
        $validatedData['certification_number'] = request('certification_number', null);
        $validatedData['ingredient'] = request('ingredient', null);
        $validatedData['how_to_earn'] = request('how_to_earn', null);
        $validatedData['item_size'] = request('item_size', null);
        $validatedData['description'] = request('description', null);
        $validatedData['creator'] = request('creator', null);
        $validatedData['title'] = request('title', null);
        $validatedData['spesification'] = request('spesification', null);
        $validatedData['location'] = request('location', null);
        $validatedData['user'] = request('user', null);

        
        $asset->update($validatedData);
        Alert::toast('Berhasil memperbarui data', 'success');
        return redirect('/asset-management');
    }


    public function assetExportExcel(Request $request){
        return Excel::download(new AssetExport($request), 'Data-Asset.xlsx');
    }

    public function generateRecapitulation(Request $request){
        ini_set("memory_limit", "800M");
        ini_set("max_execution_time", "800");

        $year = '';
        $keywords = explode(' ', $request->name);
       
        $assets = Asset::where('item_category', '=', $request->category)
        ->where('item_year', '>=', $request->start_year)
        ->where('item_year', '<=', $request->end_year);

        if($request->name != null){
            $assets->where(function ($query) use ($keywords){
                foreach($keywords as $keyword){
                    $query->orWhere('item_name', 'like', '%' . $keyword . '%')->orWhere('brand', 'like', '%' . $keyword . '%');
                }
           });
        }

        if($request->start_year != $request->end_year){
            $year = "{$request->start_year} - {$request->end_year}";
        }else{
            $year = $request->start_year;
        }

        $pdf = Pdf::loadView('page/recapitulation', ['assets' => $assets->get(), 'year' => $year, 'keyword' => strtoupper($request->name)]);
        $pdf->setPaper([0, 0, 595.276, 935,433], 'landscape');
        return $pdf->stream('recapitulation');

    }

    public function assetExportPDF(Request $request){

        ini_set("memory_limit", "800M");
        ini_set("max_execution_time", "800");

        $firstTitle= 'DAFTAR ASET DINAS KOMUNIKASI DAN INFORMATIKA';
        $secondTitle = 'BERDASARKAN PENCARIAN ';
        $keywords = explode(' ', $request->name);

        $users = $request->user;
        
       if($request->title != null){
        $firstTitle = $request->title;
       }
        $assets = Asset::where('item_category', '=', $request->category)
        ->where('item_year', '>=', $request->start_year)
        ->where('item_year', '<=', $request->end_year);


        if($users != null){
            $assets->where('user', '=', $users);
           
           $secondTitle = "{$secondTitle} Pengguna";
        }else{
            if($request->name != null){
                $assets->where(function ($query) use ($keywords){
                    foreach($keywords as $keyword){
                        $query->orWhere('item_name', 'like', '%' . $keyword . '%')
                        ->orWhere('brand', 'like', '%' . $keyword . '%');
                    }
               });
               $secondTitle = "{$secondTitle} {$request->name}";
            }
        }

        

        if($request->start_year != $request->end_year){
            $secondTitle = $secondTitle." TAHUN {$request->start_year} - {$request->end_year}";
        }else{
            $secondTitle = $secondTitle." TAHUN {$request->start_year}";
        }

        $totalPrice = 0;
        $totalItem = 0;
        foreach($assets->get() as $asset){
            $totalPrice += (int)$asset->price;
            $totalItem += (int)$asset->total;
        }
        
        $pdf = Pdf::loadView('page/asset-pdf', ['assets' => $assets->get(), 'secondTitle' => strtoupper($secondTitle), 'firstTitle'=> strtoupper($firstTitle), 'category' => $request->category, 'totalPrice'=>$totalPrice, 'totalItem' => $totalItem]);
        $pdf->setPaper([0, 0, 595.276, 935,433], 'landscape');
        return $pdf->stream('daftar-asset.pdf');
       
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);
        if($asset->physical_evidence){
            Storage::delete($asset->physical_evidence);
        }

        if($asset->file_bast){
            Storage::delete($asset->file_bast);
        }

        $asset->delete();
        Alert::toast('Berhasil menghapus data', 'success');
        return redirect('/asset-management');
    }

    public function generateLabel($id){
        $asset = Asset::find($id);

        return view('page/label', [
            'asset' => $asset
        ]);
    }
}
