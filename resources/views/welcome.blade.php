<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmiriateFunds - Premium Money Market Fund</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: #FFD700;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 8rem 0 4rem;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .cta-button {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: #333;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
        }

        /* Packages Section */
        .packages {
            padding: 4rem 0;
        }

        .section-title {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .package-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--accent-color);
        }

        .starter {
            --accent-color: linear-gradient(45deg, #4ECDC4, #36D1DC);
        }

        .professional {
            --accent-color: linear-gradient(45deg, #667eea, #764ba2);
            transform: scale(1.05);
            border: 2px solid #FFD700;
        }

        .enterprise {
            --accent-color: linear-gradient(45deg, #FF6B6B, #FF8E8E);
        }

        .package-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: bold;
        }

        .package-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .package-duration {
            color: #666;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .package-return {
            font-size: 3rem;
            font-weight: 800;
            background: var(--accent-color);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .package-features {
            list-style: none;
            margin: 2rem 0;
        }

        .package-features li {
            padding: 0.5rem 0;
            color: #555;
            position: relative;
            padding-left: 1.5rem;
        }

        .package-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #4ECDC4;
            font-weight: bold;
        }

        .package-button {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .package-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .popular-badge {
            position: absolute;
            top: -10px;
            right: 20px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            transform: rotate(10deg);
        }

        /* Features Section */
        .features {
            padding: 4rem 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            margin: 2rem 0;
            border-radius: 20px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-item {
            text-align: center;
            color: white;
            padding: 1.5rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .package-card {
            animation: fadeInUp 0.8s ease-out;
        }

        .package-card:nth-child(1) { animation-delay: 0.1s; }
        .package-card:nth-child(2) { animation-delay: 0.3s; }
        .package-card:nth-child(3) { animation-delay: 0.5s; }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .professional {
                transform: none;
            }
            
            .packages-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.3);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        .floating-elements {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">EmiriateFunds</div>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#packages">Packages</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <h1>Premium Money Market Fund</h1>
            <p>Secure, flexible, and profitable investment solutions tailored for your financial growth</p>
            <a href="#packages" class="cta-button">Explore Investment Plans</a>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="packages" id="packages">
        <div class="container">
            <h2 class="section-title">Choose Your Investment Plan</h2>
            <div class="packages-grid">
                <!-- Starter Package -->
                <div class="package-card starter">
                    <div class="package-icon">7D</div>
                    <h3 class="package-title">Quick Start</h3>
                    <p class="package-duration">7 Days Lock Period</p>
                    <div class="package-return">8.5%</div>
                    <p style="color: #666; margin-bottom: 1.5rem;">Annual Return</p>
                    <ul class="package-features">
                        <li>Minimum investment $1,000</li>
                        <li>Quick liquidity access</li>
                        <li>Daily interest calculation</li>
                        <li>Low risk investment</li>
                        <li>24/7 online monitoring</li>
                    </ul>
                    <button class="package-button" onclick="selectPackage('Quick Start')">Get Started</button>
                </div>

                <!-- Professional Package -->
                <div class="package-card professional">
                    <div class="popular-badge">Most Popular</div>
                    <div class="package-icon">30D</div>
                    <h3 class="package-title">Professional</h3>
                    <p class="package-duration">30 Days Lock Period</p>
                    <div class="package-return">12.8%</div>
                    <p style="color: #666; margin-bottom: 1.5rem;">Annual Return</p>
                    <ul class="package-features">
                        <li>Minimum investment $5,000</li>
                        <li>Enhanced returns</li>
                        <li>Priority customer support</li>
                        <li>Monthly performance reports</li>
                        <li>Risk diversification</li>
                    </ul>
                    <button class="package-button" onclick="selectPackage('Professional')">Choose Plan</button>
                </div>

                <!-- Enterprise Package -->
                <div class="package-card enterprise">
                    <div class="package-icon">6M</div>
                    <h3 class="package-title">Elite Growth</h3>
                    <p class="package-duration">6 Months Lock Period</p>
                    <div class="package-return">18.5%</div>
                    <p style="color: #666; margin-bottom: 1.5rem;">Annual Return</p>
                    <ul class="package-features">
                        <li>Minimum investment $25,000</li>
                        <li>Maximum returns</li>
                        <li>Dedicated account manager</li>
                        <li>Quarterly bonus rewards</li>
                        <li>Premium investment strategies</li>
                    </ul>
                    <button class="package-button" onclick="selectPackage('Elite Growth')">Premium Access</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose EmiriateFunds?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Secure & Regulated</h3>
                    <p>FDIC insured investments with full regulatory compliance</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">📈</div>
                    <h3 class="feature-title">Competitive Returns</h3>
                    <p>Industry-leading interest rates with transparent fee structure</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Instant Access</h3>
                    <p>Real-time portfolio monitoring and quick fund access</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💼</div>
                    <h3 class="feature-title">Expert Management</h3>
                    <p>Professional fund managers with decades of experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 EmiriateFunds. All rights reserved. | Licensed Money Market Fund Provider</p>
        </div>
    </footer>

    <script>
        function selectPackage(packageName) {
            alert(`Thank you for selecting the ${packageName} package! Our team will contact you shortly to complete your investment setup.`);
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.2)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.1)';
            }
        });

        // Animate cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all package cards
        document.querySelectorAll('.package-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>