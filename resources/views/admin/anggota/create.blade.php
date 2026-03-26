@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <h3 class="mb-4">Tambah Anggota</h3>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-danger btn-sm">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
