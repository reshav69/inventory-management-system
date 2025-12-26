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
        .hero-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        .feature-icon {
            font-size: 2rem;
        }
    </style>
</head>
<body>
    @include('includes.navbar')

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">IMS</a>
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
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4">Efficient Inventory Management</h1>
            <p class="lead">Simplify your business with our Inventory Management System</p>
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Key Features</h2>
        <div class="row">
            <!-- Feature 1 -->
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-box"></i>
                </div>
                <h5>Real-time Inventory Tracking</h5>
                <p>Monitor your stock levels in real time, ensuring you never run out of crucial items.</p>
            </div>
            <!-- Feature 2 -->
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <h5>Comprehensive Reporting</h5>
                <p>Generate detailed reports to track inventory, sales, and trends for better decision-making.</p>
            </div>
            <!-- Feature 3 -->
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h5>Secure and Scalable</h5>
                <p>Our system ensures data security and can scale with your business growth.</p>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-light text-center py-4">
        <p>&copy; 2025 Inventory Management System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
