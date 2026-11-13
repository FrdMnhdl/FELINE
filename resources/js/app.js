import { initPageAnimations } from './motion/pageAnimations';
import { initLoginVanta } from './motion/vantaLogin';
import { initLoginForm } from './components/loginForm';
import { initImageUpload } from './components/imageUpload';
import { initDeleteModal } from './components/deleteModal';
import { initFlashDismiss, initMobileNav } from './components/mobileNav';

let cleanupAnimations = null;
let cleanupVanta = null;

function bootstrapFeline() {
    cleanupAnimations = initPageAnimations();
    cleanupVanta = initLoginVanta();
    initLoginForm();
    initImageUpload();
    initDeleteModal();
    initMobileNav();
    initFlashDismiss();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrapFeline, { once: true });
} else {
    bootstrapFeline();
}

window.addEventListener('pagehide', () => {
    cleanupAnimations?.();
    cleanupVanta?.();
});
