<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login - Nepal Travel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            background: url('{{ asset('images/landingimg.png') }}') no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
        }

        .login-box {
            position: relative;
            z-index: 2;
            max-width: 420px;
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 18px;
            padding: 35px;
            color: white;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-login {
            background: #f5c842;
            border: none;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #e6b800;
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="d-flex justify-content-center align-items-center h-100 position-relative">

        <div class="login-box">

            <div class="logo">
                <i class="fas fa-mountain"></i> Nepal Travel Admin
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-login w-100 py-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

        </div>

    </div>

</body>

</html>
