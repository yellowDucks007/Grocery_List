@extends('layouts.app')
@include('components.toast')

@section('title', 'Edit Profile – GroCart')
@section('page-title', 'Edit Profile')

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
        font-family: 'Open Sans', sans-serif;
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

    .btn-back {
        background: transparent;
        border: 1.5px solid #d0d8d1;
        color: #6b7a6c;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Open Sans', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: all 0.18s;
    }

    .btn-back:hover {
        border-color: var(--forest);
        color: var(--forest);
    }

    /*  EDIT CARD  */
    .edit-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid rgba(16,55,64,0.07);
        overflow: hidden;
    }

    .edit-card-header {
        padding: 1.25rem 2rem;
        border-bottom: 1px solid rgba(16,55,64,0.07);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .edit-card-header-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(60,89,62,0.12);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .edit-card-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: var(--forest);
        margin: 0;
    }

    .edit-card-body {
        padding: 2rem;
    }

    /*  AVATAR UPLOAD  */
    .avatar-upload-wrap {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(16,55,64,0.07);
    }

    .avatar-preview {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background-color: var(--fern);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--cream);
        font-weight: 600;
        font-family: 'Open Sans', sans-serif;
        overflow: hidden;
        flex-shrink: 0;
        text-transform: uppercase;
        border: 3px solid rgba(16,55,64,0.1);
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-upload-info h6 {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--forest);
        margin-bottom: 4px;
    }

    .avatar-upload-info p {
        font-size: 0.78rem;
        color: #6b7a6c;
        margin-bottom: 0.75rem;
        font-weight: 300;
    }

    .btn-upload {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: rgba(60,89,62,0.1);
        color: var(--fern);
        border: 1.5px solid rgba(60,89,62,0.25);
        padding: 7px 16px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-family: 'Open Sans', sans-serif;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.18s;
    }

    .btn-upload:hover {
        background-color: rgba(60,89,62,0.18);
        border-color: var(--fern);
    }

    /* Hidden real file input */
    #avatarInput {
        display: none;
    }

    /*  FORM  */
    .form-section-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7a6c;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(16,55,64,0.06);
    }

    .form-label-c {
        font-size: 0.78rem;
        font-weight: 500;
        color: var(--forest);
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin-bottom: 0.3rem;
        display: block;
    }

    .form-input-c {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #d0d8d1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'Open Sans', sans-serif;
        color: var(--forest);
        background-color: #fafafa;
        outline: none;
        transition: border-color 0.2s;
    }

    .form-input-c:focus {
        border-color: var(--fern);
        background-color: #ffffff;
    }

    .form-input-c.is-invalid {
        border-color: var(--terracotta);
    }

    .invalid-msg {
        font-size: 0.78rem;
        color: var(--terracotta);
        margin-top: 4px;
        display: block;
    }

    .input-hint {
        font-size: 0.75rem;
        color: #9aaa9b;
        margin-top: 4px;
        display: block;
        font-weight: 300;
    }

    /*  FORM FOOTER  */
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        border-top: 1px solid rgba(16,55,64,0.07);
    }

    .btn-cancel {
        background: transparent;
        border: 1.5px solid #d0d8d1;
        color: #6b7a6c;
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Open Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-cancel:hover {
        border-color: var(--forest);
        color: var(--forest);
    }

    .btn-save {
        background-color: var(--forest);
        color: var(--cream);
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        font-family: 'Open Sans', sans-serif;
        cursor: pointer;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-save:hover {
        background-color: var(--fern);
    }
</style>
@endsection

@section('content')

<!-- ==================== PAGE HEADER ==================== -->
<div class="page-header">
    <div>
        <h1>Edit Profile</h1>
        <p>Update your account information and profile picture</p>
    </div>
    <a href="{{ route('profile.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to Profile
    </a>
</div>

<!-- ==================== EDIT FORM CARD ==================== -->
<div class="edit-card">

    <div class="edit-card-header">
        <div class="edit-card-header-icon">✏️</div>
        <h2 class="edit-card-title">Account Information</h2>
    </div>

    <div class="edit-card-body">

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ==================== AVATAR UPLOAD ==================== -->
            <div class="avatar-upload-wrap">

                <div class="avatar-preview" id="avatarPreview">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" id="avatarImg" alt="Avatar">
                    @else
                        <span id="avatarInitials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    @endif
                </div>

                <div class="avatar-upload-info">
                    <h6>Profile Picture</h6>
                    <p>JPG or PNG. Max size 2MB.</p>
                    <button type="button" class="btn-upload" onclick="document.getElementById('avatarInput').click()">
                        <i class="bi bi-upload"></i> Upload Photo
                    </button>
                    <input type="file" name="avatar" id="avatarInput" accept="image/jpg,image/jpeg,image/png">
                </div>

            </div>

            <!-- ==================== BASIC INFO ==================== -->
            <div class="form-section-title">Basic Information</div>

            <div class="row g-3 mb-3">

                <div class="col-md-6">
                    <label for="name" class="form-label-c">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-input-c {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Juan Dela Cruz"
                        required
                    >
                    @if ($errors->has('name'))
                        <span class="invalid-msg">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label-c">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input-c {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email', $user->email) }}"
                        placeholder="you@example.com"
                        required
                    >
                    @if ($errors->has('email'))
                        <span class="invalid-msg">{{ $errors->first('email') }}</span>
                    @endif
                </div>

            </div>

            <!-- ==================== CHANGE PASSWORD ==================== -->
            <div class="form-section-title" style="margin-top:1.5rem;">Change Password</div>

            <div class="row g-3 mb-3">

                <div class="col-md-6">
                    <label for="password" class="form-label-c">New Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input-c {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Leave blank to keep current"
                    >
                    @if ($errors->has('password'))
                        <span class="invalid-msg">{{ $errors->first('password') }}</span>
                    @endif
                    <span class="input-hint">Minimum 8 characters</span>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label-c">Confirm New Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input-c"
                        placeholder="Repeat new password"
                    >
                </div>

            </div>

            <!-- ==================== FORM FOOTER ==================== -->
            <div class="form-footer">
                <a href="{{ route('profile.index') }}" class="btn-cancel">
                    <i class="bi bi-x"></i> Cancel
                </a>
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
            </div>

        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
    /* ==================== AVATAR PREVIEW ==================== */
    document.getElementById('avatarInput').addEventListener('change', function() {
        var file = this.files[0];

        if (!file) return;

        /* Check file size — max 2MB */
        if (file.size > 2 * 1024 * 1024) {
            showToast('File is too large. Max size is 2MB.', 'error');
            this.value = '';
            return;
        }

        var reader = new FileReader();

        reader.onload = function(e) {
            var preview = document.getElementById('avatarPreview');

            /* Replace initials with image preview */
            preview.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;" alt="Preview">';
        };

        reader.readAsDataURL(file);
    });
</script>
@endsection