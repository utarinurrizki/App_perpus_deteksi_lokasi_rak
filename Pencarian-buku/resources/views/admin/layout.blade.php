<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <style>
        :root{
            --primary:#3B5998;
            --primary-dark:#2C4A7C;
            --dark:#1E293B;
            --sidebar:#172033;
            --bg:#F3F6FB;
            --card:#FFFFFF;
            --border:#E8EDF3;
            --text:#243041;
            --muted:#7B8794;
            --success:#A8D08D;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:var(--bg);
            font-family:'Segoe UI',sans-serif;
            color:var(--text);
            overflow-x:hidden;
        }

        .main-wrapper{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:270px;
            background:linear-gradient(180deg,#1B2740 0%, #111827 100%);
            color:white;
            position:fixed;
            top:0;
            left:0;
            bottom:0;
            z-index:1000;
            padding:24px 18px;
            overflow-y:auto;
            transition:.3s ease;
        }

        .sidebar.hide{
            transform:translateX(-100%);
        }

        .brand{
            display:flex;
            align-items:center;
            gap:14px;
            padding-bottom:22px;
            border-bottom:1px solid rgba(255,255,255,.08);
            margin-bottom:22px;
        }

        .brand img{
            width:52px;
            height:52px;
            object-fit:contain;
        }

        .brand-text h4{
            margin:0;
            font-size:20px;
            font-weight:700;
        }

        .brand-text small{
            color:rgba(255,255,255,.65);
            font-size:12px;
        }

        .user-box{
            background:rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.06);
            border-radius:18px;
            padding:15px;
            margin-bottom:24px;
        }

        .user-box h6{
            margin:0;
            font-size:15px;
            font-weight:600;
        }

        .user-box small{
            color:rgba(255,255,255,.65);
        }

        .menu-title{
            color:rgba(255,255,255,.45);
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:1px;
            margin-bottom:10px;
            padding-left:10px;
        }

        .sidebar .nav-link{
            display:flex;
            align-items:center;
            gap:12px;
            color:rgba(255,255,255,.75);
            padding:13px 14px;
            border-radius:14px;
            margin-bottom:8px;
            font-size:15px;
            transition:.25s;
        }

        .sidebar .nav-link i{
            width:20px;
            text-align:center;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active{
            background:linear-gradient(135deg,var(--primary),var(--primary-dark));
            color:white;
            transform:translateX(3px);
            box-shadow:0 10px 25px rgba(59,89,152,.35);
        }

        /* MAIN */

        .main-content{
            margin-left:270px;
            width:calc(100% - 270px);
            display:flex;
            flex-direction:column;
            min-height:100vh;
            transition:.3s ease;
        }

        .main-content.full{
            margin-left:0;
            width:100%;
        }

        /* TOPBAR */

        .topbar{
            background:rgba(255,255,255,.85);
            backdrop-filter:blur(12px);
            border-bottom:1px solid var(--border);
            padding:18px 28px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            position:sticky;
            top:0;
            z-index:999;
        }

        .topbar-left{
            display:flex;
            align-items:center;
            gap:16px;
        }

        /* TOGGLE BUTTON */

        .toggle-sidebar{
            width:45px;
            height:45px;
            border:none;
            border-radius:14px;
            background:#EEF3FF;
            color:var(--primary);
            font-size:20px;
            transition:.2s;
        }

        .toggle-sidebar:hover{
            background:var(--primary);
            color:white;
        }

        .topbar-title h5{
            margin:0;
            font-size:20px;
            font-weight:700;
        }

        .topbar-title small{
            color:var(--muted);
        }

        .topbar-right{
            display:flex;
            align-items:center;
            gap:18px;
        }

        .admin-badge{
            background:#EEF3FF;
            color:var(--primary);
            padding:10px 16px;
            border-radius:14px;
            font-size:14px;
            font-weight:600;
        }

        .btn-logout{
            border:none;
            background:#FFEAEA;
            color:#D33;
            padding:10px 16px;
            border-radius:14px;
            font-weight:600;
            transition:.2s;
        }

        .btn-logout:hover{
            background:#ffdddd;
        }

        /* CONTENT */

        .content-area{
            flex:1;
            padding:30px;
        }

        /* ALERT */

        .alert{
            border:none;
            border-radius:16px;
            padding:16px 18px;
        }

        .alert-success{
            background:#EAF8E6;
            color:#256029;
        }

        .alert-danger{
            background:#FFF0F0;
            color:#B42318;
        }

        /* CARD */

        .card{
            border:none;
            border-radius:22px;
            box-shadow:0 10px 35px rgba(15,23,42,.05);
        }

        /* FOOTER */

        .footer{
            background:white;
            border-top:1px solid var(--border);
            padding:18px 30px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:10px;
        }

        .footer-text{
            color:var(--muted);
            font-size:14px;
        }

        .footer-social{
            display:flex;
            gap:14px;
        }

        .footer-social a{
            width:38px;
            height:38px;
            border-radius:12px;
            background:#F3F6FB;
            display:flex;
            align-items:center;
            justify-content:center;
            color:var(--primary);
            text-decoration:none;
            transition:.2s;
        }

        .footer-social a:hover{
            background:var(--primary);
            color:white;
            transform:translateY(-2px);
        }

        /* MOBILE */

        @media(max-width:991px){

            .sidebar{
                transform:translateX(-100%);
            }

            .sidebar.show{
                transform:translateX(0);
            }

            .main-content{
                margin-left:0;
                width:100%;
            }

            .topbar{
                padding:16px;
            }

            .content-area{
                padding:20px;
            }

            .admin-badge{
                display:none;
            }

        }
    </style>

    @stack('styles')
</head>

<body>

<div class="main-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <img src="https://png.pngtree.com/png-vector/20250211/ourmid/pngtree-colorful-book-stack-logo-design-perfect-for-education-or-library-projects-vector-png-image_15444285.png">

            <div class="brand-text">
                <h4>Perpustakaan</h4>
                <small>Panel Administrator</small>
            </div>

        </div>

        <div class="user-box">
            <h6>{{ auth()->user()->name }}</h6>
            <small>Administrator Perpustakaan</small>
        </div>

        <div class="menu-title">Menu Utama</div>

        <nav class="nav flex-column">

            <a href="/admin/dashboard"
               class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>

            <a href="/admin/racks"
               class="nav-link {{ request()->is('admin/racks*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                Data Rak
            </a>

            <a href="/admin/books"
               class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                Data Buku
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <div class="main-content" id="mainContent">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="topbar-left">

                <!-- TOGGLE -->
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="topbar-title">
                    <h5>@yield('title')</h5>
                    <small>Sistem Informasi Perpustakaan Umum</small>
                </div>

            </div>

            <div class="topbar-right">

                <div class="admin-badge">
                    <i class="fas fa-user-shield me-2"></i>
                    {{ auth()->user()->name }}
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn-logout">
                        <i class="fas fa-right-from-bracket me-1"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="content-area">

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>

        <!-- FOOTER -->
        <footer class="footer">

            <div class="footer-text">
               Copyright © 2026 Perpustakaan Umum
            </div>

            <div class="footer-social">

                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-x-twitter"></i></a>

            </div>

        </footer>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>

    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    /* Load status sidebar saat halaman dibuka */
    if(window.innerWidth > 991){

        const sidebarHidden = localStorage.getItem('sidebarHidden');

        if(sidebarHidden === 'true'){
            sidebar.classList.add('hide');
            mainContent.classList.add('full');
        }

    }

    /* Toggle sidebar */
    toggleBtn.addEventListener('click', function(){

        if(window.innerWidth <= 991){

            sidebar.classList.toggle('show');

        } else {

            sidebar.classList.toggle('hide');
            mainContent.classList.toggle('full');

            localStorage.setItem(
                'sidebarHidden',
                sidebar.classList.contains('hide')
            );

        }

    });

</script>

@stack('scripts')

</body>
</html>