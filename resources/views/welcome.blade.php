<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshCart – Grocery List</title>

     <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --forest:     #103740;
            --fern:       #3C593E;
            --gold:       #D9A443;
            --cream:      #F2EAE4;
            --terracotta: #D96B52;
        }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--forest);
        }

        /* --- Navbar --- */
        .navbar-main {
            background-color: var(--forest);
            padding: 0.75rem 2rem;
        }

        .navbar-brand-text {
            font-family: 'Playfair Display', serif;
            color: var(--cream) !important;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background-color: var(--gold);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-right: 8px;
        }

        .btn-nav-ghost {
            background: transparent;
            border: 1px solid rgba(242,234,228,0.3);
            color: var(--cream);
            padding: 7px 18px;
            border-radius: 6px;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }

        .btn-nav-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .btn-nav-primary {
            background-color: var(--gold);
            border: 1px solid var(--gold);
            color: var(--forest);
            padding: 7px 18px;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }

        .btn-nav-primary:hover {
            background-color: #c4912e;
            border-color: #c4912e;
            color: var(--forest);
        }

        /* --- Hero --- */
        .hero-section {
            padding: 6rem 1.5rem 4.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-leaf-bg {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            opacity: 0.06;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--fern);
            color: var(--cream);
            font-size: 0.72rem;
            font-weight: 500;
            padding: 5px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 600;
            color: var(--forest);
            line-height: 1.2;
            margin-bottom: 1.25rem;
        }

        .hero-title span {
            color: var(--fern);
        }

        .hero-subtitle {
            font-size: 1.05rem;
            color: #5a6a5b;
            font-weight: 300;
            line-height: 1.7;
            max-width: 480px;
            margin: 0 auto 2.5rem;
        }

        .btn-hero-main {
            background-color: var(--forest);
            color: var(--cream);
            border: none;
            padding: 13px 30px;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }

        .btn-hero-main:hover {
            background-color: var(--fern);
            color: var(--cream);
        }

        .btn-hero-alt {
            background: transparent;
            color: var(--forest);
            border: 1.5px solid var(--forest);
            padding: 13px 30px;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            margin-left: 1rem;
        }

        .btn-hero-alt:hover {
            border-color: var(--fern);
            color: var(--fern);
        }

        /* --- Features --- */
        .features-section {
            background-color: var(--forest);
            padding: 4.5rem 1.5rem;
        }

        .section-label {
            font-size: 0.72rem;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
            margin-bottom: 0.6rem;
        }

        .features-title {
            font-family: 'Playfair Display', serif;
            color: var(--cream);
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 2.5rem;
        }

        .feature-card {
            background-color: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .ic-green     { background-color: rgba(60,89,62,0.5); }
        .ic-gold      { background-color: rgba(217,164,67,0.2); }
        .ic-terracotta{ background-color: rgba(217,107,82,0.2); }

        .feature-card h5 {
            color: var(--cream);
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .feature-card p {
            color: rgba(242,234,228,0.6);
            font-size: 0.875rem;
            line-height: 1.65;
            font-weight: 300;
            margin: 0;
        }

        /* --- CTA Strip --- */
        .cta-section {
            background-color: var(--fern);
            padding: 4rem 1.5rem;
            text-align: center;
        }

        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            color: var(--cream);
            font-size: 1.85rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .cta-section p {
            color: rgba(242,234,228,0.75);
            font-size: 0.95rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        .btn-cream {
            background-color: var(--cream);
            color: var(--forest);
            border: none;
            padding: 13px 30px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.2s;
        }

        .btn-cream:hover {
            opacity: 0.88;
            color: var(--forest);
        }

        /* --- Footer --- */
        .footer-main {
            background-color: var(--forest);
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 1.5rem;
            text-align: center;
        }

        .footer-main p {
            color: rgba(242,234,228,0.4);
            font-size: 0.8rem;
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar navbar-main">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="brand-icon">🌿</span>
                <span class="navbar-brand-text">FreshCart</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn-nav-ghost text-decoration-none">Login</a>
                <a href="{{ route('register') }}" class="btn-nav-primary text-decoration-none">Register</a>
            </div>

        </div>
    </nav>

    <!-- ==================== HERO ====================  -->
    <section class="hero-section">

        <svg class="hero-leaf-bg" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="700" cy="80"  rx="180" ry="100" fill="#3C593E" transform="rotate(-30 700 80)"/>
            <ellipse cx="100" cy="420" rx="160" ry="90"  fill="#3C593E" transform="rotate(20 100 420)"/>
            <ellipse cx="400" cy="490" rx="120" ry="70"  fill="#103740" transform="rotate(-10 400 490)"/>
        </svg>

        <div class="position-relative">
            <h1 class="hero-title">
                Your Smart <span>Grocery List</span><br>All in One Place
            </h1>

            <p class="hero-subtitle">
                Plan your meals, track your grocery needs, and never forget an item again.
                Simple, organized, and always fresh.
            </p>

            <div>
                <a href="{{ route('register') }}" class="btn-hero-main">Get Started Free</a>
                <a href="{{ route('login') }}"    class="btn-hero-alt">Sign In</a>
            </div>
        </div>

    </section>

    <!-- ==================== FEATURES ==================== -->
    <section class="features-section">
        <div class="container">

            <p class="section-label">Why FreshCart?</p>
            <h2 class="features-title">Everything you need to shop smarter</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon ic-green">🥬</div>
                        <h5>Organized Lists</h5>
                        <p>Create and manage grocery lists by category. Keep everything neat and easy to find at the store.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon ic-gold">📊</div>
                        <h5>Smart Dashboard</h5>
                        <p>See your shopping trends at a glance with clear charts and reports tailored to your habits.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon ic-terracotta">👤</div>
                        <h5>Personal Profiles</h5>
                        <p>Your lists belong to you. Manage your account, update your info, and keep your data private.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== CTA STRIP ==================== -->
    <section class="cta-section">
        <h2>Ready to simplify your grocery run?</h2>
        <p>Join and start building your first list in seconds.</p>
        <a href="{{ route('register') }}" class="btn-cream">Create Free Account</a>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer-main">
        <p>&copy; {{ date('Y') }} FreshCart — Grocery List App</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>