@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Dashboard Admin</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-primary border-4">
                <div class="card-body">
                    <h6 class="text-muted">Total Judul Buku</h6>
                    <h2 class="fw-bold">{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-primary border-4">
                <div class="card-body"
                    <h6 class="text-muted">Total Anggota</h6>
                    <h2 class="fw-bold">{{ $totalAnggota }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-primary border-4">
                <div class="card-body">
                    <h6 class="text-muted">Buku Dipinjam</h6>
                    <h2 class="fw-bold">{{ $totalDipinjam }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
