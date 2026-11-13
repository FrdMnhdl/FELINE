import gsap from 'gsap';

gsap.defaults({
    duration: 0.36,
    ease: 'steps(6)',
});

export function initPageAnimations() {
    const root = document.body;
    if (!root || root.dataset.motionInit === 'true') {
        return () => {};
    }

    root.dataset.motionInit = 'true';
    const mm = gsap.matchMedia();

    mm.add(
        {
            isDesktop: '(min-width: 768px)',
            isMobile: '(max-width: 767px)',
            reduceMotion: '(prefers-reduced-motion: reduce)',
        },
        (context) => {
            const { isMobile, reduceMotion } = context.conditions;

            const heroEls = gsap.utils.toArray('[data-animate="hero"]');
            const fadeEls = gsap.utils.toArray('[data-animate="fade"]');
            const cardEls = gsap.utils.toArray('[data-animate="gallery-card"]');
            const detailImage = document.querySelector('[data-animate="detail-image"]');
            const detailItems = gsap.utils.toArray('[data-animate="detail-item"]');
            const validationAlert = document.querySelector('[data-validation-alert]');
            const flashBanner = document.querySelector('[data-flash-banner]');

            if (reduceMotion) {
                const allAnimated = [
                    ...heroEls,
                    ...fadeEls,
                    ...cardEls,
                    ...(detailImage ? [detailImage] : []),
                    ...detailItems,
                ];
                if (allAnimated.length) {
                    gsap.set(allAnimated, { clearProps: 'transform,opacity,visibility' });
                }
                return;
            }

            const introTl = gsap.timeline({
                defaults: { ease: 'steps(6)' },
            });

            if (heroEls.length) {
                introTl.fromTo(
                    heroEls,
                    { autoAlpha: 0, y: isMobile ? 6 : 12 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.28,
                        stagger: 0.04,
                        clearProps: 'transform,opacity,visibility',
                    },
                    0
                );
            }

            if (fadeEls.length) {
                introTl.fromTo(
                    fadeEls,
                    { autoAlpha: 0, y: isMobile ? 6 : 10 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.28,
                        stagger: 0.04,
                        clearProps: 'transform,opacity,visibility',
                    },
                    heroEls.length ? 0.06 : 0
                );
            }

            if (cardEls.length) {
                introTl.fromTo(
                    cardEls,
                    { autoAlpha: 0, y: isMobile ? 8 : 14 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.3,
                        stagger: { each: isMobile ? 0.03 : 0.05, from: 'start' },
                        clearProps: 'transform,opacity,visibility',
                    },
                    heroEls.length || fadeEls.length ? 0.08 : 0
                );
            }

            if (detailImage) {
                introTl.fromTo(
                    detailImage,
                    { autoAlpha: 0, y: 10 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.32,
                        clearProps: 'transform,opacity,visibility',
                    },
                    0
                );
            }

            if (detailItems.length) {
                introTl.fromTo(
                    detailItems,
                    { autoAlpha: 0, y: 8 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.28,
                        stagger: 0.04,
                        clearProps: 'transform,opacity,visibility',
                    },
                    0.06
                );
            }

            if (flashBanner) {
                gsap.fromTo(
                    flashBanner,
                    { autoAlpha: 0, y: -8 },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.24,
                        ease: 'steps(4)',
                        clearProps: 'transform,opacity,visibility',
                    }
                );
            }

            if (validationAlert) {
                gsap.fromTo(
                    validationAlert,
                    { x: -6 },
                    {
                        x: 0,
                        duration: 0.28,
                        ease: 'steps(2)',
                        keyframes: [
                            { x: -6, duration: 0.06 },
                            { x: 6, duration: 0.06 },
                            { x: -4, duration: 0.06 },
                            { x: 0, duration: 0.08 },
                        ],
                        clearProps: 'transform',
                    }
                );
            }

            const interactiveButtons = gsap.utils.toArray('[data-press-feedback]');
            const cleanups = [];

            interactiveButtons.forEach((button) => {
                const onDown = () => {
                    gsap.to(button, { scale: 0.97, duration: 0.08, ease: 'steps(2)', overwrite: 'auto' });
                };
                const onUp = () => {
                    gsap.to(button, { scale: 1, duration: 0.12, ease: 'steps(3)', overwrite: 'auto', clearProps: 'transform' });
                };

                button.addEventListener('pointerdown', onDown);
                button.addEventListener('pointerup', onUp);
                button.addEventListener('pointerleave', onUp);
                button.addEventListener('pointercancel', onUp);

                cleanups.push(() => {
                    button.removeEventListener('pointerdown', onDown);
                    button.removeEventListener('pointerup', onUp);
                    button.removeEventListener('pointerleave', onUp);
                    button.removeEventListener('pointercancel', onUp);
                });
            });

            return () => {
                cleanups.forEach((fn) => fn());
            };
        }
    );

    return () => {
        mm.revert();
        delete root.dataset.motionInit;
    };
}
