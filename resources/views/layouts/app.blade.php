<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'GroCart'))</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Patrick+Hand&family=Poppins&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --forest:     #103740;
            --fern:       #3C593E;
            --gold:       #D9A443;
            --cream:      #F2EAE4;
            --terracotta: #D96B52;
            --accent-teal: #3D8F8F;
            --white: #FFFFFF;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.03), 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.08);
            --transition: all 0.2s ease;
        }

        body {
            background-color: var(--cream);
            font-family: 'Poppins', sans-serif;
            color: var(--forest);
            font-weight: 400;
            line-height: 1.5;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--forest) 0%, var(--fern) 100%);
            display: flex;
            flex-direction: column;position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 2px 0 15px rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        /* Brand */
        .sidebar-brand {
            padding: 1.75rem 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 0.5rem;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--cream) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .brand-name {
            font-family: 'Patrick Hand', serif;
            color: var(--white);
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .brand-tagline {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        /* Section Labels */
        .nav-section-label {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
            padding: 1.25rem 1.5rem 0.6rem;
            margin: 0;
        }

        /* Nav Links */
        .nav-links {
            list-style: none;
            padding: 0 0.75rem;
            margin: 0;
        }

        .nav-links li {
            margin-bottom: 4px;
        }

        .nav-links a {
            min-height: 44px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 12px;
            box-sizing: border-box;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .nav-links a:hover {
            background-color: rgba(255,255,255,0.08);
            color: var(--white);
            transform: translateX(2px);
        }

        .nav-links a.active {
            background: linear-gradient(95deg, rgba(61,143,143,0.25) 0%, rgba(61,143,143,0.1) 100%);
            color: var(--white);
            font-weight: 500;
            backdrop-filter: blur(2px);
            border-left: 3px solid var(--accent-teal);
            box-sizing: border-box;
        }

        .nav-icon {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 0.75rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .user-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 14px;
            margin-bottom: 12px;
            background: rgba(255,255,255,0.03);
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent-teal) 0%, #2C6E6E 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: var(--white);
            font-weight: 600;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .user-name {
            font-size: 0.9rem;
            color: var(--white);
            font-weight: 600;
            line-height: 1.3;
        }

        .user-email {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            font-weight: 400;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px 16px;
            border-radius: 40px;
            background: rgba(224,122,95,0.12);
            border: none;
            color: var(--gold);
            font-size: 0.85rem;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background-color: var(--gold);
            color: var(--white);
            transform: translateY(-1px);
        }

        /* ==================== TOPBAR ==================== */
        .topbar {
            margin-left: 260px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar-title {
            font-family: 'Open Sans', serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--forest);
            letter-spacing: -0.3px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-date {
            font-size: 0.85rem;
            color: rgba(16,55,64,0.7);
            font-weight: 400;
            background: var(--cream);
            padding: 6px 14px;
            border-radius: 40px;
        }

        /* ==================== MAIN CONTENT AREA ==================== */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: calc(100vh - 64px);
        }

        /* Card */
        .card-custom {
            background: var(--white);
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }
        .card-custom:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        /* Dashboard stats cards */
        .stat-card {
            background: var(--white);
            border-radius: 24px;
            padding: 1.25rem;
            transition: var(--transition);
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .topbar, .main-content {
                margin-left: 0;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
    
        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <div class="brand-icon">🥬</div>
            <div>
                <div class="brand-name">GroCart</div>
                <div class="brand-tagline">Smart Grocery</div>
            </div>
        </a>
    
        <!-- Main Menu -->
        <p class="nav-section-label">Main Menu</p>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-grid-1x2-fill"></i></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('grocery.index') }}" class="{{ request()->routeIs('grocery.*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-basket-fill"></i></span>
                    Grocery List
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
                    Users
                </a>
            </li>
        </ul>
    
        <!-- Account -->
        <p class="nav-section-label">Account</p>
        <ul class="nav-links">
            <li>
                <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-person-circle"></i></span>
                    My Profile
                </a>
            </li>
        </ul>
    
        <!-- User Info & Logout -->
        <div class="sidebar-footer">
            <div class="user-row">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
    
            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>
    
    <!-- TOPBAR -->
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('l, F j, Y') }}
            </span>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.stat-card, .card-custom');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.2s ease';
                });
            });
        });
    </script>
</body>
</html>