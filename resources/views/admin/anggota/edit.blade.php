@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Anggota</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('anggota.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $user->name }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ $user->email }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" class="form-control" value="{{ $user->nisn }}" readonly>
                    <input type="hidden" name="nisn" value="{{ $user->nisn }}">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        Edit
                    </button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-danger btn-sm">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
