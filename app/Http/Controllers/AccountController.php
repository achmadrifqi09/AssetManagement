<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{

    public function index(){
        return view('page/account-management', [
            'users' => User::all()
        ]);
    }

    public function create(){
        return view('page/add-account');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
        ]);
        $validatedData['level'] = 'User';
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        Alert::toast('Berhasil membuat akun', 'success');
        return redirect('/account-management');
    }


    public function editPassword(){
        return view('page/update-password');
    }


    public function updatePassword(Request $request){
        
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6'
        ]);


        $account = User::find( auth()->user()->id);

        if(Hash::check($request->old_password, auth()->user()->password)){
            
           $account->update(['password' => Hash::make($request->password)]);
            Alert::toast('Berhasil memperbarui password', 'success');
            return redirect('/account-management/update-password');
        }
        Alert::toast('Password lama yang anda masukkan salah', 'error');
        
        return redirect('/account-management/update-password');

    }

    public function edit(){
        return view('page/update-account');
    }

    public function update(Request $request){
        
        $account = User::find( auth()->user()->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $account->update($validatedData);
        Alert::toast('Berhasil memperbarui data akun', 'success');
        if((auth()->user()->level == 'Administrator')){
            return redirect('/account-management');
        }else{
            return redirect('/');
        }
       

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::toast('Berhasil menghapus akun', 'success');
        return redirect('/account-management');
    }

}
