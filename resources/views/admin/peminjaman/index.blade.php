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
    <h2 class="mb-4">Kelola Peminjaman Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <form method="GET" style="width:250px;">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Peminjaman..." class="form-control">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>

            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr class="table-light-primary">
                        <th width="50">No</th>
                        <th>Nama Anggota</th>
                        <th>NISN</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Due Date</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($loans as $loan)

                @php
                $denda = 0;
                if(!$loan->tanggal_kembali && $loan->due_date && now()->greaterThan($loan->due_date)){
                    $days = now()->diffInDays($loan->due_date);
                    $denda = $days * 1000;
                }
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->user->nisn }}</td>
                    <td>{{ $loan->book->judul }}</td>

                    <td>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</td>

                    <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>

                    <td>
                        Rp {{ number_format($denda) }}
                    </td>
                    <td>
                        @if($loan->tanggal_kembali)
                        <span class="badge bg-success">Kembali</span>
                        @elseif($loan->due_date && now()->greaterThan($loan->due_date))
                        <span class="badge bg-danger">Terlambat</span>
                        @else
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data peminjaman</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
