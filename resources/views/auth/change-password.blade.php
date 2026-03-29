@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.murid')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Ganti Password</h3>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('murid.dashboard') }}"
           class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">Form Ganti Password</h5>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold">Password Lama</label>
                    <input type="password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password"
                           name="current_password"
                           placeholder="Masukkan password lama"
                           required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Masukkan password baru (min. 5 karakter)"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Ulangi password baru"
                           required>
                </div>

                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                    <i class="bi-key me-2"></i>
                    Ganti Password
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
