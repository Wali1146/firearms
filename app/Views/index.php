<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhys Firearms | Premium Firearms & Accessories</title>
    
    <!-- Favicon -->
    <link rel="icon" href="css/favicon.ico">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&display=swap">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary: #1a1a1a;
            --secondary: #333;
            --accent: #c8102e;
            --text: #e8e8e8;
            --text-bright: #f0f0f0;
            --text-muted: #cccccc;
            --text-light: #b8b8b8;
            --light-bg: #f5f5f5;
            --border: #555;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background-color: #0a0a0a;
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
        }
        
        .bg-dark-custom {
            background-color: var(--primary) !important;
        }
        
        .bg-secondary-custom {
            background-color: var(--secondary) !important;
        }
        
        .text-accent {
            color: var(--accent) !important;
        }
        
        /* Updated text colors for better readability */
        .text-muted {
            color: var(--text-muted) !important;
        }
        
        .text-light {
            color: var(--text-light) !important;
        }
        
        .text-bright {
            color: var(--text-bright) !important;
        }
        
        .btn-accent {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.3s;
        }
        
        .btn-accent:hover {
            background-color: #a00d25;
            color: white;
        }
        
        .btn-outline-accent {
            border: 1px solid var(--accent);
            color: var(--accent);
            background: transparent;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.3s;
        }
        
        .btn-outline-accent:hover {
            background-color: var(--accent);
            color: white;
        }
        
        .border-accent {
            border-color: var(--accent) !important;
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            letter-spacing: 1px;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--accent) !important;
        }
        
        .dropdown-menu {
            background-color: var(--secondary);
            border: 1px solid var(--border);
            border-radius: 0;
        }
        
        .dropdown-item {
            color: var(--text);
            padding: 0.5rem 1rem;
        }
        
        .dropdown-item:hover {
            background-color: var(--accent);
            color: white;
        }
        
        .hero-section {
            background: linear-gradient(rgba(10, 10, 10, 0.85), rgba(10, 10, 10, 0.85)), 
                        url('img/hero/hero-bg.jpg') no-repeat center center;
            background-size: cover;
            padding: 120px 0 80px;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--accent);
        }
        
        .section-title.text-center:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .product-card {
            background-color: var(--secondary);
            border: 1px solid var(--border);
            transition: all 0.3s;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        
        .product-img {
            height: 200px;
            background-color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            overflow: hidden;
            position: relative;
        }
        
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .product-card:hover .product-img img {
            transform: scale(1.05);
        }
        
        .feature-box {
            background-color: var(--secondary);
            padding: 2rem;
            border-left: 3px solid var(--accent);
            height: 100%;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }
        
        .footer {
            background-color: #0a0a0a;
            border-top: 1px solid var(--border);
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--secondary);
            color: var(--text);
            border-radius: 0;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background-color: var(--accent);
            color: white;
        }
        
        .topbar {
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }
        
        .user-welcome {
            background: var(--secondary);
            padding: 1rem;
            border-left: 3px solid var(--accent);
            margin-bottom: 2rem;
        }
        
        .admin-panel {
            background: var(--secondary);
            padding: 2rem;
            border: 1px solid var(--accent);
            margin-bottom: 2rem;
        }
        
        .hero-product {
            background: var(--secondary);
            padding: 2rem;
            border: 1px solid var(--accent);
            text-align: center;
        }
        
        .hero-product-img {
            height: 250px;
            background: #222;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .hero-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Fallback styles if images don't load */
        .no-image {
            background: linear-gradient(45deg, #333, #555);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid topbar py-2 d-none d-lg-block bg-dark-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex">
                        <div class="me-4">
                            <i class="bi bi-envelope text-accent me-2"></i>
                            <span class="text-light">info@rhysfirearms.com</span>
                        </div>
                        <div>
                            <i class="bi bi-phone text-accent me-2"></i>
                            <span class="text-light">+1 (555) 123-4567</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom shadow-sm py-3">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <h1 class="m-0 text-uppercase text-bright">RHYS FIREARMS</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="products.php" class="nav-item nav-link">Products</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- User Welcome Section -->

    <!-- Admin Panel Preview -->

    <!-- Hero Section Start -->
    <div class="container-fluid hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 text-uppercase text-bright mb-4">PRECISION ENGINEERED FIREARMS</h1>
                    <p class="mb-4">For over three decades, Rhys Firearms has been crafting premium firearms with uncompromising quality, precision, and reliability.</p>
                    <div class="d-flex flex-wrap">
                        <a href="products.php" class="btn btn-accent me-3 mb-3">Explore Products</a>
                        <a href="about.php" class="btn btn-outline-light mb-3">Our Story</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-product">
                        <h3 class="text-accent mb-3">NEW RELEASE</h3>
                        <h4 class="text-bright mb-3">R-15 TACTICAL RIFLE</h4>
                        <div class="hero-product-img">
                            <!-- Local image for hero product -->
                            <img src="img/products/r15-tactical-rifle.jpg" alt="R-15 Tactical Rifle" 
                                 onerror="this.onerror=null; this.parentElement.classList.add('no-image'); this.parentElement.innerHTML='R-15 Tactical Rifle Image';">
                        </div>
                        <p>Advanced tactical rifle with precision engineering for professional use.</p>
                        <div class="text-center mt-3">
                            <a href="products.php" class="btn btn-accent">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Featured Products Start -->
    <!-- Featured Products End -->
    
    <!-- Features Start -->
    <div class="container-fluid py-5 bg-dark-custom">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-uppercase text-center text-bright">Why Choose Rhys Firearms</h2>
                <p>Our commitment to excellence sets us apart</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <h4 class="text-bright mb-3">Proven Quality</h4>
                        <p>Every firearm undergoes rigorous testing to ensure reliability and performance in all conditions.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4 class="text-bright mb-3">Expert Craftsmanship</h4>
                        <p>Our master gunsmiths combine traditional techniques with modern precision engineering.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="text-bright mb-3">Lifetime Warranty</h4>
                        <p>We stand behind our products with comprehensive warranty coverage and support.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
    
    <!-- Call to Action Start -->
    <div class="container-fluid py-5 bg-secondary-custom">
        <div class="container text-center">
            <h2 class="section-title text-uppercase text-center text-bright mb-4">Ready to Experience Rhys Quality?</h2>
            <p class="mb-4">Visit our showroom or contact us to learn more about our premium firearms</p>
            <a href="contact.php" class="btn btn-accent me-3">Find a Dealer</a>
            <a href="contact.php" class="btn btn-outline-accent">Contact Us</a>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Footer Start -->
    <div class="container-fluid footer py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase text-bright mb-4">RHYS FIREARMS</h4>
                    <p>Crafting precision firearms with uncompromising quality since 1987.</p>
                    <div class="d-flex pt-2">
                        <a class="social-icon" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-icon" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="social-icon" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase text-bright mb-4">Quick Links</h5>
                    <div class="d-flex flex-column">
                        <a class="mb-2" href="index.php"><i class="bi bi-arrow-right text-accent me-2"></i>Home</a>
                        <a class="mb-2" href="about.php"><i class="bi bi-arrow-right text-accent me-2"></i>About Us</a>
                        <a class="mb-2" href="products.php"><i class="bi bi-arrow-right text-accent me-2"></i>Products</a>
                        <a class="mb-2" href="services.php"><i class="bi bi-arrow-right text-accent me-2"></i>Services</a>
                        <a href="contact.php"><i class="bi bi-arrow-right text-accent me-2"></i>Contact</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase text-bright mb-4">Contact Info</h5>
                    <p class="mb-2"><i class="bi bi-geo-alt text-accent me-2"></i>123 Safety Lane, Gunville, TX 75001</p>
                    <p class="mb-2"><i class="bi bi-envelope text-accent me-2"></i>info@rhysfirearms.com</p>
                    <p class="mb-2"><i class="bi bi-phone text-accent me-2"></i>+1 (555) 123-4567</p>
                    <p><i class="bi bi-clock text-accent me-2"></i>Mon-Fri: 9AM-6PM, Sat: 10AM-4PM</p>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; <a class="text-bright border-bottom" href="index.php">Rhys Firearms</a>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>