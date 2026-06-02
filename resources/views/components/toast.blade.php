<!-- ==================== TOAST NOTIFICATION ==================== -->

<style>
    .toast-container {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 9999;
    }

    .toast-custom {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 300px;
        border: 1px solid #E9ECEF;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .toast-icon-wrap {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
        font-weight: bold;
    }

    .toast-success .toast-icon-wrap {
        background-color: rgba(60, 89, 62, 0.15);
        color: #3C593E;
    }

    .toast-error .toast-icon-wrap {
        background-color: rgba(217, 107, 82, 0.15);
        color: #D96B52;
    }

    .toast-body-text {
        flex: 1;
    }

    .toast-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #103740;
        margin-bottom: 2px;
    }

    .toast-msg {
        font-size: 0.8rem;
        color: #6C757D;
        line-height: 1.4;
    }

    .toast-close {
        border: none;
        background: none;
        color: #9CA3AF;
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
        margin-left: auto;
    }

    .toast-close:hover {
        color: #103740;
    }

    .toast-fade-out {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
</style>

@if (session('success'))
    <div class="toast-container">
        <div class="toast-custom toast-success" id="toastBox">

            <div class="toast-icon-wrap">
                ✓
            </div>

            <div class="toast-body-text">
                <div class="toast-title">
                    Success
                </div>

                <div class="toast-msg">
                    {{ session('success') }}
                </div>
            </div>

            <button
                type="button"
                class="toast-close"
                onclick="closeToast()">
                ×
            </button>

        </div>
    </div>
@endif

@if (session('error'))
    <div class="toast-container">
        <div class="toast-custom toast-error" id="toastBox">

            <div class="toast-icon-wrap">
                !
            </div>

            <div class="toast-body-text">
                <div class="toast-title">
                    Error
                </div>

                <div class="toast-msg">
                    {{ session('error') }}
                </div>
            </div>

            <button
                type="button"
                class="toast-close"
                onclick="closeToast()">
                ×
            </button>

        </div>
    </div>
@endif

<script>
    function closeToast() {
        const toast = document.getElementById('toastBox');

        if (toast) {
            toast.classList.add('toast-fade-out');

            setTimeout(function () {
                toast.remove();
            }, 300);
        }
    }

    window.addEventListener('load', function () {
        const toast = document.getElementById('toastBox');

        if (toast) {
            setTimeout(function () {
                closeToast();
            }, 3000);
        }
    });
</script>