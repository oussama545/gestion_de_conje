<!DOCTYPE html>
<html>
<head>
    <title>Gestion de Congés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="p-4">
<nav class="mb-4 d-flex justify-content-between align-items-center">
    <div class="">
        @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="btn btn-outline-primary">Dashboard</a>
            <a href="/admin/users" class="btn btn-outline-secondary">Utilisateurs</a>
            <a href="/admin/demandes" class="btn btn-outline-secondary">Demandes</a>
        @elseif(auth()->user()->role === 'employee')
            <a href="/employee/dashboard" class="btn btn-outline-primary">Mes Demandes</a>
            <a href="/employee/demande-form" class="btn btn-outline-secondary">Faire une Demande</a>
        @endif
    </div>
    <form action="{{ route('logout') }}" method="POST" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-danger">Se déconnecter</button>
    </form>
</nav>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@yield('content')
</body>
</html>