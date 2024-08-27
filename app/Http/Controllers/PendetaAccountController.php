<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PendetaAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('pendeta.akun.pendeta_akun')->with('accounts',$accounts)->with('title','Akun Pendeta');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendeta.akun.buat_akun')->with('title','Buat Akun');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => ['regex:/^(0\d{9,13}|\+\d{1,3}\s?\d{9,13})$/'],
            'role' => 'required|in:pendeta,admin,multimedia', 
        ]);
        Account::create($validatedData);
 
        return redirect()->route('pendeta.akun.index')->with('success', 'Akun berhasil dibuat');
    }


    /**
     * Display the specified resource.
     */

    public function show(String $id)
    {
        // $account = Account::findOrFail($account->id);
        
        return view('pendeta.akun.show_akun', ['account' => Account::where('id',$id)->first()])->with('title','Lihat Akun');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        // $account = Account::findOrFail($account->id);
 
        return view('pendeta.akun.edit_akun', ['account' => Account::where('id',$id)->first()])->with('title','Edit Akun');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id, 'id')->ignore($id, 'id'),
            ],
            'phone' => ['regex:/^(0\d{9,13}|\+\d{1,3}\s?\d{9,13})$/'],
            'role' => 'required|in:pendeta,admin,multimedia', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Account::where('id',$id)->update($request->only(['name','email','phone','role']));
        return redirect()->route('pendeta.akun.index')->with('success', 'Akun Berhasil Terupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $akun)
    {
        $account = Account::findOrFail($akun->id);
        
        $account->delete();
 
        // return redirect()->route('product.index')->with('success', 'product deleted successfully');
        return redirect()->route('pendeta.akun.index')->with('success', 'Akun berhasil dihapus');
    }

}
