class CustomCursor {
    constructor() {
        this.cursor = document.getElementById('cursor');
        if (!this.cursor) return;
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            this.cursor.style.display = 'none';
            return;
        }

        this.dot = this.cursor.querySelector('.cursor-dot');
        this.ring = this.cursor.querySelector('.cursor-ring');
        this.label = this.cursor.querySelector('.cursor-label');
        this.pos = { x: 0, y: 0 };
        this.mouse = { x: 0, y: 0 };
        this.speed = 0.15;
        this.isHovering = false;

        this.init();
    }

    init() {
        document.addEventListener('mousemove', (e) => {
            this.mouse.x = e.clientX;
            this.mouse.y = e.clientY;
        });

        this.setupHoverTargets();
        this.render();
    }

    setupHoverTargets() {
        document.querySelectorAll('a, button, .magnetic-btn, .tech-card, .industry-card, .product-card').forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-magnetic');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-magnetic');
            });
        });

        document.querySelectorAll('[data-cursor]').forEach(el => {
            el.addEventListener('mouseenter', () => {
                this.label.textContent = el.dataset.cursor;
                document.body.classList.add('cursor-label-active');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-label-active');
            });
        });

        document.querySelectorAll('.tech-card, .industry-card').forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-expand');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-expand');
            });
        });
    }

    render() {
        this.pos.x += (this.mouse.x - this.pos.x) * this.speed;
        this.pos.y += (this.mouse.y - this.pos.y) * this.speed;

        this.cursor.style.transform = `translate3d(${this.pos.x}px, ${this.pos.y}px, 0)`;

        requestAnimationFrame(() => this.render());
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new CustomCursor();
});
