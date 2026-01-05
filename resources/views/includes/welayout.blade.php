<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS (optional) -->
    <style>
        .navbar-icon{
            width:36px;
            height:36px;
            object-fit: contain;
            image-rendering: crips-edges;
        }

        .hero-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        .feature-icon {
            font-size: 2rem;
        }
        .cooler{
            background-color:#E7EeEe;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navigation Bar -->
    <nav class="navbar shadow-sm navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" id="icon" href="/">
                <img src="{{asset('iconsandshi/PASAL.gif')}}" alt="icon" class="navbar-icon" width="36">
                IMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login Here</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-fill cooler">
        @yield('content')

    </main>


    <!-- Footer Section -->
    <footer class="bg-light text-center py-4">
        <p>&copy; 2025 Inventory Management System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> --}}
</body>
</html>