<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page/employee-list', [
            'employees' => Employee::all()
        ]);
    }

    public function create()
    {
        return view('page/add-data-employee');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $validatedData['rank'] = request('rank', '-');
        $validatedData['position'] = request('position', '-');
        $validatedData['nip'] = request('nip', '-');
        $validatedData['group'] = request('group', '-');

        Employee::create($validatedData);
        Alert::toast('Berhasil menambahkan data pengguna', 'success');
        return redirect('/employee-list');
    }

    public function importEmployee(Request $request){
        $data = $request->file('file_excel');

        try{
            Excel::import(new EmployeeImport, $data);
            Alert::toast('Berhasil mengimport data pengguna', 'success');
            return redirect('/employee-list');
        }catch(Throwable $e){
            Alert::toast('Gagal import, pastikan kolom excel sudah sesuai ketentuan', 'error');
            return redirect('/employee-list');
        }
      
       
    }

    public function exportEmployee(){
        return Excel::download(new EmployeeExport, 'Data-Pegawai.xlsx');
    }

    public function generatePDF(){
        $employees = Employee::all();

        if ($employees->count() > 80){
            ini_set("memory_limit", "800M");
            ini_set("max_execution_time", "800");
        }

        $pdf = Pdf::loadView('page/employee-pdf', ['employees' => $employees]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('daftar-pengguna.pdf');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('page/update-data-employee', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $validatedData['rank'] = request('rank', '-');
        $validatedData['position'] = request('position', '-');
        $validatedData['nip'] = request('nip', '-');
        $validatedData['group'] = request('group', '-');
        
        $employee->update($validatedData);
        Alert::toast('Berhasil memperbarui data pengguna', 'success');
        return redirect('/employee-list')->with('message', 'Berhasil memperbarui data.');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        Alert::toast('Berhasil menghapus data pengguna', 'success');
        return redirect('/employee-list');
    }
}
