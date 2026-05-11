<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <style>
        body { background: #f4f6fb; }
        .sidebar {
            min-height: 100vh;
            background: #2f3542;
            color: #fff;
        }
        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: 700;
            padding: 18px 12px;
            border-bottom: 1px solid #455064;
        }
        .sidebar .nav-link {
            color: #d9dee7;
            border-radius: 8px;
            margin: 6px 0;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #0d6efd;
            color: #fff;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 20px;
        }
        .content { padding: 20px; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 col-md-3 sidebar p-3">
                <div class="brand">Perpustakaan Umum</div>
                <div class="px-2 py-3 text-white-50">{{ auth()->user()->name }}</div>
                <nav class="nav flex-column">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">Dashboard</a>
                    <a href="/admin/books" class="nav-link {{ request()->is('admin/books') ? 'active' : '' }}">Data Buku</a>
                    <a href="/admin/members" class="nav-link {{ request()->is('admin/members') ? 'active' : '' }}">Data Anggota</a>
                </nav>
            </aside>
            <main class="col-lg-10 col-md-9 px-0">
                <div class="topbar d-flex justify-content-between align-items-center">
                    <div class="text-muted small">Panel Admin Perpustakaan</div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="small">Welcome, <strong>{{ auth()->user()->name }}</strong> | Petugas</div>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Logout</button>
                        </form>
                    </div>
                </div>
                <section class="content">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </section>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>
