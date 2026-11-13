let vantaInstance = null;
let reducedMotionQuery = null;
let motionListener = null;

function supportsWebGL() {
    try {
        const canvas = document.createElement('canvas');

        return Boolean(
            window.WebGLRenderingContext
            && (canvas.getContext('webgl2') || canvas.getContext('webgl') || canvas.getContext('experimental-webgl'))
        );
    } catch {
        return false;
    }
}

export function destroyLoginVanta() {
    if (vantaInstance && typeof vantaInstance.destroy === 'function') {
        vantaInstance.destroy();
    }
    vantaInstance = null;

    const container = document.querySelector('[data-vanta-login]');
    if (container) {
        container.classList.add('opacity-0');
        container.classList.remove('opacity-100');
    }
}

async function mountLoginVanta(container) {
    if (vantaInstance || !supportsWebGL()) {
        return;
    }

    try {
        const [THREE, dotsModule] = await Promise.all([
            import('three'),
            import('vanta/dist/vanta.dots.min'),
        ]);

        const DOTS = dotsModule.default ?? window.VANTA?.DOTS;
        if (typeof DOTS !== 'function' || !document.body.contains(container)) {
            return;
        }

        window.THREE = THREE;

        vantaInstance = DOTS({
            el: container,
            THREE,
            mouseControls: true,
            touchControls: false,
            gyroControls: false,
            minHeight: 200,
            minWidth: 200,
            scale: 3,
            scaleMobile: 3,
            pixelated: true,
            backgroundColor: 0x151824,
            backgroundAlpha: 0,
            color: 0x3cd070,
            color2: 0x5ce1e6,
            size: 4.5,
            spacing: 40,
            showLines: false,
        });

        requestAnimationFrame(() => {
            container.classList.remove('opacity-0');
            container.classList.add('opacity-100');
        });
    } catch {
        destroyLoginVanta();
    }
}

export function initLoginVanta() {
    const container = document.querySelector('[data-vanta-login]');
    if (!container || container.dataset.vantaBound === 'true') {
        return () => {};
    }

    container.dataset.vantaBound = 'true';
    reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

    if (!reducedMotionQuery.matches) {
        mountLoginVanta(container);
    }

    motionListener = (event) => {
        if (event.matches) {
            destroyLoginVanta();
        } else {
            mountLoginVanta(container);
        }
    };

    reducedMotionQuery.addEventListener('change', motionListener);

    return () => {
        if (reducedMotionQuery && motionListener) {
            reducedMotionQuery.removeEventListener('change', motionListener);
        }
        destroyLoginVanta();
        delete container.dataset.vantaBound;
    };
}
