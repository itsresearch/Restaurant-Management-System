<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                        url('https://images.unsplash.com/photo-1566073771259-6a8506099945');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .register-title {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .register-subtitle {
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

        .small-link {
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="register-card">

    <div class="text-center">
        <div class="icon-box">
            <i class="fas fa-hotel"></i>
        </div>
        <h3 class="register-title">Create Account</h3>
        <p class="register-subtitle">Join our Hotel Management System</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-hotel w-100 py-2">
            Register
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="small-link text-decoration-none">
                Already have an account? Login
            </a>
        </div>
    </form>

</div>

</body>
</html>
