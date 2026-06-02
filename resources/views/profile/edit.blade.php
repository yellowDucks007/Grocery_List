@extends('layouts.app')

@section('title', 'My Profile – GroCart')
@section('page-title', 'My Profile')

@section('styles')
<style>
    :root {
        --forest:     #103740;
        --fern:       #3C593E;
        --gold:       #D9A443;
        --cream:      #F2EAE4;
        --terracotta: #D96B52;
        --accent-teal: #3D8F8F;
        --white: #FFFFFF;
    }
    
    .profile-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.5rem;
    }

    .profile-card,
    .form-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid rgba(16,55,64,0.07);
        padding: 1.5rem;
    }

    .profile-card {
        text-align: center;
    }

    .profile-avatar {
        width: 90px;
        height: 90px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        background: #103740;
        color: #fff;
        font-size: 1.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
    }

    .profile-name {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--forest);
        margin-bottom: 0.2rem;
    }

    .profile-email {
        font-size: 0.85rem;
        color: #7d8f8f;
        margin-bottom: 1rem;
    }

    .profile-meta {
        border-top: 1px solid rgba(16,55,64,0.08);
        margin-top: 1rem;
        padding-top: 1rem;
        text-align: left;
    }

    .meta-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        font-size: 0.85rem;
    }

    .meta-label {
        color: #7d8f8f;
    }

    .meta-value {
        font-weight: 500;
        color: var(--forest);
    }

    .badge-role,
    .badge-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-role {
        background: rgba(232,184,107,0.15);
        color: #a07820;
    }

    .badge-status {
        background: rgba(61,143,143,0.12);
        color: #1B4A4A;
    }

    .form-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--forest);
        margin-bottom: 1rem;
    }

    .form-label-c {
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 0.35rem;
        display: block;
        color: var(--forest);
    }

    .form-input-c {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid #d0d8d1;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        outline: none;
        transition: 0.2s;
    }

    .form-input-c:focus {
        border-color: var(--accent-teal);
    }

    .btn-save {
        background: var(--forest);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: var(--gold);
    }

    .divider {
        height: 1px;
        background: rgba(16,55,64,0.08);
        margin: 2rem 0;
    }

    @media (max-width: 992px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

<div class="profile-grid">

    <!-- LEFT CARD -->
    <div class="profile-card">

        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>

        <div class="profile-name">
            {{ Auth::user()->name }}
        </div>

        <div class="profile-email">
            {{ Auth::user()->email }}
        </div>

        <div>
            <span class="badge-role">
                {{ ucfirst(Auth::user()->role ?? 'User') }}
            </span>

            <span class="badge-status">
                {{ ucfirst(Auth::user()->status ?? 'Active') }}
            </span>
        </div>

        <div class="profile-meta">

            <div class="meta-row">
                <span class="meta-label">User ID</span>
                <span class="meta-value">#{{ Auth::id() }}</span>
            </div>

            <div class="meta-row">
                <span class="meta-label">Joined</span>
                <span class="meta-value">
                    {{ Auth::user()->created_at->format('M d, Y') }}
                </span>
            </div>

            <div class="meta-row">
                <span class="meta-label">Last Updated</span>
                <span class="meta-value">
                    {{ Auth::user()->updated_at->format('M d, Y') }}
                </span>
            </div>

        </div>

    </div>

    <!-- RIGHT CARD -->
    <div class="form-card">

        <div class="form-title">
            Profile Information
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <label class="form-label-c">
                Full Name
            </label>

            <input
                type="text"
                name="name"
                class="form-input-c"
                value="{{ Auth::user()->name }}"
                required
            >

            <label class="form-label-c">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                class="form-input-c"
                value="{{ Auth::user()->email }}"
                required
            >

            <button type="submit" class="btn-save">
                Update Profile
            </button>
        </form>

        <div class="divider"></div>

        <div class="form-title">
            Change Password
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <label class="form-label-c">
                Current Password
            </label>

            <input
                type="password"
                name="current_password"
                class="form-input-c"
                required
            >

            <label class="form-label-c">
                New Password
            </label>

            <input
                type="password"
                name="password"
                class="form-input-c"
                required
            >

            <label class="form-label-c">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-input-c"
                required
            >

            <button type="submit" class="btn-save">
                Change Password
            </button>

        </form>

    </div>

</div>

@endsection