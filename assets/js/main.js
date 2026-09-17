document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initNavDropdowns();
    initMobileMenu();
    initScrollReveal();
    initParallax();
    initMagneticButtons();
    initScanLines();
    initHeroSlider();
    initPageTransitions();
    initFormInteractions();
    initStatCounters();
    initFaq();
});

function initHeader() {
    const header = document.getElementById('siteHeader');
    if (!header) return;

    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    }, { passive: true });
}

function initNavDropdowns() {
    const items = document.querySelectorAll('.nav-item.has-dropdown');
    if (!items.length) return;

    items.forEach(item => {
        const link = item.querySelector(':scope > a');
        if (!link) return;

        if (link.dataset.hasOwnProperty('noToggle')) return;

        link.addEventListener('click', (e) => {
            const alreadyOpen = item.classList.contains('open');
            closeAllDropdowns();
            if (!alreadyOpen) {
                e.preventDefault();
                item.classList.add('open');
            }
        });

        item.addEventListener('mouseenter', () => closeAllDropdowns(item));
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.nav-item.has-dropdown')) {
            closeAllDropdowns();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAllDropdowns();
    });

    function closeAllDropdowns(except) {
        items.forEach(it => {
            if (it !== except) it.classList.remove('open');
        });
    }
}

function initMobileMenu() {
    const toggle = document.getElementById('mobileToggle');
    const menu = document.getElementById('mobileMenu');
    if (!toggle || !menu) return;

    const links = Array.from(menu.querySelectorAll('a'));
    let lastFocused = null;

    function openMenu() {
        menu.hidden = false;
        toggle.classList.add('active');
        menu.classList.add('active');
        document.body.classList.add('no-scroll');
        toggle.setAttribute('aria-expanded', 'true');
        lastFocused = document.activeElement;
        if (links.length) links[0].focus();
    }

    function closeMenu(returnFocus) {
        menu.classList.remove('active');
        toggle.classList.remove('active');
        document.body.classList.remove('no-scroll');
        toggle.setAttribute('aria-expanded', 'false');
        menu.hidden = true;
        if (returnFocus !== false && lastFocused && document.contains(lastFocused)) {
            lastFocused.focus();
        }
    }

    toggle.addEventListener('click', () => {
        if (menu.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    links.forEach(link => {
        link.addEventListener('click', () => closeMenu());
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menu.classList.contains('active')) {
            closeMenu();
            return;
        }
        if (e.key === 'Tab' && menu.classList.contains('active')) {
            const focusables = [toggle, ...links];
            const first = focusables[0];
            const last = focusables[focusables.length - 1];
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
}

function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger-children');

    if (!reveals.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -60px 0px'
    });

    reveals.forEach(el => observer.observe(el));
}

function initParallax() {
    const parallaxElements = document.querySelectorAll('.parallax-img');
    if (!parallaxElements.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset;

        parallaxElements.forEach(el => {
            const speed = parseFloat(el.dataset.speed) || 0.3;
            const rect = el.getBoundingClientRect();
            const visible = rect.top < window.innerHeight && rect.bottom > 0;

            if (visible) {
                const offset = (rect.top + scrollY - window.innerHeight / 2) * speed;
                el.style.transform = `translateY(${-offset}px)`;
            }
        });
    }, { passive: true });
}

function initMagneticButtons() {
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;

    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const maxMove = 8;

            const moveX = Math.max(-maxMove, Math.min(maxMove, x * 0.3));
            const moveY = Math.max(-maxMove, Math.min(maxMove, y * 0.3));

            btn.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });
}

function initScanLines() {
    const scanContainers = document.querySelectorAll('.has-scan');
    if (!scanContainers.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const scan = entry.target.querySelector('.scan-line');
                if (scan) {
                    scan.classList.add('active');
                    setTimeout(() => scan.classList.remove('active'), 2000);
                }
            }
        });
    }, { threshold: 0.3 });

    scanContainers.forEach(el => observer.observe(el));
}

function initHeroSlider() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.hero-slide');
    if (slides.length < 2) return;

    const scan = document.getElementById('heroSliderScan');
    let current = 0;
    const INTERVAL = 2590;

    function goTo(next) {
        slides[current].classList.remove('active');
        slides[next].classList.add('active');

        if (scan) {
            scan.classList.remove('active');
            void scan.offsetWidth;
            scan.classList.add('active');
        }

        current = next;
    }

    setInterval(() => goTo((current + 1) % slides.length), INTERVAL);
}

function initPageTransitions() {
    const overlay = document.getElementById('pageTransition');
    if (!overlay) return;

    document.querySelectorAll('a[href]').forEach(link => {
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('http') || href.startsWith('mailto')) return;
        if (link.target === '_blank') return;

        link.addEventListener('click', (e) => {
            e.preventDefault();
            overlay.classList.add('active');

            gsap.to(overlay, {
                y: 0,
                duration: 0.5,
                ease: 'power3.inOut',
                onComplete: () => {
                    window.location.href = href;
                }
            });
        });
    });

    window.addEventListener('pageshow', () => {
        gsap.fromTo(overlay,
            { y: 0 },
            { y: '-100%', duration: 0.5, ease: 'power3.inOut', delay: 0.1 }
        );
    });
}

function initFormInteractions() {
    document.querySelectorAll('.form-group').forEach(group => {
        const input = group.querySelector('.form-control');
        if (!input) return;

        input.addEventListener('focus', () => group.classList.add('focused'));
        input.addEventListener('blur', () => {
            if (!input.value) group.classList.remove('focused');
        });
    });
}

function initStatCounters() {
    const numbers = document.querySelectorAll('.stat-number[data-count]');
    if (!numbers.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    function animate(el) {
        const target = parseFloat(el.dataset.count) || 0;
        const decimals = (String(el.dataset.count).split('.')[1] || '').length;
        const duration = 1600;
        const start = performance.now();

        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = (target * eased).toFixed(decimals);
            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                el.textContent = target.toFixed(decimals);
            }
        }
        requestAnimationFrame(tick);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animate(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    numbers.forEach(el => observer.observe(el));
}

function initFaq() {
    const items = document.querySelectorAll('.faq-item');
    if (!items.length) return;

    function closeItem(item) {
        item.classList.remove('open');
        const btn = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        if (btn) btn.setAttribute('aria-expanded', 'false');
        if (answer) answer.style.maxHeight = null;
    }

    items.forEach(item => {
        const btn = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        if (!btn || !answer) return;

        btn.addEventListener('click', () => {
            const isOpen = item.classList.contains('open');
            items.forEach(closeItem);
            if (!isOpen) {
                item.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
}

/* GSAP Hero animations */
function initHeroAnimation() {
    const hero = document.querySelector('.hero');
    if (!hero) return;

    gsap.registerPlugin(ScrollTrigger);

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' }});

    tl.from('.hero-label', { opacity: 0, x: -30, duration: 0.8, delay: 0.3 })
      .from('.hero-title .line-inner', { y: 110, duration: 1, stagger: 0.12 }, '-=0.4')
      .from('.hero-desc', { opacity: 0, y: 20, duration: 0.8 }, '-=0.6')
      .from('.hero-actions .btn', { opacity: 0, y: 20, duration: 0.6, stagger: 0.1 }, '-=0.4')
      .from('.hero-image-wrapper', { opacity: 0, scale: 0.95, duration: 1 }, '-=0.8');

    /* Parallax on scroll */
    gsap.to('.hero-image-wrapper', {
        y: 80,
        scrollTrigger: {
            trigger: '.hero',
            start: 'top top',
            end: 'bottom top',
            scrub: 1
        }
    });

    gsap.to('.hero-grid-overlay', {
        y: 40,
        scrollTrigger: {
            trigger: '.hero',
            start: 'top top',
            end: 'bottom top',
            scrub: 1.5
        }
    });
}

/* Animate sections on scroll */
function initSectionAnimations() {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray('.section-title').forEach(title => {
        gsap.from(title, {
            opacity: 0,
            y: 40,
            duration: 0.8,
            scrollTrigger: {
                trigger: title,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    gsap.utils.toArray('.section-label').forEach(label => {
        gsap.from(label, {
            opacity: 0,
            x: -20,
            duration: 0.6,
            scrollTrigger: {
                trigger: label,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    gsap.utils.toArray('.split-section').forEach(section => {
        const image = section.querySelector('.split-image');
        const content = section.querySelector('.split-content');

        if (image) {
            gsap.from(image, {
                opacity: 0,
                x: -50,
                duration: 0.8,
                scrollTrigger: {
                    trigger: section,
                    start: 'top 75%',
                    toggleActions: 'play none none none'
                }
            });
        }

        if (content) {
            gsap.from(content, {
                opacity: 0,
                x: 50,
                duration: 0.8,
                delay: 0.2,
                scrollTrigger: {
                    trigger: section,
                    start: 'top 75%',
                    toggleActions: 'play none none none'
                }
            });
        }
    });

    gsap.utils.toArray('.tech-card, .product-card, .industry-card, .service-item, .value-card, .ue-card, .ue-item').forEach((card, i) => {
        gsap.from(card, {
            opacity: 0,
            y: 40,
            duration: 0.7,
            delay: (i % 3) * 0.1,
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    gsap.utils.toArray('.auto-flow-node').forEach((node, i) => {
        gsap.from(node, {
            opacity: 0,
            y: 30,
            duration: 0.6,
            delay: i * 0.12,
            scrollTrigger: {
                trigger: node,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    gsap.utils.toArray('.auto-flow-arrow').forEach((arrow, i) => {
        gsap.from(arrow, {
            opacity: 0,
            scale: 0,
            duration: 0.4,
            delay: 0.3 + i * 0.12,
            scrollTrigger: {
                trigger: arrow,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    const ctaSection = document.querySelector('.cta-section');
    if (ctaSection) {
        gsap.from('.cta-title', {
            opacity: 0,
            y: 40,
            duration: 0.8,
            scrollTrigger: {
                trigger: ctaSection,
                start: 'top 75%'
            }
        });
        gsap.from('.cta-desc', {
            opacity: 0,
            y: 30,
            duration: 0.7,
            delay: 0.15,
            scrollTrigger: {
                trigger: ctaSection,
                start: 'top 75%'
            }
        });
        gsap.from('.cta-actions', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            delay: 0.3,
            scrollTrigger: {
                trigger: ctaSection,
                start: 'top 75%'
            }
        });
    }
}

window.addEventListener('load', () => {
    initHeroAnimation();
    initSectionAnimations();
});
