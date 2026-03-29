<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{

    // PINJAM BUKU
    public function store(Book $book)
    {
        // cek stok
        if ($book->stok <= 0) {
            return back()->with('error', 'Buku tidak tersedia');
        }

        Loan::create([
            'user_id'       => Auth::id(),
            'book_id'       => $book->id,
            'tanggal_pinjam' => now(),
            'due_date'      => now()->addDays(3),
            'status'        => 'dipinjam',
            'denda'         => 0
        ]);

        // kurangi stok
        $book->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam');
    }


    // HALAMAN PEMINJAMAN ADMIN
    public function index(Request $request)
    {
        $search = $request->search;

        $loans = Loan::with(['user', 'book'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('book', function ($q) use ($search) {
                    $q->where('judul', 'like', "%$search%");
                });
            })
            ->latest()
            ->get();

        return view('admin.peminjaman.index', compact('loans'));
    }


    // PENGEMBALIAN BUKU (ADMIN)
    public function kembalikan($id)
    {
        $loan = Loan::findOrFail($id);
        $book = Book::find($loan->book_id);
        $today = now();
        $denda = 0;

        if ($today->greaterThan($loan->due_date)) {
            $days = $today->diffInDays($loan->due_date);
            $denda = $days * 1000;
        }

        $loan->update([
            'tanggal_kembali' => $today,
            'denda'           => $denda,
            'status'          => 'kembali'
        ]);

        if ($book) {
            $book->increment('stok');
        }

        return back()->with('success', 'Buku berhasil dikembalikan');
    }


    // PEMINJAMAN SAYA (MURID)
    public function myLoans()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->get();

        return view('murid.pinjam', compact('loans'));
    }


    // RIWAYAT PENGEMBALIAN (ADMIN)
    public function riwayat()
    {
        $loans = Loan::with(['user', 'book'])
            ->where('status', 'kembali')
            ->latest()
            ->get();

        return view('admin.riwayat.index', compact('loans'));
    }


    // HALAMAN PENGEMBALIAN (MURID) - buku yang sedang dipinjam
    public function pengembalian()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();

        return view('murid.pengembalian', compact('loans'));
    }


    // PROSES KEMBALIKAN BUKU (MURID)
    public function kembalikanMurid($id)
    {
        $loan = Loan::findOrFail($id);

        // Pastikan loan milik user yang login
        if ($loan->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak');
        }

        $book = Book::find($loan->book_id);
        $today = now();
        $denda = 0;

        if ($today->greaterThan($loan->due_date)) {
            $days = $today->diffInDays($loan->due_date);
            $denda = $days * 1000;
        }

        $loan->update([
            'tanggal_kembali' => $today,
            'denda'           => $denda,
            'status'          => 'kembali'
        ]);

        if ($book) {
            $book->increment('stok');
        }

        return back()->with('success', 'Buku berhasil dikembalikan');
    }


    // RIWAYAT PEMINJAMAN (MURID)
    public function riwayatMurid()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('murid.riwayat', compact('loans'));
    }
}
