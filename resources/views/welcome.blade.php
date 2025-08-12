<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emirates Funds</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            scroll-behavior: smooth;
        }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('your-hero-image.jpg') center/cover no-repeat;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .plan-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0,0,0,0.15);
        }
        footer {
            background: #111;
            color: #ccc;
            padding: 30px 0;
        }
        footer a {
            color: #ccc;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Emirates Funds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#plans">Plans</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero d-flex align-items-center text-white" id="home" 
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('man.webp') center/cover no-repeat; min-height: 100vh;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Grow Your Wealth with Emirates Funds</h1>
        <p class="lead mb-4">Secure and flexible investment plans for every financial goal.</p>
        <a href="#plans" class="btn btn-primary btn-lg">Start Investing</a>
    </div>
</section>


<!-- About Section -->
<section id="about" class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">About Emirates Funds</h2>
        <p class="mb-5">At Emirates Funds, we provide competitive Money Market Fund and Special Fund solutions designed for both short-term and long-term investors. Our flexible lock-in plans let you choose the investment duration that fits your needs, while enjoying attractive returns with security you can trust.</p>
    </div>
</section>

<!-- Plans Section -->
<section id="plans" class="py-5" style="background: linear-gradient(135deg, #f8f9fa, #eef3f9);">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Our Investment Plans</h2>
        <div class="row g-4">
            <!-- 7 Days Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #00c6ff, #0072ff); border: none;">
                    <h4 class="fw-bold">7 Days Plan</h4>
                    <p>Perfect for quick returns with minimal lock-in period.</p>
                    <h3>5% p.a</h3>
                    <a href="/login" class="btn btn-light text-primary fw-bold mt-3">Invest Now</a>
                </div>
            </div>
            <!-- 30 Days Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #ff7e5f, #feb47b); border: none;">
                    <h4 class="fw-bold">30 Days Plan</h4>
                    <p>Ideal for those seeking steady growth within a month.</p>
                    <h3>6.5% p.a</h3>
                    <a href="/login" class="btn btn-light text-danger fw-bold mt-3">Invest Now</a>
                </div>
            </div>
            <!-- 6 Months Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #43cea2, #185a9d); border: none;">
                    <h4 class="fw-bold">6 Months Plan</h4>
                    <p>Best choice for long-term returns and higher rates.</p>
                    <h3>8% p.a</h3>
                    <a href="/login" class="btn btn-light text-success fw-bold mt-3">Invest Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Why Choose Emirates Funds</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <i class="fas fa-hand-holding-usd fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">High Returns</h5>
                <p>Enjoy competitive rates with flexible investment terms.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-lock fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">Secure Investments</h5>
                <p>Your capital is safeguarded with top-tier financial security.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-chart-line fa-3x mb-3 text-primary"></i>
                <h5 class="fw-bold">Proven Performance</h5>
                <p>Consistent returns backed by professional fund management.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Get In Touch</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p class="mb-0">© 2025 Emirates Funds. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
