<!-- PWA Install Banner -->
<div id="pwaBanner" class="pwa-install-banner">
    <div class="banner-content">
        <div class="banner-text">
            <div class="banner-icon">📱</div>
            <div class="banner-message">
                <div class="banner-title">Install {{ config('app.name') }}</div>
                <div class="banner-subtitle">Get the full app experience</div>
            </div>
        </div>
        <div class="banner-buttons">
            <button id="installBtn" class="btn btn-install">Install</button>
            <button id="dismissBtn" class="btn btn-close">Not now</button>
        </div>
    </div>
</div>

<!-- PWA Install Modal (fallback for iOS) -->
<div id="pwaModal" class="pwa-modal">
    <div class="modal-content">
        <div class="modal-icon">📱</div>
        <div class="modal-title">Install {{ config('app.name') }}</div>
        <div class="modal-description">
            Add this app to your home screen for quick and easy access when you're on the go.
        </div>
        <div class="modal-buttons">
            <button id="modalInstallBtn" class="btn btn-install">Install</button>
            <button id="modalCloseBtn" class="btn btn-close">Cancel</button>
        </div>
    </div>
</div>

<style>
.pwa-install-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 16px 20px;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
    z-index: 1000;
}

.pwa-install-banner.show {
    transform: translateY(0);
}

.banner-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 600px;
    margin: 0 auto;
}

.banner-text {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
}

.banner-icon {
    font-size: 24px;
    background: rgba(255,255,255,0.2);
    padding: 8px;
    border-radius: 8px;
}

.banner-message {
    flex: 1;
}

.banner-title {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 2px;
}

.banner-subtitle {
    font-size: 14px;
    opacity: 0.9;
}

.banner-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
}

.btn-install {
    background: white;
    color: #2563eb;
}

.btn-install:hover {
    background: #f3f4f6;
    transform: translateY(-1px);
}

.btn-close {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}

.btn-close:hover {
    background: rgba(255,255,255,0.3);
}

.pwa-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

.pwa-modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background: white;
    border-radius: 12px;
    padding: 32px;
    max-width: 400px;
    margin: 20px;
    text-align: center;
    transform: scale(0.9);
    transition: transform 0.3s ease-in-out;
}

.pwa-modal.show .modal-content {
    transform: scale(1);
}

.modal-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.modal-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 8px;
}

.modal-description {
    color: #6b7280;
    margin-bottom: 24px;
    line-height: 1.5;
}

.modal-buttons {
    display: flex;
    gap: 12px;
    justify-content: center;
}

@media (max-width: 640px) {
    .banner-content {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }

    .banner-buttons {
        width: 100%;
        justify-content: center;
    }

    .btn {
        flex: 1;
        max-width: 120px;
    }
}
</style>