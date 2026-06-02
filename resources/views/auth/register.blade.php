<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – FreshCart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ==================== NAVBAR ==================== */
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
            font-family: 'Playfair Display', serif;
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
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-nav-back:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ==================== PAGE WRAP ==================== */
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

        /* ==================== CARD ==================== */
        .register-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 4px 32px rgba(16,55,64,0.08);
            position: relative;
            z-index: 1;
        }

        .card-icon {
            width: 56px;
            height: 56px;
            background-color: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.25rem;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 600;
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

        /* ==================== FORM ==================== */
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
            font-family: 'DM Sans', sans-serif;
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
            display: block;
        }

        /* Password input wrapper */
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap input {
            width: 100%;
            padding-right: 45px;
        }

        /* Password toggle */
        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9CA3AF;
            cursor: pointer;
            padding: 0;
            z-index: 2;
            transition: color 0.2s;
        }

        .toggle-pass:hover {
            color: var(--fern);
        }

        /* Password Match Indicator */
        .match-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .match-success {
            color: #198754;
        }

        .match-error {
            color: #DC3545;
        }

        .match-border-success {
            border-color: #198754 !important;
        }

        .match-border-error {
            border-color: #DC3545 !important;
        }
        /* ==================== SUBMIT ==================== */
        .btn-submit {
            width: 100%;
            background-color: var(--forest);
            color: var(--cream);
            border: none;
            padding: 13px;
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 1.25rem;
        }

        .btn-submit:hover {
            background-color: var(--fern);
        }

        /* ==================== DIVIDER ==================== */
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

        /* ==================== LOGIN LINK ==================== */
        .login-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7a6c;
        }

        .login-link a {
            color: var(--fern);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: var(--terracotta);
        }

        /* ==================== FOOTER ==================== */
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

        /* ==================== TOAST ==================== */
        .toast-box {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 14px 22px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--cream);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .toast-success { background-color: var(--fern); }
        .toast-error   { background-color: var(--terracotta); }
    </style>
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar-main d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
            <span class="brand-icon">🌿</span>
            <span class="brand-name">FreshCart</span>
        </a>

        <a href="{{ url('/') }}" class="btn-nav-back">← Back to Home</a>

    </nav>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="page-wrap">
        <svg class="leaf-bg" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="750" cy="100" rx="140" ry="80"  fill="#3C593E" transform="rotate(-20 750 100)"/>
            <ellipse cx="50"  cy="500" rx="160" ry="90"  fill="#3C593E" transform="rotate(25 50 500)"/>
            <ellipse cx="400" cy="580" rx="100" ry="60"  fill="#103740"/>
        </svg>

        <div class="register-card">

            <!-- Icon -->
            <div class="card-icon">🌱</div>

            <!-- Heading -->
            <h1 class="card-title">Create an account</h1>
            <p class="card-subtitle">Join FreshCart and start managing your grocery list</p>

            <!-- ==================== REGISTER FORM ==================== -->
            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <!-- Full Name -->
                <div class="mb-3">
                    <label for="name" class="form-label-custom">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control-custom {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        placeholder="Juan Dela Cruz"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >
                    @if ($errors->has('name'))
                        <span class="invalid-msg">{{ $errors->first('name') }}</span>
                    @endif
                </div>

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
                    >
                    @if ($errors->has('email'))
                        <span class="invalid-msg">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label-custom">Password</label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-custom {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Minimum 8 characters"
                            required
                            autocomplete="new-password"
                            oninput="checkStrength(this.value); checkMatch();"
                        >

                        <button
                            type="button"
                            class="toggle-pass"
                            id="togglePass"
                            aria-label="Show or hide password">
                            <i class="bi bi-eye" id="togglePassIcon"></i>
                        </button>
                    </div>

                    @if ($errors->has('password'))
                        <span class="invalid-msg">{{ $errors->first('password') }}</span>
                    @endif

                    <!-- Strength Bars -->
                    <div class="strength-bar-row">
                        <div class="strength-bar-seg" id="seg1"></div>
                        <div class="strength-bar-seg" id="seg2"></div>
                        <div class="strength-bar-seg" id="seg3"></div>
                        <div class="strength-bar-seg" id="seg4"></div>
                    </div>

                    <div class="strength-label" id="strengthLabel" style="color:#9CA3AF;">
                        Enter a password
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label-custom">
                        Confirm Password
                    </label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control-custom"
                            placeholder="Re-enter your password"
                            required
                            autocomplete="new-password"
                            oninput="checkMatch()"
                        >

                        <button
                            type="button"
                            class="toggle-pass"
                            id="toggleConfirm"
                            aria-label="Show or hide confirm password">
                            <i class="bi bi-eye" id="toggleConfirmIcon"></i>
                        </button>
                    </div>
                    <div class="match-indicator" id="matchIndicator" style="display:none;"></div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Create Account</button>

            </form>

            <div class="divider">or</div>

            <p class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </p>

        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer-main">
        <p>&copy; {{ date('Y') }} FreshCart — Grocery List App</p>
    </footer>

    <!-- ==================== TOAST ON SUCCESSFUL REGISTRATION ==================== -->
    @include('components.toast')

    <script>
        // ── Password Toggle (main) ──
        document.getElementById('togglePass').addEventListener('click', function () {
            const pw   = document.getElementById('password');
            const icon = document.getElementById('togglePassIcon');
            pw.type = pw.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        // ── Password Toggle (confirm) ──
        document.getElementById('toggleConfirm').addEventListener('click', function () {
            const pw   = document.getElementById('password_confirmation');
            const icon = document.getElementById('toggleConfirmIcon');
            pw.type = pw.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        /* Password strength checker */
        function checkStrength(value) {
            const segments = [
                document.getElementById('seg1'),
                document.getElementById('seg2'),
                document.getElementById('seg3'),
                document.getElementById('seg4')
            ];

            const label = document.getElementById('strengthLabel');

            segments.forEach(seg => {
                seg.style.background = '#E9ECEF';
            });

            let strength = 0;

            if (value.length >= 8) strength++;
            if (/[A-Z]/.test(value)) strength++;
            if (/[0-9]/.test(value)) strength++;
            if (/[^A-Za-z0-9]/.test(value)) strength++;

            if (value.length === 0) {
                label.textContent = 'Enter a password';
                label.style.color = '#9CA3AF';
                return;
            }

            let color = '';
            let text = '';

            if (strength === 1) {
                color = '#D96B52';
                text = 'Weak';
            } else if (strength === 2) {
                color = '#D9A443';
                text = 'Fair';
            } else if (strength === 3) {
                color = '#3C593E';
                text = 'Good';
            } else {
                color = '#103740';
                text = 'Strong';
            }

            for (let i = 0; i < strength; i++) {
                segments[i].style.background = color;
            }

            label.textContent = `Strength: ${text}`;
            label.style.color = color;
        }

        // ── Password Match Checker ──
        function checkMatch() {
            const password = document.getElementById('password').value;
            const confirmField = document.getElementById('password_confirmation');
            const confirm = confirmField.value;
            const indicator = document.getElementById('matchIndicator');

            confirmField.classList.remove(
                'match-border-success',
                'match-border-error'
            );

            if (confirm.length === 0) {
                indicator.style.display = 'none';
                return;
            }

            indicator.style.display = 'flex';

            if (password === confirm) {
                confirmField.classList.add('match-border-success');
                indicator.className = 'match-indicator match-success';
                indicator.innerHTML =
                    '<i class="bi bi-check-circle-fill"></i> Passwords match';
            } else {
                confirmField.classList.add('match-border-error');
                indicator.className = 'match-indicator match-error';
                indicator.innerHTML =
                    '<i class="bi bi-x-circle-fill"></i> Passwords do not match';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>