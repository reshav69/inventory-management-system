@extends('includes.welayout')
@section('content')
    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4">Efficient Inventory Management</h1>
            <p class="lead">Simplify your business with our Inventory Management System</p>
            <a href="{{route('dashboard')}}" class="btn btn-primary btn-lg">Get Started</a>
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

@endsection