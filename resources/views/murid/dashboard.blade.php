@extends('layouts.murid')

@section('content')

<div class="container-fluid">
    <h2 class="mb-1">Dashboard</h2>
    <p class="text-muted mb-4">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>

    {{-- STAT CARDS --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-primary border-4">
                <div class="card-body">
                    <h6 class="text-muted">Sedang Dipinjam</h6>
                    <h2 class="fw-bold">{{ $totalDipinjam ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-success border-4">
                <div class="card-body">
                    <h6 class="text-muted">Sudah Dikembalikan</h6>
                    <h2 class="fw-bold">{{ $totalDikembalikan ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-danger border-4">
                <div class="card-body">
                    <h6 class="text-muted">Terlambat</h6>
                    <h2 class="fw-bold">{{ $totalTerlambat ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- PEMINJAMAN AKTIF --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Peminjaman Aktif</strong>
            <a href="{{ route('murid.pengembalian') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamanAktif ?? [] as $loan)
                    <tr>
                        <td>{{ $loan->book->judul ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>
                        <td>
                            @if(\Carbon\Carbon::now()->greaterThan($loan->due_date))
                                <span class="badge bg-danger">Terlambat</span>
                            @else
                                <span class="badge bg-success">Aktif</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Tidak ada peminjaman aktif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- BUKU TERBARU --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Buku Terbaru</strong>
            <a href="{{ route('murid.pinjam') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukuTerbaru ?? [] as $buku)
                    <tr>
                        <td class="fw-semibold">{{ $buku->judul ?? '-' }}</td>
                        <td>{{ $buku->penulis ?? '-' }}</td>
                        <td>
                            @if($buku->stok > 0)
                                <span class="badge bg-success">Tersedia ({{ $buku->stok }})</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">Belum ada buku</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
