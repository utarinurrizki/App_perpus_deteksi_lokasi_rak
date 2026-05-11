<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(20,30,20,0.7), rgba(20,30,20,0.7)),
                        url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            backdrop-filter: blur(6px);
        }

        .logo {
            font-size: 40px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            background: #2c6e49;
            border: none;
        }

        .btn-login:hover {
            background: #1b4332;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
        }

        .password-wrapper {
            position: relative;
        }
    </style>
</head>

<body>

<div class="card login-card shadow p-4">
    
    <div class="text-center mb-3">
        <div class="logo">📚</div>
        <h4 class="fw-bold">Perpustakaan</h4>
        <small class="text-muted">Silakan login untuk mengakses dashboard</small>
    </div>

    <form action="/login" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3 password-wrapper">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        @error('email')
            <small class="text-danger d-block mb-3">{{ $message }}</small>
        @enderror

        <button type="submit" class="btn btn-login text-white w-100">
            Login
        </button>
    </form>

</div>

<script>
function togglePassword() {
    let input = document.getElementById("password");
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
</script>

</body>
</html>