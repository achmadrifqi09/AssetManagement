<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryController extends Controller
{
    public function index(){
        return view('page/bast-history', [
            'assets' => Asset::all(),
            'employees' => Employee::all(),
            'historyData' => History::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required',
            'asset' => 'required',
            'employee' => 'required'
        ]);

        $desc = $request->asset."/".$request->employee;
        $file = $request->file('file')->store('history-file');


        History::create([
            'file' => $file,
            'desc' => $desc
        ]);
        Alert::toast('Berhasil menambahkan data', 'success');
        return redirect('/docs-history');
    }

    public function showBast($id){
        $bast = History::find($id);
        $bastPatch = $bast->file;
        $fileName = substr($bastPatch, 13);


        return view('page/show-history-bast', [
            'file' => $fileName,
            'fileName' => $bast->desc
        ]); 
    }

    public function destroy($id){
        $bastFile = History::find($id);

        Storage::delete($bastFile->file);
        $bastFile->delete();
        Alert::toast('Berhasil menghapus data', 'success');
        return redirect('/docs-history');
    }
}
