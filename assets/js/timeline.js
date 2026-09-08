class WorkflowTimeline {
    constructor() {
        this.section = document.querySelector('.timeline-section');
        if (!this.section) return;

        this.track = this.section.querySelector('.timeline-track');
        this.nodes = this.section.querySelectorAll('.timeline-node');
        this.progressFill = this.section.querySelector('.timeline-progress-fill');
        this.currentIndex = 0;
        this.isDesktop = window.innerWidth > 1024;

        if (this.isDesktop) {
            this.initDesktop();
        } else {
            this.initMobile();
        }
    }

    initDesktop() {
        gsap.registerPlugin(ScrollTrigger);

        const totalWidth = (this.nodes.length - 1) * 420;

        ScrollTrigger.create({
            trigger: this.section,
            start: 'top top',
            end: () => `+=${totalWidth}`,
            pin: true,
            scrub: 1,
            onUpdate: (self) => {
                const progress = self.progress;
                const translateX = -progress * totalWidth;

                gsap.set(this.track, { x: translateX });

                const activeIndex = Math.round(progress * (this.nodes.length - 1));
                this.setActiveNode(activeIndex);

                if (this.progressFill) {
                    this.progressFill.style.width = (progress * 100) + '%';
                }
            }
        });
    }

    setActiveNode(index) {
        if (index === this.currentIndex) return;
        this.currentIndex = index;

        this.nodes.forEach((node, i) => {
            node.classList.toggle('active', i === index);
        });

        const activeNode = this.nodes[index];
        if (activeNode) {
            const scan = activeNode.querySelector('.timeline-node-scan');
            if (scan) {
                scan.style.animation = 'none';
                scan.offsetHeight;
                scan.style.animation = 'scanAcross 1.5s ease-in-out';
            }
        }
    }

    initMobile() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.3 });

        this.nodes.forEach(node => observer.observe(node));
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new WorkflowTimeline();
});
