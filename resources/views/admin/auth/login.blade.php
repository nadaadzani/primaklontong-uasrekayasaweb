<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PrimaKlontong</title>
    <link rel="stylesheet" href="{{ secure_asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 20px;
        position: relative;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.85;
        z-index: 0;
    }

    .login-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 420px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.18);
        box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        padding: 40px 35px;
        animation: fadeUp 0.6s ease;
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-header .logo-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 2rem;
        color: #fff;
        box-shadow: 0 10px 30px rgba(102,126,234,0.4);
    }

    .login-header h4 {
        color: #fff;
        font-weight: 700;
        font-size: 1.6rem;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .login-header p {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        margin: 4px 0 0;
    }

    .login-card .form-label {
        color: rgba(255,255,255,0.9);
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .login-card .form-control {
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.15);
        border-radius: 12px;
        padding: 12px 16px;
        color: #fff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .login-card .form-control:focus {
        background: rgba(255,255,255,0.2);
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.25);
        color: #fff;
    }

    .login-card .form-control::placeholder {
        color: rgba(255,255,255,0.4);
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 13px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        width: 100%;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(102,126,234,0.45);
        color: #fff;
    }

    .btn-login:active {
        transform: scale(0.98);
    }

    .login-footer {
        text-align: center;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.35);
        font-size: 0.75rem;
    }

    .login-footer strong {
        color: rgba(255,255,255,0.6);
    }

    .alert-custom {
        background: rgba(220,38,38,0.2);
        border: 1px solid rgba(220,38,38,0.3);
        border-radius: 12px;
        color: #fff;
        padding: 12px 16px;
        font-size: 0.85rem;
        margin-bottom: 18px;
        backdrop-filter: blur(10px);
    }

    .alert-custom ul {
        margin: 0;
        padding-left: 20px;
    }
</style>

<body>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon">
                <i class="fas fa-store"></i>
            </div>
            <h4>PrimaKlontong</h4>
            <p>Masuk ke dashboard admin</p>
        </div>

        <!-- ===== FORM ===== -->
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert-custom">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-user me-1"></i> Name</label>
                <input type="text" class="form-control" name="name" placeholder="admin" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock me-1"></i> Password</label>
                <input type="password" class="form-control" name="password" placeholder="••••••••" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">
                <i class="fas fa-arrow-right-to-bracket me-2"></i> Login
            </button>
        </form>

        <div class="login-footer">
            Demo: <strong>NadaYangIndah</strong> / <strong>password</strong>
        </div>

    </div>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>