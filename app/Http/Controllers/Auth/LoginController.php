<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('nisn', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang Admin!');
            }

            if (Auth::user()->role === 'murid') {
                return redirect()->route('murid.dashboard')
                    ->with('success', 'Login berhasil!');
            }

            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'NISN atau Password salah!');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

    // =========================
    // HALAMAN REGISTER
    // =========================
    public function showRegister()
    {
        return view('auth.register');
    }

    // =========================
    // PROSES REGISTER
    // =========================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nisn' => 'required|numeric|unique:users,nisn',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'role' => 'murid', // default register = murid
        ]);

        // AUTO LOGIN SETELAH REGISTER
        Auth::login($user);

        // REDIRECT SESUAI ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Registrasi berhasil, selamat datang Admin!');
        }

        return redirect()->route('murid.dashboard')
            ->with('success', 'Registrasi berhasil, selamat datang!');
    }

    // =========================
    // HALAMAN GANTI PASSWORD
    // =========================
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    // =========================
    // PROSES GANTI PASSWORD
    // =========================
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed'
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
