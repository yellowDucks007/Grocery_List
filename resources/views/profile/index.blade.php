@extends('layouts.app')
@include('components.toast')

@section('title', 'My Profile – GroCart')
@section('page-title', 'My Profile')

@section('styles')
<style>
    /*  PAGE HEADER  */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
    }

    .page-header h1 {
        font-family: 'Open Sans Display', serif;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--forest);
        margin: 0;
    }

    .page-header p {
        font-size: 0.82rem;
        color: #6b7a6c;
        margin: 0;
    }

    .btn-edit-profile {
        background-color: var(--forest);
        color: var(--cream);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Open Sans', sans-serif;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .btn-edit-profile:hover {
        background-color: var(--fern);
        color: var(--cream);
    }

    /*  PROFILE CARD  */
    .profile-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid rgba(16,55,64,0.07);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .profile-banner {
        height: 120px;
        background: linear-gradient(135deg, #103740 0%, #3C593E 100%);
        position: relative;
        overflow: hidden;
    }

    .banner-leaf {
        position: absolute;
        right: 2rem;
        top: 1rem;
        font-size: 5rem;
        opacity: 0.1;
        line-height: 1;
    }

    .profile-body {
        padding: 0 2rem 2rem;
    }

    /* Avatar */
    .avatar-wrap {
        margin-top: -48px;
        margin-bottom: 1rem;
        display: inline-block;
        position: relative;
    }

    .avatar-circle {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background-color: var(--fern);
        border: 4px solid #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--cream);
        font-weight: 600;
        font-family: 'Open Sans', sans-serif;
        overflow: hidden;
        text-transform: uppercase;
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-family: 'Open Sans Display', serif;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--forest);
        margin-bottom: 3px;
    }

    .profile-email {
        font-size: 0.875rem;
        color: #6b7a6c;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /*  STATS ROW  */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .stat-box {
        background-color: rgba(16,55,64,0.04);
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
    }

    .stat-num {
        font-family: 'Open Sans Display', serif;
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--forest);
        line-height: 1;
    }

    .stat-lbl {
        font-size: 0.72rem;
        color: #6b7a6c;
        margin-top: 4px;
    }

    .divider-line {
        border: none;
        border-top: 1px solid rgba(16,55,64,0.07);
        margin: 1.5rem 0;
    }

    /*  INFO GRID  */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-item {
        background-color: rgba(16,55,64,0.04);
        border-radius: 10px;
        padding: 0.875rem 1rem;
    }

    .info-label {
        font-size: 0.72rem;
        color: #6b7a6c;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 0.9rem;
        color: var(--forest);
        font-weight: 400;
    }

    .status-active {
        color: var(--fern);
        font-weight: 500;
    }
</style>
@endsection

@section('content')

<!-- ==================== PAGE HEADER ==================== -->
<div class="page-header">
    <div>
        <h1>My Profile</h1>
        <p>View and manage your account information</p>
    </div>
    <a href="{{ route('profile.edit') }}" class="btn-edit-profile">
        <i class="bi bi-pencil-square"></i> Edit Profile
    </a>
</div>

<!-- ==================== PROFILE CARD ==================== -->
<div class="profile-card">

    <!-- Banner -->
    <div class="profile-banner">
        <span class="banner-leaf">🌿</span>
    </div>

    <div class="profile-body">

        <!-- Avatar -->
        <div class="avatar-wrap">
            <div class="avatar-circle">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Picture">
                @else
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                @endif
            </div>
        </div>

        <!-- Name & Email -->
        <div class="profile-name">{{ $user->name }}</div>
        <p class="profile-email">
            <i class="bi bi-envelope" style="font-size:0.8rem;"></i>
            {{ $user->email }}
        </p>

        <!-- ==================== STATS ==================== -->
        <div class="stats-row">

            <div class="stat-box">
                <div class="stat-num">{{ $totalItems }}</div>
                <div class="stat-lbl">Total Items</div>
            </div>

            <div class="stat-box">
                <div class="stat-num">{{ $completedItems }}</div>
                <div class="stat-lbl">Completed</div>
            </div>

            <div class="stat-box">
                <div class="stat-num">{{ $pendingItems }}</div>
                <div class="stat-lbl">Pending</div>
            </div>

        </div>

        <hr class="divider-line">

        <!-- ==================== INFO GRID ==================== -->
        <div class="info-grid">

            <div class="info-item">
                <div class="info-label">Full Name</div>
                <div class="info-value">{{ $user->name }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Email Address</div>
                <div class="info-value">{{ $user->email }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Member Since</div>
                <div class="info-value">{{ $user->created_at->format('F j, Y') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Account Status</div>
                <div class="info-value status-active">✅ Active</div>
            </div>

        </div>

    </div>
</div>

@endsection