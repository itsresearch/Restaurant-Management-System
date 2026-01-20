<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .login-title {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-control {
            height: 45px;
        }

        .btn-hotel {
            background: #b8860b;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-hotel:hover {
            background: #9c7400;
            color: #fff;
        }

        .icon-box {
            font-size: 45px;
            color: #b8860b;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="text-center">
        <div class="icon-box">
            <i class="fas fa-hotel"></i>
        </div>
        <h3 class="login-title">Hotel Management</h3>
        <p class="login-subtitle">Login to manage your hotel</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label">Remember me</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-hotel w-100 py-2">
            Login
        </button>
    </form>

</div>

</body>
</html>
