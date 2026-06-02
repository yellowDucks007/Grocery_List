<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GroCart')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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
            margin: 0;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: var(--forest);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        /* Brand */
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background-color: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Patrick Hand', serif;
            color: var(--cream);
            font-size: 1.15rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .brand-tagline {
            font-size: 0.7rem;
            color: rgba(242,234,228,0.45);
            font-weight: 300;
        }

        /* Section Labels */
        .nav-section-label {
            font-size: 0.65rem;
            color: rgba(242,234,228,0.35);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
            padding: 1.25rem 1.25rem 0.4rem;
            margin: 0;
        }

        /* Nav Links */
        .nav-links {
            list-style: none;
            padding: 0 0.75rem;
            margin: 0;
        }

        .nav-links li {
            margin-bottom: 2px;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: rgb(242, 234, 228);
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.18s;
        }

        .nav-links a:hover {
            background-color: rgba(255,255,255,0.07);
            color: var(--cream);
        }

        .nav-links a.active {
            background-color: var(--fern);
            color: var(--cream);
            font-weight: 500;
        }

        .nav-icon {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .user-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            background-color: var(--fern);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            color: var(--cream);
            font-weight: 500;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .user-name {
            font-size: 0.875rem;
            color: var(--cream);
            font-weight: 500;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .user-email {
            font-size: 0.7rem;
            color: rgba(242,234,228,0.45);
            font-weight: 300;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 14px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid rgba(217,107,82,0.35);
            color: rgba(217,107,82,0.85);
            font-size: 0.875rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.18s;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: rgba(217,107,82,0.12);
            border-color: var(--terracotta);
            color: var(--terracotta);
        }

        /* ==================== TOPBAR ==================== */
        .topbar {
            margin-left: 240px;
            background-color: #ffffff;
            border-bottom: 1px solid rgba(16,55,64,0.08);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar-title {
            font-family: 'Open Sans', serif;
            font-size: 1.2rem;
            color: var(--forest);
            font-weight: 800;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-date {
            font-size: 0.8rem;
            color: #6b7a6c;
            font-weight: 300;
        }

        /* ==================== MAIN CONTENT AREA ==================== */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            min-height: calc(100vh - 60px);
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar">

        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <div class="brand-icon">🌿</div>
            <div>
                <div class="brand-name">GroCart</div>
                <div class="brand-tagline">Grocery List App</div>
            </div>
        </a>

        <!-- Main Menu -->
        <p class="nav-section-label">Main Menu</p>
        <ul class="nav-links">

            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-grid-1x2"></i></span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('grocery.index') }}" class="{{ request()->routeIs('grocery.*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-cart3"></i></span>
                    Grocery List
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-people"></i></span>
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
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>

        </div>

    </aside>

    <!-- ==================== TOPBAR ==================== -->
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('F j, Y') }}
            </span>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- ==================== TOAST ==================== -->
    @include('components.toast')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>