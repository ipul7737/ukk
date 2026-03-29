<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\Loan;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.process');

/*
|--------------------------------------------------------------------------
| CHANGE PASSWORD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [LoginController::class, 'showChangePassword'])->name('password.form');
    Route::post('/change-password', [LoginController::class, 'changePassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // CRUD BUKU
    Route::resource('books', BookController::class);

    // CRUD ANGGOTA
    Route::get('/anggota', [UserController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [UserController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [UserController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [UserController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [UserController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [UserController::class, 'destroy'])->name('anggota.destroy');

    // PEMINJAMAN
    Route::get('/peminjaman', [LoanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/kembalikan', [LoanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

    // RIWAYAT
    Route::get('/riwayat', [LoanController::class, 'riwayat'])->name('riwayat.index');
});

/*
|--------------------------------------------------------------------------
| MURID AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:murid'])->prefix('murid')->name('murid.')->group(function () {

    // Dashboard Murid
    Route::get('/dashboard', function () {
        $user = auth()->user();

        $totalDipinjam = Loan::where('user_id', $user->id)
            ->where('status', 'dipinjam')->count();

        $totalDikembalikan = Loan::where('user_id', $user->id)
            ->where('status', 'kembali')->count();

        $totalTerlambat = Loan::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->where('due_date', '<', now())->count();

        $peminjamanAktif = Loan::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->latest()->get();

        $bukuTerbaru = Book::latest()->take(5)->get();

        return view('murid.dashboard', compact(
            'totalDipinjam',
            'totalDikembalikan',
            'totalTerlambat',
            'peminjamanAktif',
            'bukuTerbaru'
        ));
    })->name('dashboard');

    // Halaman Pinjam Buku (menampilkan daftar buku)
    Route::get('/pinjam', function () {
        $books = Book::where('stok', '>', 0)->get();
        return view('murid.pinjam', compact('books'));
    })->name('pinjam');

    // Proses Pinjam Buku
    Route::post('/pinjam/{book}', [LoanController::class, 'store'])->name('pinjam.store');

    // Halaman Pengembalian (buku yang sedang dipinjam)
    Route::get('/pengembalian', [LoanController::class, 'pengembalian'])->name('pengembalian');

    // Proses Kembalikan Buku
    Route::post('/kembalikan/{id}', [LoanController::class, 'kembalikanMurid'])->name('kembalikan');

    // Riwayat Peminjaman Murid
    Route::get('/riwayat', [LoanController::class, 'riwayatMurid'])->name('riwayat');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
