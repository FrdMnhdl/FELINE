export function initLoginForm() {
    const form = document.querySelector('[data-login-form]');
    if (!form || form.dataset.loginBound === 'true') {
        return;
    }

    form.dataset.loginBound = 'true';

    const passwordInput = form.querySelector('[data-password-input]');
    const toggleBtn = form.querySelector('[data-password-toggle]');
    const showIcon = form.querySelector('[data-eye-show]');
    const hideIcon = form.querySelector('[data-eye-hide]');
    const submitBtn = form.querySelector('[data-submit-btn]');
    const submitLabel = form.querySelector('[data-submit-label]');
    const submitSpinner = form.querySelector('[data-submit-spinner]');

    if (passwordInput && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            toggleBtn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            toggleBtn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');

            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', isHidden);
                hideIcon.classList.toggle('hidden', !isHidden);
            }
        });
    }

    form.addEventListener('submit', () => {
        if (!submitBtn) {
            return;
        }

        submitBtn.disabled = true;
        if (submitLabel) {
            submitLabel.textContent = 'Lagi masuk...';
        }
        if (submitSpinner) {
            submitSpinner.classList.remove('hidden');
        }
    });
}
