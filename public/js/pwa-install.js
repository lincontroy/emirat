class PWAInstaller {
    constructor() {
        this.deferredPrompt = null;
        this.banner = document.getElementById('pwaBanner');
        this.modal = document.getElementById('pwaModal');
        this.installBtn = document.getElementById('installBtn');
        this.dismissBtn = document.getElementById('dismissBtn');
        this.modalInstallBtn = document.getElementById('modalInstallBtn');
        this.modalCloseBtn = document.getElementById('modalCloseBtn');
        
        this.init();
    }

    init() {
        // Listen for the beforeinstallprompt event
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            this.deferredPrompt = e;
            this.showInstallPrompt();
        });

        // Listen for the appinstalled event
        window.addEventListener('appinstalled', () => {
            this.hideInstallPrompt();
            this.deferredPrompt = null;
            console.log('PWA was installed');
        });

        // Check if app is already installed
        if (window.matchMedia('(display-mode: standalone)').matches) {
            console.log('App is already installed');
            return;
        }

        // iOS Safari detection and handling
        if (this.isIOS() && !this.isInStandaloneMode()) {
            setTimeout(() => this.showIOSInstallPrompt(), 3000);
        }

        this.bindEvents();
    }

    bindEvents() {
        if (this.installBtn) {
            this.installBtn.addEventListener('click', () => this.handleInstall());
        }

        if (this.dismissBtn) {
            this.dismissBtn.addEventListener('click', () => this.hideInstallPrompt());
        }

        if (this.modalInstallBtn) {
            this.modalInstallBtn.addEventListener('click', () => this.handleInstall());
        }

        if (this.modalCloseBtn) {
            this.modalCloseBtn.addEventListener('click', () => this.hideModal());
        }
    }

    showInstallPrompt() {
        if (this.banner) {
            this.banner.classList.add('show');
        }
    }

    hideInstallPrompt() {
        if (this.banner) {
            this.banner.classList.remove('show');
        }
    }

    showModal() {
        if (this.modal) {
            this.modal.classList.add('show');
        }
    }

    hideModal() {
        if (this.modal) {
            this.modal.classList.remove('show');
        }
    }

    showIOSInstallPrompt() {
        this.showModal();
    }

    async handleInstall() {
        if (!this.deferredPrompt) {
            if (this.isIOS()) {
                alert('To install this app on iOS:\n1. Tap the Share button\n2. Scroll down and tap "Add to Home Screen"');
            }
            return;
        }

        const result = await this.deferredPrompt.prompt();
        console.log('Install prompt result:', result);
        
        this.hideInstallPrompt();
        this.deferredPrompt = null;
    }

    isIOS() {
        return /iPad|iPhone|iPod/.test(navigator.userAgent);
    }

    isInStandaloneMode() {
        return window.navigator.standalone === true;
    }
}

// Initialize PWA installer when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new PWAInstaller();
});