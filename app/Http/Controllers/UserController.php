<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
         $search = $request->search;
        $users = User::where('role','murid')
        ->where(function($query) use ($search){
            $query->where('name','like',"%$search%")
                  ->orWhere('email','like',"%$search%")
                  ->orWhere('nisn','like',"%$search%");
        })
        ->get();
    return view('admin.anggota.index', compact('users','search'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'role' => 'murid'
        ]);

        return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.anggota.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
         $user->update([
            'nisn'=> $request->nisn,
            'name' => $request->name,
            'email' => $request->email,
    ]);

    return redirect()->route('anggota.index')->with('success','Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('anggota.index');
    }
}
