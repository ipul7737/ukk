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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Kelola Buku</h2>
    </div>
    <div class="d-flex justify-content-between align-items-centerr mb-3">
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">+ Tambah Buku</a>
        <form method="GET" action="{{ route('books.index') }}">
            <div class="input-group"><input type="text" name="search" class="form-control" placeholder="Cari judul buku..." value="{{ request('search') }}">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr class="table-light-primary">
                        <th width="50">No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th width="100">Tahun</th>
                        <th width="80">Stok</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->tahun }}</td>
                        <td>{{ $book->stok }}</td>
                        <td>
                            @if($book->stok > 0)
                            <span class="badge bg-success">Tersedia</span>
                            @else
                            <span class="badge bg-danger">Dipinjam</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.edit',$book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('books.destroy',$book->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus buku ini?')">
                                Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Data buku tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
