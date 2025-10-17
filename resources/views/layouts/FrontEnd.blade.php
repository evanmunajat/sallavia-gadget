<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sallavia Gadget</title>

    <link rel="icon" type="image/png" href="{{ asset('asset/img/favicon/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/img/favicon/favicon.png') }}">
    <meta name="theme-color" content="#2563eb">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
</head>
<body>

    <!-- Navbar -->
    @include('partials.navbar-frontend')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('partials.footer-frontend')

    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('asset/js/script.js') }}"></script>
</body>
</html>
