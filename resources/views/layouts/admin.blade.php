<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #f5f7fa;
    }

    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #ffffff;
        border-right: 1px solid #eaeaea;
    }

    .sidebar-menu {
        padding: 20px;
    }

    .sidebar .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border-radius: 10px;
        color: #555;
        font-weight: 500;
        transition: 0.2s;
    }

    .sidebar .nav-link i {
        font-size: 15px;
    }

    .sidebar .nav-link:hover {
        background: #eef2ff;
        color: #4f46e5;
    }

    .sidebar .nav-link.active {
        background: #e0e7ff;
        color: #4338ca;
    }

    .content-wrapper {
        flex: 1;
        padding: 40px;
    }

    .logout-btn {
        margin: 20px;
    }

    .profile-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: 0.2s;
    }

    .profile-link:hover {
        background: #eef2ff;
        border-radius: 10px;
    }
</style>
</head>

<body>
    <div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar">

        <!-- USER ACCOUNT (KLIKABLE) -->
        <div class="p-3 border-bottom">
            <a href="{{ route('password.form') }}" class="profile-link p-2">
                <div class="d-flex align-items-center gap-3">
                    <div style="
                        width: 45px;
                        height: 45px;
                        background: #4f46e5;
                        color: white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        font-weight: 600;
                        font-size: 18px;
                    ">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-semibold text-dark">
                            {{ auth()->user()->name }}
                        </div>
                        <small class="text-muted">
                            {{ ucfirst(auth()->user()->role) }} · <span class="text-primary" style="font-size:11px;">Ganti Password</span>
                        </small>
                    </div>
                </div>
            </a>
        </div>

        <!-- MENU -->
        <div class="sidebar-menu">
            <ul class="nav flex-column gap-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi-house"></i>
                        Dashboard
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('books.index') }}"
                    class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <i class="bi-book-half"></i>
                    Kelola Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('anggota.index') }}"
                    class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                    <i class="bi-person"></i>
                    Kelola Anggota
                    </a>
                </li>

                <li>
                    <a href="{{ route('peminjaman.index') }}"
                    class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <i class="bi-arrow-right-square"></i>
                    Kelola Peminjaman
                    </a>
                </li>

                <li>
                    <a href="/admin/riwayat"
                    class="nav-link {{ request()->is('admin/riwayat*') ? 'active' : '' }}">
                    <i class="bi-arrow-left-square"></i>
                    Riwayat Pengembalian
                    </a>
                </li>
                @endif
            </ul>
        </div>

        <!-- LOGOUT -->
        <div class="logout-btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger w-100">
                    <i class="bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
