<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – GroCart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Patrick+Hand&family=Poppins&display=swap" rel="stylesheet">

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
            font-family: 'Poppins', sans-serif;
            color: var(--forest);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar --- */
        .navbar-main {
            background-color: var(--forest);
            padding: 0.75rem 2rem;
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

        .brand-name {
            font-family: 'Patrick Hand', serif;
            color: var(--cream);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .btn-nav-back {
            background: transparent;
            border: 1px solid rgba(242,234,228,0.3);
            color: var(--cream);
            padding: 7px 18px;
            border-radius: 6px;
            font-size: 0.875rem;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-nav-back:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* --- Page Wrapper --- */
        .page-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            position: relative;
            overflow: hidden;
        }

        .leaf-bg {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            opacity: 0.05;
        }

        /* --- Card --- */
        .login-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 32px rgba(16,55,64,0.08);
            position: relative;
            z-index: 1;
        }

        .card-icon {
            width: 56px;
            height: 56px;
            background-color: var(--fern);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.25rem;
        }

        .card-title {
            font-family: 'Open Sans', serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--forest);
            text-align: center;
            margin-bottom: 0.4rem;
        }

        .card-subtitle {
            font-size: 0.875rem;
            color: #6b7a6c;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        /* --- Error Box --- */
        .error-box {
            background-color: #fdf0ee;
            border: 1px solid var(--terracotta);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.84rem;
            color: var(--terracotta);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* --- Form --- */
        .form-label-custom {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--forest);
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 0.35rem;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #d0d8d1;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            color: var(--forest);
            background-color: #fafafa;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control-custom:focus {
            border-color: var(--fern);
            background-color: #ffffff;
        }

        .form-control-custom.is-invalid {
            border-color: var(--terracotta);
        }

        .invalid-msg {
            font-size: 0.8rem;
            color: var(--terracotta);
            margin-top: 4px;
            margin-bottom: 0.75rem;
        }

        /* --- Remember & Forgot --- */
        .row-remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-label {
            font-size: 0.875rem;
            color: #6b7a6c;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            user-select: none;
        }

        .forgot-link {
            font-size: 0.875rem;
            color: var(--fern);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--terracotta);
        }

        /* --- Submit Button --- */
        .btn-submit {
            width: 100%;
            background-color: var(--forest);
            color: var(--cream);
            border: none;
            padding: 13px;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 1.25rem;
        }

        .btn-submit:hover {
            background-color: var(--fern);
        }

        /* --- Divider --- */
        .divider {
            text-align: center;
            font-size: 0.8rem;
            color: #9aaa9b;
            margin-bottom: 1.25rem;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 38%;
            height: 1px;
            background-color: #e0e5e1;
        }

        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        /* --- Register Link --- */
        .register-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7a6c;
        }

        .register-link a {
            color: var(--fern);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: var(--terracotta);
        }

        /* --- Footer --- */
        .footer-main {
            background-color: var(--forest);
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 1.25rem;
            text-align: center;
        }

        .footer-main p {
            color: rgba(242,234,228,0.4);
            font-size: 0.78rem;
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar-main d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
            <span class="brand-icon">🌿</span>
            <span class="brand-name">GroCart</span>
        </a>

        <a href="{{ url('/') }}" class="btn-nav-back">← Back to Home</a>
    <!--  -->
    </nav>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="page-wrap">

        <svg class="leaf-bg" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="50"  cy="100" rx="140" ry="80"  fill="#3C593E" transform="rotate(20 50 100)"/>
            <ellipse cx="750" cy="500" rx="160" ry="90"  fill="#3C593E" transform="rotate(-25 750 500)"/>
            <ellipse cx="400" cy="580" rx="100" ry="60"  fill="#103740"/>
        </svg>

        <div class="login-card">

            <!-- Icon -->
            <div class="card-icon">🔑</div>

            <!-- Heading -->
            <h1 class="card-title">Welcome back</h1>
            <p class="card-subtitle">Sign in to your GroCart account</p>

            <!-- ==================== ERROR ALERT ==================== -->
            @if ($errors->any())
                <div class="error-box">
                    ⚠ {{ $errors->first() }}
                </div>
            @endif

            <!-- ==================== LOGIN FORM ==================== -->
            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label-custom">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control-custom {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @if ($errors->has('email'))
                        <p class="invalid-msg">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label-custom">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control-custom {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Enter your password"
                        required
                    >
                    @if ($errors->has('password'))
                        <p class="invalid-msg">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="row-remember">
                    <label class="remember-label">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Sign In</button>

            </form>

            <div class="divider">or</div>

            <p class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </p>

        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer-main">
        <p>&copy; {{ date('Y') }} GroCart — Grocery List App</p>
    </footer>

    <!-- ==================== TOAST NOTIFICATION ==================== -->
    @include('components.toast')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>