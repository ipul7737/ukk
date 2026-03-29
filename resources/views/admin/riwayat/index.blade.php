@extends('layouts.admin')

@section('content')

<style>
table {
  border-spacing: 0;
  border-radius: 20px;
  overflow: hidden;
}

.table-light-primary, .table-light-primary > th, .table-light-primary > td {
    background-color: #0d6efd !important;
    color: #ffffff;
}
</style>

<div class="container-fluid">
    <h2 class="mb-4">Riwayat Pengembalian Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr class="table-light-primary">
                        <th width="50">No</th>
                        <th>Nama Anggota</th>
                        <th>NISN</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal tenggat</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->user->name ?? '-' }}</td>
                    <td>{{ $loan->user->nisn ?? '-' }}</td>
                    <td>{{ $loan->book->judul ?? '-' }}</td>

                    <td>
                        {{ $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') : '-' }}
                    </td>

                    <td>
                        {{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('d M Y') : '-' }}
                    </td>

                    <td>
                        {{ $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d M Y') : '-' }}
                    </td>

                    <td>
                        Rp {{ number_format($loan->denda ?? 0) }}
                    </td>

                    <td>
                        <span class="badge bg-success">Kembali</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada riwayat pengembalian</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
