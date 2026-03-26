@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Edit Buku</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('books.update',$book->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="{{ $book->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ $book->penulis }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ $book->penerbit }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="{{ $book->tahun }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $book->stok }}" required>
                </div>

                <button class="btn btn-success">
                    Update Buku
                </button>

                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>

@endsection
