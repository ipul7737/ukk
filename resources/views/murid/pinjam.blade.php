@extends('layouts.murid')

@section('content')
<div class="container py-4">

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Pinjam Buku</h3>
        <a href="{{ route('murid.dashboard') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card utama --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h5 class="fw-semibold mb-3">Daftar Buku Tersedia</h5>

            @if(isset($books) && $books->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $index => $book)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $book->judul }}</td>
                                    <td>{{ $book->penulis ?? '-' }}</td>
                                    <td>{{ $book->kategori ?? '-' }}</td>
                                    <td>
                                        @if($book->stok > 0)
                                            <span class="badge bg-success">Tersedia ({{ $book->stok }})</span>
                                        @else
                                            <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($book->stok > 0)
                                            <form action="{{ route('murid.pinjam.store', $book->id) }}" method="POST" onsubmit="return confirm('Yakin mau pinjam buku ini?')">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">
                                                    Pinjam
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                                Tidak Tersedia
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning mb-0">
                    Belum ada buku yang tersedia untuk dipinjam.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
