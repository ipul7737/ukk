<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBuku = Book::count();
        $totalAnggota = User::where('role','murid')->count();
        $totalDipinjam = Loan::where('status','dipinjam')->count();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalDipinjam'
        ));
    }
}
