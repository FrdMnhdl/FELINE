import gsap from 'gsap';

export function initDeleteModal() {
    const modal = document.querySelector('[data-delete-modal]');
    if (!modal || modal.dataset.modalBound === 'true') {
        return;
    }

    modal.dataset.modalBound = 'true';

    const backdrop = modal.querySelector('[data-modal-backdrop]');
    const panel = modal.querySelector('[data-modal-panel]');
    const form = modal.querySelector('[data-modal-form]');
    const catNameEl = modal.querySelector('[data-modal-cat-name]');
    const returnToInput = modal.querySelector('[data-modal-return-to]');
    const cancelButtons = modal.querySelectorAll('[data-modal-close]');
    const confirmBtn = modal.querySelector('[data-modal-confirm]');

    let lastTrigger = null;
    let isOpen = false;

    const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const openModal = (trigger) => {
        if (isOpen) {
            return;
        }

        const url = trigger.getAttribute('data-delete-url');
        const name = trigger.getAttribute('data-cat-name') || 'kucing ini';
        const returnTo = trigger.getAttribute('data-return-to') || 'gallery';

        if (!url || !form) {
            return;
        }

        isOpen = true;
        lastTrigger = trigger;
        form.setAttribute('action', url);

        if (catNameEl) {
            catNameEl.textContent = name;
        }
        if (returnToInput) {
            returnToInput.value = returnTo;
        }

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        if (prefersReducedMotion()) {
            gsap.set([backdrop, panel], { autoAlpha: 1, scale: 1, y: 0 });
        } else {
            gsap.timeline({ defaults: { ease: 'steps(4)' } })
                .fromTo(backdrop, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.18 })
                .fromTo(panel, { autoAlpha: 0, y: 12, scale: 0.96 }, { autoAlpha: 1, y: 0, scale: 1, duration: 0.22 }, '<0.04');
        }

        modal.querySelector('[data-modal-close]')?.focus();
    };

    const closeModal = () => {
        if (!isOpen) {
            return;
        }

        isOpen = false;
        document.body.classList.remove('overflow-hidden');

        const finishClose = () => {
            modal.classList.add('hidden');
            if (confirmBtn) {
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Ya, Hapus';
            }
            lastTrigger?.focus();
            lastTrigger = null;
        };

        if (prefersReducedMotion()) {
            finishClose();
            return;
        }

        gsap.timeline({
            defaults: { ease: 'steps(3)' },
            onComplete: finishClose,
        })
            .to(panel, { autoAlpha: 0, y: 8, scale: 0.97, duration: 0.14 })
            .to(backdrop, { autoAlpha: 0, duration: 0.14 }, '<0.02');
    };

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-delete-trigger]');
        if (trigger) {
            event.preventDefault();
            openModal(trigger);
        }
    });

    cancelButtons.forEach((btn) => {
        btn.addEventListener('click', closeModal);
    });

    backdrop?.addEventListener('click', closeModal);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && isOpen) {
            closeModal();
        }
    });

    form?.addEventListener('submit', () => {
        if (confirmBtn) {
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Lagi menghapus...';
        }
    });
}
