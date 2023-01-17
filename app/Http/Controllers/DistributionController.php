<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Distribution;
use App\Models\DistributionHistories;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class DistributionController extends Controller
{
    public function index()
    {
        return view('page/distribution-asset', [
            'distributions' => Distribution::orderBy('created_at', 'desc')->with(['assets', 'employee', 'supervisor', 'financeasset', 'itemmanager'])->get(),
            
        ]);
    }

    public function create()
    {
        return view('page/add-distribution-data', [
            'employees' => Employee::all(),
            'assets' => Asset::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'supervisor_id' => 'required',
            'finance_and_assets_subsection_id' => 'required',
            'user_item_manager_id' => 'required',
            'necessity' => 'required',
            'reference_number' => 'required',
            'date' => 'required',
            'text_date' => 'required',
            'used_item' => 'required',
            'description' => 'required'
        ]);

        if($request->field){
            $validatedData['field'] = $request->field;
        }

        $assets = Asset::where(function($query) use ($request){
            foreach($request->asset_id as $id){
                $query->orWhere('id', '=', $id);
            }
        })->get();
        

        $textUsedItem = $this->numberToText((int)request('used_item'));
 
        $validatedData['text_used_item'] = (string)$textUsedItem;
        $internalCode =[];
        foreach($assets as $asset){
            array_push($internalCode, $asset->internal_code);
        }
     
        if($request->used_item == $assets->count() && count(array_unique($internalCode)) === 1){
            $user = Employee::find($request->employee_id);
            $id = Distribution::create($validatedData)->id;
            foreach($assets as $asset){
                $asset->used = 1;
                $asset->user = $user->name;
                $asset->distribution_id = $id;
                if($request->location != null){
                    $asset->location = $request->location;
                }
                $asset->save();
            }
            Alert::toast('Berhasil menambahkan data BAST', 'success');
            return redirect('/bast');
        }else{
            Alert::error('Gagal Menambahkan BAST', 'Jumlah asset yang dipilih harus sama dengan jumlah barang yang akan didistribusikan dan jika aset lebih dari 1 harus memiliki internal kode harus sama');
            return redirect('/bast/add-bast');
        }
    }

    public function numberToText($num){
        $numberName = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if($num < 12){
            return $numberName[$num];
        }else if($num < 20){
            return $this->numberToText($num - 10)." Belas ";
        }else if($num < 100){
            return $this->numberToText($num/10)." Puluh ".$this->numberToText($num%10);
        }else if($num < 200){
            return "Seratus ".$this->numberToText($num-100);
        }else if($num < 1000){
            return $this->numberToText($num / 100)." Ratus ".$this->numberToText($num % 100);
        }else if($num  < 2000){
            return "Seribu ".$this->numberToText($num-1000);
        }else if($num < 1000000){
           return $this->numberToText($num/1000)." Ribu ".$this->numberToText($num % 1000);
        }
    }

    public function generatePDFV1($id){
        ini_set("memory_limit", "800M");
        ini_set("max_execution_time", "800");
        $pdf = Pdf::loadView('page/bast-version-one', ['dist'=>Distribution::find($id),'assets' => Asset::where('distribution_id', '=', $id)->get()]);
        $pdf->setPaper([0, 0, 595.276, 935,433], 'potrait');
        return $pdf->stream('bast.pdf');
    }

    public function generatePDFV2($id){
        ini_set("memory_limit", "800M");
        ini_set("max_execution_time", "800");
        $pdf = Pdf::loadView('page/bast-version-two',  ['dist'=>Distribution::find($id),'assets' => Asset::where('distribution_id', '=', $id)->get()]);
        $pdf->setPaper([0, 0, 595.276, 935,433], 'potrait');
        return $pdf->stream('bast.pdf');
    }



    public function edit($id)
    {   
        $internalCode = Asset::where('distribution_id', '=', $id)->pluck('internal_code');
        return view('page/update-distribution-data', [
            'updatedData' => Distribution::find($id),
            'employees' => Employee::all(),
            'assets' => Asset::where('internal_code', '=', $internalCode[0])->get(),
            'location' => Asset::where('distibution_id')
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'supervisor_id' => 'required',
            'finance_and_assets_subsection_id' => 'required',
            'user_item_manager_id' => 'required',
            'necessity' => 'required',
            'reference_number' => 'required',
            'date' => 'required',
            'text_date' => 'required',
            'used_item' => 'required',
            'description' => 'required'
        ]);

        if($request->field){
            $validatedData['field'] = $request->field;
        }
        
        $dist = Distribution::find($id);

        $newAssets = Asset::where(function($query) use ($request){
            foreach($request->asset_id as $id){
                $query->orWhere('id', '=', $id);
            }
        })->get();
        
        $oldAssets = Asset::where('distribution_id', '=', $id);

        $textUsedItem = $this->numberToText((int)request('used_item'));
        $validatedData['text_used_item'] = (string)$textUsedItem;
       

        if($request->used_item == $newAssets->count()){
            $user = Employee::find($request->employee_id);
            
            $newId = [];
            foreach($newAssets as $newAsset){
                array_push($newId, $newAsset->id);
            }
            $oldAssets->whereNotIn('id', $newId);

        
            foreach($oldAssets->get() as $assetElims){
                $assetElims->used = 0;
                $assetElims->user =null;
                $assetElims->distribution_id = null;
                $assetElims->location = null;
                $assetElims->save();
            }
       
            foreach($newAssets as $newAsset){
                $newAsset->used = 1;
                $newAsset->user = $user->name;
                $newAsset->distribution_id = $id;
                if($request->location != null){
                    $newAsset->location = $request->location;
                }
                $newAsset->save();
            }
            $dist->update($validatedData);
            Alert::toast('Berhasil memperbarui data', 'success');
            return redirect('/bast');
        }else{
            Alert::toast('Jumlah asset yang dipilih harus sama dengan jumlah barang yang akan didistribusikan', 'error');
            return redirect("/bast/{$id}/edit");
        }
    }

    public function destroy($id)
    {
        
        $dist = Distribution::find($id);
        $assets = Asset::where('distribution_id', '=', $id);
        $storedData = [];

        ini_set("memory_limit", "800M");
        ini_set("max_execution_time", "800");

        $pdfV1 = Pdf::loadView('page/bast-version-one', ['dist'=>Distribution::find($id),'assets' => Asset::where('distribution_id', '=', $id)->get()]);
        $pdfV1->setPaper([0, 0, 595.276, 935,433], 'potrait');
        $pdfV2 = Pdf::loadView('page/bast-version-two',  ['dist'=>Distribution::find($id),'assets' => Asset::where('distribution_id', '=', $id)->get()]);
        $pdfV2->setPaper([0, 0, 595.276, 935,433], 'potrait');

        $contentV1 = $pdfV1->download()->getOriginalContent();
        Storage::put("trash-bast-v1/{$dist->employee->name}-bast-v1.pdf",$contentV1);
        $contentV2 = $pdfV2->download()->getOriginalContent();
        Storage::put("trash-bast-v2/{$dist->employee->name}-bast-v2.pdf",$contentV2);
       
        $storedData['name'] = $dist->employee->name;
        $storedData['bast_v1'] =  "{$dist->employee->name}-bast-v1.pdf";
        $storedData['bast_v2'] =  "{$dist->employee->name}-bast-v2.pdf";

        DistributionHistories::create($storedData);

        foreach($assets->get() as $asset){
            $asset->used = 0;
            $asset->user = null;
            $asset->location = null;
            $asset->distribution_id = null;
            $asset->save();
        }

        $dist->delete();
        Alert::toast('Berhasil menghapus data', 'success');
        return redirect('/bast');
    }


    public function indexTrashBast(){
        return view('page/trash-bast', [
           'files' => DistributionHistories::all()
        ]);
    }

    public function showBastV1($id){
       $trashdata = DistributionHistories::find($id);
       return view('page/show-trash-bast-v1', [
            'name' => $trashdata->name,
            'file' => $trashdata->bast_v1
       ]);
    }

    public function showBastV2($id){
        $trashdata = DistributionHistories::find($id);
        return view('page/show-trash-bast-v2', [
             'name' => $trashdata->name,
             'file' => $trashdata->bast_v2
        ]);
     }

    public function forceDeleteBast($id){
        $dist = DistributionHistories::find($id);
        Storage::delete("/trash-bast-v1/{$dist->bast_v1}");
        Storage::delete("/trash-bast-v2/{$dist->bast_v2}");
        $dist->delete();
        Alert::toast('Berhasil menghapus data secara permanen', 'success');
        return redirect('/bast/trash-bast');
    }
}
