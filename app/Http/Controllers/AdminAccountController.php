<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('admin.akun.admin_akun')->with('accounts',$accounts)->with('title','Akun Admin');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.akun.buat_akun')->with('title','Buat Akun');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => ['regex:/^(0\d{9,13}|\+\d{1,3}\s?\d{9,13})$/'],
            'role' => 'required|in:multimedia', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Account::create($request->only(['name','email','password','phone','role']));
 
        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        return view('admin.akun.show_akun', ['account' => Account::where('id',$id)->first()])->with('title','Lihat Akun');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('admin.akun.edit_akun', ['account' => Account::where('id',$id)->first()])->with('title','Edit Akun');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
            'role' => 'required|in:multimedia,admin', 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Account::where('id',$id)->update($request->only(['name','email','phone','role']));
 
        return redirect()->route('admin.akun.index')->with('Berhasil', 'Akun Berhasil Terupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $akun)
    {
        $user = Auth::user();
        $account = Account::findOrFail($akun->id);
        if($account->role == 'pendeta' and $user->role == 'admin'){
            return Redirect::route('admin.akun.index')->withErrors(['error' => 'Anda tidak memiliki hak akses untuk menghapus akun ini.']);
        }
        if($account->role == 'admin' and $user->role == 'admin'){
            return Redirect::route('admin.akun.index')->withErrors(['error' => 'Anda tidak memiliki hak akses untuk menghapus akun ini.']);
        }
        $account->delete();
        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil dihapus');

    }
}
