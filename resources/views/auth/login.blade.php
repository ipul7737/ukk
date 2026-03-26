<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Perpustakaan</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .login-card {
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }

        .btn-custom {
            background: #4e73df;
            border: none;
        }

        .btn-custom:hover {
            background: #2e59d9;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh;
        background: url('{{ asset('image/background.png') }}') no-repeat center center;
        background-size: cover;">
        <!-- Overlay Gelap -->
    <div style="
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    "></div>
    <div class="card shadow-lg p-4 login-card" style="width: 500px;">

        <div class="text-center mb-1">
            <img src="{{ asset('image/logo.png') }}"
                alt="Logo"
                width="150"
                class="mb-0">
            <h3 class="fw-bold">SIMINBUK</h3>
            <p class="text-muted">Silakan login untuk melanjutkan</p>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nisn</label>
                <input
                    type="text"
                    pattern="[0-9]+"
                    name="nisn"
                    class="form-control"
                    placeholder="Masukkan Nisn"
                    required
                >
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >
            </div>
            <button type="submit" class="btn btn-custom w-100 text-white">
                Login
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}">Daftar</a> |
                <a href="{{ route('password.form') }}">Ganti Password</a>
            </div>

        </form>

        <div class="text-center mt-3">
            <small class="text-muted">
                © {{ date('Y') }} Shann De Gratiaa
            </small>
        </div>

    </div>

</body>
</html> 
