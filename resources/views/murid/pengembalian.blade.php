@extends('layouts.murid')

@section('content')
<div class="container py-4">

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Pengembalian Buku</h3>
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

            <h5 class="fw-semibold mb-3">Daftar Buku Sedang Dipinjam</h5>

            @if(isset($loans) && $loans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $index => $loan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $loan->book->judul ?? '-' }}</td>
                                    <td>{{ $loan->book->penulis ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d/m/Y') }}</td>
                                    <td>
                                        @if(\Carbon\Carbon::now()->greaterThan($loan->due_date))
                                            <span class="text-danger fw-semibold">
                                                {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}
                                            </span>
                                        @else
                                            {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(\Carbon\Carbon::now()->greaterThan($loan->due_date))
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('murid.kembalikan', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin mau kembalikan buku ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">
                                                Kembalikan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning mb-0">
                    Tidak ada buku yang sedang dipinjam.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
