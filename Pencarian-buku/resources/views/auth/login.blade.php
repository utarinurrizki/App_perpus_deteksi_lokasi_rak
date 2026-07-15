<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3f5fa8;
            --primary-dark: #2d4d92;
            --glass: rgba(255,255,255,0.15);
            --white: #ffffff;
            --text: #1d2a44;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            min-height:100vh;
            font-family:'Segoe UI',sans-serif;
            overflow:hidden;

            background:
                linear-gradient(rgba(16,28,54,0.55), rgba(16,28,54,0.55)),
                url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=1974&auto=format&fit=crop')
                center center/cover no-repeat;

            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
        }

        /* Blur overlay */
        body::before{
            content:'';
            position:absolute;
            inset:0;
            backdrop-filter: blur(2px);
            background: rgba(255,255,255,0.05);
        }

        .login-wrapper{
            position:relative;
            z-index:2;
            width:100%;
            max-width:430px;
            padding:20px;
        }

        .glass-card{
            background: rgba(255,255,255,0.18);
            border:1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border-radius:24px;
            padding:45px 35px;

            box-shadow:
                0 10px 40px rgba(0,0,0,0.25),
                inset 0 0 1px rgba(255,255,255,0.3);
        }

        .logo-area{
            text-align:center;
            margin-bottom:28px;
        }

        .logo-area img{
            width:75px;
            height:75px;
            object-fit:contain;
            margin-bottom:12px;
            filter: drop-shadow(0 5px 12px rgba(0,0,0,0.2));
        }

        .logo-area h2{
            color:white;
            font-size:32px;
            font-weight:700;
            margin-bottom:5px;
        }

        .logo-area p{
            color:rgba(255,255,255,0.85);
            font-size:14px;
        }

        .form-label{
            color:white;
            font-weight:600;
            font-size:14px;
            margin-bottom:8px;
        }

        .form-control{
            height:52px;
            border:none;
            border-radius:14px;
            background: rgba(255,255,255,0.88);
            padding-left:18px;
            font-size:15px;
            box-shadow:none !important;
        }

        .form-control:focus{
            background:white;
            border:none;
        }

        .password-wrapper{
            position:relative;
        }

        .toggle-password{
            position:absolute;
            right:15px;
            top:50%;
            transform:translateY(-50%);
            border:none;
            background:none;
            color:#666;
            cursor:pointer;
        }

        .remember-area{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-top:14px;
            margin-bottom:24px;
        }

        .form-check-label{
            color:white;
            font-size:14px;
        }

        .forgot-link{
            color:white;
            text-decoration:none;
            font-size:14px;
            opacity:0.9;
        }

        .forgot-link:hover{
            opacity:1;
            text-decoration:underline;
        }

        .btn-login{
            width:100%;
            height:54px;
            border:none;
            border-radius:14px;

            background: linear-gradient(
                135deg,
                var(--primary),
                var(--primary-dark)
            );

            color:white;
            font-weight:700;
            font-size:16px;
            letter-spacing:.5px;

            transition:.3s;
        }

        .btn-login:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(63,95,168,0.45);
        }

        .footer-text{
            text-align:center;
            margin-top:22px;
            color:rgba(255,255,255,0.85);
            font-size:13px;
        }

        .alert{
            border:none;
            border-radius:14px;
        }

        @media(max-width:576px){

            .glass-card{
                padding:35px 24px;
            }

            .logo-area h2{
                font-size:26px;
            }

        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="glass-card">

        <div class="logo-area">

            <img
                src="https://png.pngtree.com/png-vector/20250211/ourmid/pngtree-colorful-book-stack-logo-design-perfect-for-education-or-library-projects-vector-png-image_15444285.png"
                alt="Logo Perpustakaan"
            >

            <h2>Perpustakaan</h2>

            <p>Panel Administrator Perpustakaan Umum</p>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/login" method="POST" novalidate>

            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"  
                >
            </div>

            <div class="mb-5">
                <label class="form-label">Password</label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan password"
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>

                </div>
            </div>

           
            <button type="submit" class="btn-login">
                <i class="fas fa-right-to-bracket me-2"></i>
                Log In
            </button>

        </form>

    </div>

</div>

<script>

function togglePassword(){

    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if(password.type === 'password'){

        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');

    }else{

        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');

    }

}

</script>

</body>
</html>