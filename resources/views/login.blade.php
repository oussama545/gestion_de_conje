<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Gestion de Congés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #343a40;
            text-align: center;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0.25);
        }
        button.btn-login {
            background: #0d6efd;
            color: white;
            font-weight: 600;
            width: 100%;
            padding: 0.6rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        button.btn-login:hover {
            background: #0b5ed7;
        }
        .form-text-error {
            color: #dc3545;
            font-size: 0.875rem;
        }
        @media (max-width: 576px) {
            .login-container {
                padding: 1.5rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="form-control @error('email') is-invalid @enderror"
                />
                @error('email')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                    class="form-control @error('password') is-invalid @enderror"
                />
                @error('password')
                <div class="form-text-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">Se connecter</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
