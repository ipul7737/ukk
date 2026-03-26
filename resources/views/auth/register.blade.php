<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .login-card {
            border-radius: 20px;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
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

        /* TOMBOL KEMBALI - SENGAJA DIBIKIN NORAK BIAR KELIATAN */
        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 99999;
            background: red;
            color: white;
            padding: 12px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .btn-back:hover {
            background: darkred;
            color: white;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="
    min-height: 100vh;
    margin: 0;
    background: url('{{ asset('image/background.png') }}') no-repeat center center;
    background-size: cover;
    position: relative;
">

    <!-- Overlay Gelap -->
    <div style="
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1;
    "></div>

    <!-- TOMBOL KEMBALI (DI LUAR CARD, DI POJOK LAYAR) -->
    <a href="{{ route('login') }}" class="btn-back">← Kembali</a>

    <!-- CARD REGISTER -->
    <div class="card shadow-lg p-4 login-card" style="width: 500px;">
        <div class="text-center mb-1">
            <img src="{{ asset('image/logo.png') }}"
                alt="Logo"
                width="150"
                class="mb-0">
            <h3 class="fw-bold">SIMINBUK</h3>
            <p class="text-muted">Silakan Registrasi untuk melanjutkan</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <div class="mb-2">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Nisn</label>
                <input type="text" name="nisn" class="form-control" placeholder="Masukkan Nisn" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            </div>

            <button type="submit" class="btn btn-custom w-100 text-white">
                Registrasi
            </button>
        </form>
    </div>

</body>
</html>
