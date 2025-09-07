<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emirate Special Funds</title>
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
        .offer-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .offer-card:hover {
            transform: translateY(-5px);
        }
        .faq-item {
            border: none;
            border-bottom: 1px solid #e0e0e0;
        }
        .faq-item:last-child {
            border-bottom: none;
        }
        .accordion-button {
            background: white;
            border: none;
            box-shadow: none;
            font-weight: 600;
            padding: 20px 0;
        }
        .accordion-button:not(.collapsed) {
            background: white;
            color: #0072ff;
        }
        .accordion-button:focus {
            box-shadow: none;
        }
        .accordion-body {
            padding: 0 0 20px 0;
            color: #666;
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
        .section-divider {
            height: 4px;
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            border: none;
            margin: 0 auto 40px;
            width: 80px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Emirate Special Funds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#offers">What We Offer</a></li>
                <li class="nav-item"><a class="nav-link" href="#plans">Plans</a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        
                <!-- Added Login & Sign Up -->
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Sign Up</a>
                </li>
            </ul>
        </div>
        
    </div>
</nav>

<!-- Hero Section -->
<section class="hero d-flex align-items-center text-white" id="home" 
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('man.webp') center/cover no-repeat; min-height: 100vh;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Grow Your Wealth with Emirate Special Funds</h1>
        <p class="lead mb-4">Secure and flexible investment plans for every financial goal.</p>
        <a href="#plans" class="btn btn-primary btn-lg">Start Investing</a>
    </div>
</section>



<!-- What We Offer Section -->
<section id="offers" class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">What We Offer</h2>
        <hr class="section-divider">
        <div class="row g-4 mt-4">
           
            <div class="col-lg-12">
                <div class="offer-card">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-globe fa-2x text-primary me-3"></i>
                        <h4 class="fw-bold mb-0">Special Fund</h4>
                    </div>
                    <p class="text-muted">Emirate Special Fund invests in a comprehensive range of asset classes including global forex trading, commodities, equities, bonds, real estate, and alternative investments to ensure optimal diversification and risk-adjusted returns.</p>
                    
                    <div class="row g-3 mt-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exchange-alt text-warning me-2"></i>
                                <small class="fw-semibold">Global Forex</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-oil-can text-info me-2"></i>
                                <small class="fw-semibold">Commodities</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chart-line text-success me-2"></i>
                                <small class="fw-semibold">Equities</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-certificate text-primary me-2"></i>
                                <small class="fw-semibold">Fixed Income</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-building text-danger me-2"></i>
                                <small class="fw-semibold">Real Estate</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-coins text-warning me-2"></i>
                                <small class="fw-semibold">Alternatives</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="offer-card text-center">
                    <h5 class="fw-bold mb-3">Our Investment Philosophy</h5>
                    <p class="text-muted mb-4">We believe in strategic asset allocation across diverse investment vehicles to maximize returns while managing risk through geographical and sectoral diversification.</p>
                    
                    <div class="row g-3">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-globe-americas text-primary fa-2x mb-2"></i>
                            <h6 class="fw-bold">Global Exposure</h6>
                            <small class="text-muted">International markets and currencies</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-map-marker-alt text-success fa-2x mb-2"></i>
                            <h6 class="fw-bold">Local Markets</h6>
                            <small class="text-muted">UAE and regional opportunities</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-shield-alt text-warning fa-2x mb-2"></i>
                            <h6 class="fw-bold">Risk Management</h6>
                            <small class="text-muted">Professional portfolio balancing</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="fw-bold mb-4">About Emirate Special Funds</h2>
                <hr class="section-divider">
                <p class="lead mb-4">Emirate Special Funds is a Leveraged Asset Allocation Fund domiciled in United Kingdom. It offers investors a unique opportunity to access both local and global markets.</p>
                <p class="mb-4">The fund is managed by leading global investment firms including Aviva Investors, Investec, HSBC and Capital Group, and is licensed as a Special Collective Investment Scheme (CIS).</p>
            </div>
        </div>
        
        <div class="row g-4 mt-4">
            <!-- Regulatory Information -->
            <div class="col-lg-6">
                <div class="offer-card">
                    <h5 class="fw-bold mb-3"><i class="fas fa-shield-alt text-primary me-2"></i>Regulatory Oversight</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-semibold">Financial Conduct Authority (FCA-UK)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-semibold">Securities and Exchange Commission (SEC-USA)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-semibold">Financial Sector Conduct Authority (FSCA-SA)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="fw-semibold">Capital Markets Authority (CMA-Kenya)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Key Information -->
            <div class="col-lg-6">
                <div class="offer-card">
                    <h5 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Key Information</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Inception Date:</span>
                                <span class="fw-semibold">March 2023</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Base Currency:</span>
                                <span class="fw-semibold">US Dollar (USD)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Minimum Investment:</span>
                                <span class="fw-semibold text-success">$100</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Maximum Lock-in Period:</span>
                                <span class="fw-semibold">6 months</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Fund Manager:</span>
                                <span class="fw-semibold">Legal and General plc</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Regulated By:</span>
                                <span class="fw-semibold">SEC, FSCA, FCA, CMA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Plans Section -->
<section id="plans" class="py-5" style="background: linear-gradient(135deg, #f8f9fa, #eef3f9);">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Our Investment Plans</h2>
        <hr class="section-divider">
        <div class="row g-4 mt-4">
            <!-- 7 Days Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #00c6ff, #0072ff); border: none;">
                    <h4 class="fw-bold">7 Days Plan</h4>
                    <p>Perfect for quick returns with minimal lock-in period.</p>
                    <h3>UPTO 190% APY</h3>
                    <a href="/login" class="btn btn-light text-primary fw-bold mt-3">Invest Now</a>
                </div>
            </div>
            <!-- 30 Days Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #ff7e5f, #feb47b); border: none;">
                    <h4 class="fw-bold">30 Days Plan</h4>
                    <p>Ideal for those seeking steady growth within a month.</p>
                    <h3>UPTO 230% APY</h3>
                    <a href="/login" class="btn btn-light text-danger fw-bold mt-3">Invest Now</a>
                </div>
            </div>
            <!-- 6 Months Plan -->
            <div class="col-md-4">
                <div class="card plan-card p-4 text-center text-white" style="background: linear-gradient(135deg, #43cea2, #185a9d); border: none;">
                    <h4 class="fw-bold">6 Months Plan</h4>
                    <p>Best choice for long-term returns and higher rates.</p>
                    <h3>UPTO 290% APY</h3>
                    <a href="/login" class="btn btn-light text-success fw-bold mt-3">Invest Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Investment Portfolio Section -->
<section id="portfolio" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Our Investment Portfolio</h2>
        <hr class="section-divider">
        <p class="text-center text-muted mb-5">Emirate Special Fund achieves superior diversification through strategic allocation across multiple asset classes</p>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-exchange-alt fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Global Forex Trading</h5>
                    <p class="text-muted">Trading major currency pairs (USD/EUR, GBP/JPY) and emerging market currencies to capitalize on exchange rate movements and global economic trends.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-oil-can fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Commodities</h5>
                    <p class="text-muted">Investment in precious metals (gold, silver), energy commodities (oil, natural gas), and agricultural products (wheat, coffee) for inflation hedging.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold">Equities</h5>
                    <p class="text-muted">Diversified stock portfolio including blue-chip companies, growth stocks, and dividend-paying securities across global markets.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-certificate fa-3x text-info mb-3"></i>
                    <h5 class="fw-bold">Fixed Income Securities</h5>
                    <p class="text-muted">Government bonds, corporate bonds, and sukuk investments providing stable income streams and capital preservation.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-building fa-3x text-danger mb-3"></i>
                    <h5 class="fw-bold">Real Estate</h5>
                    <p class="text-muted">Real Estate Investment Trusts (REITs), direct property investments, and commercial real estate for long-term appreciation and rental income.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="offer-card text-center">
                    <i class="fas fa-coins fa-3x text-secondary mb-3"></i>
                    <h5 class="fw-bold">Alternative Investments</h5>
                    <p class="text-muted">Private equity, hedge funds, structured products, and other non-traditional assets for enhanced portfolio diversification and return potential.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Why Choose Emirate Special Funds</h2>
        <hr class="section-divider">
        <div class="row g-4 mt-4">
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

<!-- FAQ Section -->
<section id="faq" class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Frequently Asked Questions</h2>
        <hr class="section-divider">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                What is the minimum investment amount?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                The minimum investment amount varies by plan. Our 7-day plan starts from AED 1,000, while our 30-day and 6-month plans have a minimum of AED 5,000. Contact us for specific details about investment thresholds.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How are returns calculated and paid?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Returns are calculated on an annual basis (p.a.) and paid proportionally based on your investment period. For example, a 30-day investment at 6.5% p.a. would earn approximately 0.54% for the month. Returns are credited to your account at maturity.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What asset classes does the Special Fund invest in?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our Special Fund maintains a diversified portfolio across multiple asset classes including equities, fixed income securities, real estate investment trusts (REITs), commodities, and alternative investments. We invest both locally in the UAE market and internationally to optimize risk-adjusted returns.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Can I withdraw my investment before maturity?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our investment plans have specific lock-in periods to ensure optimal returns. Early withdrawal may be possible under certain circumstances but could result in reduced returns or penalties. We recommend choosing a plan that aligns with your liquidity needs.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Is my investment insured or guaranteed?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Emirate Special Funds operates under strict regulatory oversight and employs robust risk management practices. While investments carry inherent market risks, we prioritize capital preservation through diversified portfolios and professional fund management. Past performance and risk profiles are available upon request.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                How do I track my investment performance?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Once you invest, you'll receive access to our online portal where you can track your investment performance in real-time, view statements, and monitor fund allocations. We also provide regular updates via email and SMS.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Get In Touch</h2>
        <hr class="section-divider">
        <div class="row justify-content-center mt-4">
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
        <p class="mb-0">© 2025 Emirate Special Funds. All Rights Reserved.</p>
    </div>
</footer>
Talk.to code👇👇
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68a4595f93bb0e191e62546e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>