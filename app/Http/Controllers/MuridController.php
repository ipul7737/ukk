<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{

    public function dashboard()
    {
        $totalBuku = Book::count();
        $pinjaman = Loan::where('user_id', Auth::id())
                        ->where('status', 'dipinjam')
                        ->count();

        return view('murid.dashboard', compact('totalBuku','pinjaman'));
    }

    public function buku()
    {
        $books = Book::where('status', 'tersedia')->get();

        return view('murid.buku', compact('books'));
    }

    public function pinjam($id)
    {
        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam'
        ]);

        return redirect()->back()->with('success','Buku berhasil dipinjam');
    }

    public function riwayat()
    {
        $loans = Loan::where('user_id', Auth::id())
                    ->with('book')
                    ->get();

        return view('murid.riwayat', compact('loans'));
    }

}
