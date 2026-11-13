import gsap from 'gsap';

const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
const MAX_BYTES = 2 * 1024 * 1024;

export function initImageUpload() {
    const root = document.querySelector('[data-upload-root]');
    if (!root || root.dataset.uploadBound === 'true') {
        return;
    }

    root.dataset.uploadBound = 'true';

    const input = root.querySelector('[data-upload-input]');
    const dropzone = root.querySelector('[data-upload-dropzone]');
    const previewImg = root.querySelector('[data-upload-preview]');
    const placeholder = root.querySelector('[data-upload-placeholder]');
    const metaLabel = root.querySelector('[data-upload-meta]');
    const clientError = root.querySelector('[data-upload-client-error]');
    const form = root.closest('form');
    const submitBtn = form?.querySelector('[data-cat-submit]');

    let activeObjectUrl = null;

    const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const showClientError = (message) => {
        if (!clientError) {
            return;
        }
        clientError.textContent = message;
        clientError.classList.remove('hidden');
    };

    const clearClientError = () => {
        if (!clientError) {
            return;
        }
        clientError.textContent = '';
        clientError.classList.add('hidden');
    };

    const renderPreview = (file) => {
        clearClientError();

        if (!ALLOWED_TYPES.includes(file.type)) {
            showClientError('Pilih foto format JPEG, PNG, atau WebP ya.');
            input.value = '';
            return;
        }

        if (file.size > MAX_BYTES) {
            showClientError('Ukuran fotonya kegedean nih, maksimal 2 MB ya.');
            input.value = '';
            return;
        }

        if (activeObjectUrl) {
            URL.revokeObjectURL(activeObjectUrl);
        }

        activeObjectUrl = URL.createObjectURL(file);

        if (previewImg) {
            previewImg.src = activeObjectUrl;
            previewImg.classList.remove('hidden');

            if (!prefersReducedMotion()) {
                gsap.fromTo(
                    previewImg,
                    { autoAlpha: 0, scale: 0.98 },
                    { autoAlpha: 1, scale: 1, duration: 0.28, ease: 'steps(5)', clearProps: 'transform' }
                );
            }
        }

        if (placeholder) {
            placeholder.classList.add('hidden');
        }

        if (metaLabel) {
            const kb = Math.max(1, Math.round(file.size / 1024));
            metaLabel.textContent = `File dipilih: ${file.name} (${kb} KB)`;
        }
    };

    input?.addEventListener('change', (event) => {
        const file = event.target.files?.[0];
        if (file) {
            renderPreview(file);
        }
    });

    if (dropzone && input) {
        const setHighlight = (active) => {
            dropzone.classList.toggle('border-[#5CE1E6]', active);
            dropzone.classList.toggle('bg-[#183146]/60', active);
        };

        dropzone.addEventListener('dragover', (event) => {
            event.preventDefault();
            setHighlight(true);
        });

        dropzone.addEventListener('dragleave', () => {
            setHighlight(false);
        });

        dropzone.addEventListener('drop', (event) => {
            event.preventDefault();
            setHighlight(false);

            const file = event.dataTransfer?.files?.[0];
            if (!file) {
                return;
            }

            const transfer = new DataTransfer();
            transfer.items.add(file);
            input.files = transfer.files;
            renderPreview(file);
        });
    }

    if (form && submitBtn) {
        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            const label = submitBtn.querySelector('[data-cat-submit-label]');
            if (label) {
                label.textContent = 'Lagi nyimpan...';
            }
        });
    }

    window.addEventListener(
        'pagehide',
        () => {
            if (activeObjectUrl) {
                URL.revokeObjectURL(activeObjectUrl);
                activeObjectUrl = null;
            }
        },
        { once: true }
    );
}
