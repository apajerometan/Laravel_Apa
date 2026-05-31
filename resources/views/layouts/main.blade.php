<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APT Solutions</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-cpu"></i> APT Solutions
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
           href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" 
           href="{{ route('users.index') }}">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('customers.index') ? 'active' : '' }}" 
           href="{{ route('customers.index') }}">Customers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" 
           href="{{ route('profile') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
    </li>
</ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="footer py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} APT Solutions. All rights reserved.</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Toast Notifications --}}
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    @endif

    {{-- Toast Script --}}
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var toastEl = document.getElementById('successToast');
        var toastErr = document.getElementById('errorToast');
        
        if(toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
            setTimeout(() => toast.hide(), 3000);
        }
        if(toastErr) {
            var toast = new bootstrap.Toast(toastErr);
            toast.show();
            setTimeout(() => toast.hide(), 3000);
        }
    });
    </script>

</body>
</html>