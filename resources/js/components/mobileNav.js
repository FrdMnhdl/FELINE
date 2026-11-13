export function initMobileNav() {
    const toggle = document.querySelector('[data-mobile-nav-toggle]');
    const drawer = document.querySelector('[data-mobile-nav-drawer]');

    if (!toggle || !drawer || toggle.dataset.navBound === 'true') {
        return;
    }

    toggle.dataset.navBound = 'true';

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        drawer.classList.toggle('hidden', isOpen);
    });
}

export function initFlashDismiss() {
    const banner = document.querySelector('[data-flash-banner]');
    const dismiss = banner?.querySelector('[data-flash-dismiss]');

    if (!banner || !dismiss || dismiss.dataset.flashBound === 'true') {
        return;
    }

    dismiss.dataset.flashBound = 'true';

    dismiss.addEventListener('click', () => {
        banner.remove();
    });
}

