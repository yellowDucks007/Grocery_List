<!-- ==================== TOAST CONTAINER ==================== -->
<div id="toastContainer" style="
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 280px;
    max-width: 360px;
"></div>

<style>
    .toast-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 10px;
        font-size: 0.875rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        color: #F2EAE4;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.35s ease, transform 0.35s ease;
        line-height: 1.4;
    }

    .toast-item.show {
        opacity: 1;
        transform: translateY(0);
    }

    .toast-item.hide {
        opacity: 0;
        transform: translateY(16px);
    }

    .toast-success { background-color: #3C593E; }
    .toast-error   { background-color: #D96B52; }
    .toast-info    { background-color: #103740; }
    .toast-warning { background-color: #D9A443; color: #103740; }

    .toast-icon {
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .toast-message {
        flex: 1;
    }

    .toast-close {
        background: none;
        border: none;
        color: inherit;
        opacity: 0.6;
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
        line-height: 1;
        flex-shrink: 0;
        transition: opacity 0.2s;
    }

    .toast-close:hover {
        opacity: 1;
    }
</style>

<script>
    /* ==================== SHOW TOAST FUNCTION ==================== */
    function showToast(message, type) {
        var container = document.getElementById('toastContainer');

        var icons = {
            success: '✅',
            error:   '⚠️',
            info:    'ℹ️',
            warning: '⚡'
        };

        /* Build toast element */
        var toast = document.createElement('div');
        toast.className = 'toast-item toast-' + type;

        toast.innerHTML =
            '<span class="toast-icon">' + (icons[type] || 'ℹ️') + '</span>' +
            '<span class="toast-message">' + message + '</span>' +
            '<button class="toast-close" onclick="dismissToast(this.parentElement)">✕</button>';

        container.appendChild(toast);

        /* Trigger entrance animation */
        setTimeout(function() {
            toast.classList.add('show');
        }, 10);

        /* Auto dismiss after 3.5 seconds */
        setTimeout(function() {
            dismissToast(toast);
        }, 3500);
    }

    /* ==================== DISMISS TOAST FUNCTION ==================== */
    function dismissToast(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(function() {
            if (toast.parentElement) {
                toast.parentElement.removeChild(toast);
            }
        }, 400);
    }

    /* ==================== AUTO-FIRE FROM LARAVEL SESSION ==================== */
    <?php if (session('success')): ?>
        showToast("{{ session('success') }}", 'success');
    <?php endif; ?>

    <?php if (session('error')): ?>
        showToast("{{ session('error') }}", 'error');
    <?php endif; ?>

    <?php if (session('info')): ?>
        showToast("{{ session('info') }}", 'info');
    <?php endif; ?>

    <?php if (session('warning')): ?>
        showToast("{{ session('warning') }}", 'warning');
    <?php endif; ?>
</script>