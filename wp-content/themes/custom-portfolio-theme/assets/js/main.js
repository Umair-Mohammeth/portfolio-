/**
 * Tech Portfolio – Main JS v3.0 Glassmorphism
 * Handles: header scroll, mobile nav (a11y), scroll-reveal, filter, counters, glow, back-to-top.
 */
(function () {
    'use strict';

    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var finePointer = window.matchMedia && window.matchMedia('(pointer: fine)').matches;

    /* PDF Viewer State */
    var pdfDoc = null;
    var pdfPageNum = 1;
    var pdfScale = 1.5;
    var pdfLoading = false;
    var pdfContainer = null;
    var currentPdfUrl = '';

    /* Load PDF.js from CDN */
    function loadPdfJs() {
        return new Promise(function (resolve) {
            if (window.pdfjsLib) {
                resolve(window.pdfjsLib);
                return;
            }
            var script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs';
            script.type = 'module';
            script.onload = function () {
                window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.worker.min.mjs';
                resolve(window.pdfjsLib);
            };
            document.head.appendChild(script);
        });
    }

    /* Load and render PDF */
    function loadPdf(url, canvas) {
        if (pdfLoading) return;
        pdfLoading = true;
        var ctx = canvas.getContext('2d');
        pdfContainer = document.getElementById('project-modal-pdf');
        currentPdfUrl = url;

        loadPdfJs().then(function (pdfjsLib) {
            pdfjsLib.getDocument({ url: url }).promise.then(function (pdf) {
                pdfDoc = pdf;
                pdfPageNum = 1;
                updatePdfPageInfo();
                renderPage(pdfPageNum, canvas, ctx);
                setupPdfControls();
                pdfLoading = false;
            }).catch(function (err) {
                console.error('PDF load error:', err);
                pdfLoading = false;
            });
        });
    }

    function renderPage(num, canvas, ctx) {
        if (!pdfDoc) return;
        pdfDoc.getPage(num).then(function (page) {
            var viewport = page.getViewport({ scale: pdfScale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            var renderContext = { canvasContext: ctx, viewport: viewport };
            page.render(renderContext).promise.then(function () {
                updatePdfPageInfo();
            });
        });
    }

    function updatePdfPageInfo() {
        var currentPageEl = document.getElementById('pdf-current-page');
        var totalPagesEl = document.getElementById('pdf-total-pages');
        var prevBtn = document.getElementById('pdf-prev');
        var nextBtn = document.getElementById('pdf-next');
        if (currentPageEl) currentPageEl.textContent = pdfPageNum;
        if (totalPagesEl) totalPagesEl.textContent = pdfDoc ? pdfDoc.numPages : 1;
        if (prevBtn) prevBtn.disabled = pdfPageNum <= 1;
        if (nextBtn) nextBtn.disabled = pdfDoc && pdfPageNum >= pdfDoc.numPages;
    }

    function setupPdfControls() {
        var prevBtn = document.getElementById('pdf-prev');
        var nextBtn = document.getElementById('pdf-next');
        var downloadBtn = document.getElementById('pdf-download');
        var printBtn = document.getElementById('pdf-print');
        var fullscreenBtn = document.getElementById('pdf-fullscreen');

        if (prevBtn) {
            prevBtn.onclick = function () {
                if (pdfPageNum > 1) {
                    pdfPageNum--;
                    var canvas = document.getElementById('pdf-canvas');
                    var ctx = canvas.getContext('2d');
                    renderPage(pdfPageNum, canvas, ctx);
                }
            };
        }
        if (nextBtn) {
            nextBtn.onclick = function () {
                if (pdfDoc && pdfPageNum < pdfDoc.numPages) {
                    pdfPageNum++;
                    var canvas = document.getElementById('pdf-canvas');
                    var ctx = canvas.getContext('2d');
                    renderPage(pdfPageNum, canvas, ctx);
                }
            };
        }
        if (downloadBtn) {
            downloadBtn.onclick = function () {
                if (currentPdfUrl) {
                    var a = document.createElement('a');
                    a.href = currentPdfUrl;
                    a.download = 'documentation.pdf';
                    a.click();
                }
            };
        }
        if (printBtn) {
            printBtn.onclick = function () {
                if (currentPdfUrl) {
                    var printWindow = window.open(currentPdfUrl);
                    printWindow.onload = function () {
                        printWindow.print();
                    };
                }
            };
        }
        if (fullscreenBtn) {
            fullscreenBtn.onclick = function () {
                if (currentPdfUrl) {
                    window.open(currentPdfUrl, '_blank');
                }
            };
        }
    }

    var pdfDoc = null;
    var pdfPageNum = 1;
    var pdfScale = 1.5;
    var pdfLoading = false;
    var pdfContainer = null;
    var currentPdfUrl = '';

    /* 1. Header scroll + back-to-top */
    var header = document.getElementById('site-header');
    var backTop = document.getElementById('back-to-top');
    var ticking = false;
    function onScrollPos() {
        var y = window.scrollY || window.pageYOffset;
        if (header) header.classList.toggle('is-scrolled', y > 24);
        if (backTop) backTop.classList.toggle('visible', y > 600);
        ticking = false;
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; requestAnimationFrame(onScrollPos); }
    }, { passive: true });
    onScrollPos();
    if (backTop) {
        backTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: prefersReduced ? 'auto' : 'smooth' });
        });
    }

    /* 2. Mobile nav with Escape + focus management */
    var navToggle = document.getElementById('nav-toggle');
    var navMenu = document.getElementById('primary-nav') || document.querySelector('.nav-menu');
    function setNav(open) {
        if (!navMenu || !navToggle) return;
        navMenu.classList.toggle('open', open);
        navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) {
            var first = navMenu.querySelector('a');
            if (first) first.focus({ preventScroll: true });
        }
    }
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            setNav(!navMenu.classList.contains('open'));
        });
        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () { setNav(false); navToggle.focus({ preventScroll: true }); });
        });
        document.addEventListener('click', function (e) {
            if (navMenu.classList.contains('open') && !navMenu.contains(e.target) && !navToggle.contains(e.target)) setNav(false);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && navMenu.classList.contains('open')) { setNav(false); navToggle.focus(); }
        });
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768 && navMenu.classList.contains('open')) setNav(false);
        });
    }

    /* 3. Scroll reveal */
    var revealEls = document.querySelectorAll('.reveal');
    if (prefersReduced) {
        revealEls.forEach(function (el) { el.classList.add('visible'); });
    } else if (revealEls.length > 0 && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) { entry.target.classList.add('visible'); observer.unobserve(entry.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
        revealEls.forEach(function (el) { observer.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('visible'); });
    }

    /* 4. Counters */
    var statNumbers = document.querySelectorAll('.stat-number');
    function animateCounter(el) {
        var raw = el.textContent.trim();
        var suffix = raw.replace(/[0-9.\s]/g, '');
        var target = parseFloat(raw.replace(/[^0-9.]/g, ''));
        if (isNaN(target)) return;
        if (prefersReduced) { el.textContent = target + suffix; return; }
        var duration = 1200, start = performance.now();
        function update(now) {
            var p = Math.min((now - start) / duration, 1);
            var eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(eased * target) + suffix;
            if (p < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }
    if (statNumbers.length && 'IntersectionObserver' in window && !prefersReduced) {
        var cObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { animateCounter(en.target); cObs.unobserve(en.target); }
            });
        }, { threshold: 0.5 });
        statNumbers.forEach(function (el) { cObs.observe(el); });
    }

    /* 5. Project filter (null-safe, with live region) */
    var filterButtons = document.querySelectorAll('.filter-btn');
    var grid = document.getElementById('portfolio-grid');
    var status = document.getElementById('filter-status');
    if (filterButtons.length && grid) {
        var cards = Array.prototype.slice.call(grid.querySelectorAll('.project-card'));
        // Ensure filtered cards participate in reveal.
        cards.forEach(function (c) { c.classList.add('visible'); });
        filterButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterButtons.forEach(function (b) { b.classList.remove('active'); b.setAttribute('aria-pressed', 'false'); });
                btn.classList.add('active');
                btn.setAttribute('aria-pressed', 'true');
                var f = btn.getAttribute('data-filter') || 'all';
                var shown = 0;
                cards.forEach(function (card) {
                    var cats = (card.getAttribute('data-categories') || '').split(',').map(function (s) { return s.trim(); }).filter(Boolean);
                    var show = (f === 'all' || cats.indexOf(f) !== -1);
                    if (show) {
                        shown++;
                        card.style.display = '';
                        if (!prefersReduced) {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(14px)';
                            card.getBoundingClientRect();
                            card.style.transition = 'opacity .35s ease, transform .35s ease';
                            requestAnimationFrame(function () { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; });
                        } else { card.style.opacity = ''; card.style.transform = ''; }
                    } else {
                        if (!prefersReduced) {
                            card.style.transition = 'opacity .2s ease';
                            card.style.opacity = '0';
                            setTimeout(function () { card.style.display = 'none'; }, 180);
                        } else { card.style.display = 'none'; }
                    }
                });
                if (status) status.textContent = shown + ' project' + (shown === 1 ? '' : 's') + ' shown.';
            });
        });
    }

    /* 6. Active nav highlight */
    try {
        var cur = window.location.pathname.replace(/\/$/, '') || '/';
        document.querySelectorAll('.nav-menu a').forEach(function (link) {
            var lp = new URL(link.href, window.location.origin).pathname.replace(/\/$/, '') || '/';
            if (lp === cur || (lp !== '/' && cur.indexOf(lp) === 0)) {
                var li = link.closest('li');
                if (li) li.classList.add('current-menu-item');
            }
        });
    } catch (e) { /* ignore */ }

    /* 9. Card glow - fine pointers only */
    if (finePointer && !prefersReduced) {
        document.querySelectorAll('.skill-card, .project-card').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var r = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', (e.clientX - r.left) + 'px');
                card.style.setProperty('--mouse-y', (e.clientY - r.top) + 'px');
            }, { passive: true });
        });
    }

    /* 10. Generic Modal Handler */
    function createModalHandler(config) {
        var modal = document.getElementById(config.modalId);
        var triggers = document.querySelectorAll(config.triggerSelector);
        var dataEl = document.getElementById(config.dataId);
        var data = dataEl ? JSON.parse(dataEl.textContent) : [];

        if (!modal || !triggers.length || !data.length) return;

        var closeBtn = modal.querySelector(config.closeSelector);
        var closeBtn2 = modal.querySelector(config.closeBtnSelector);
        var backdrop = modal.querySelector('.cert-modal-backdrop, .timeline-modal-backdrop, .project-modal-backdrop');
        var lastFocused = null;

        // DOM elements per modal type
        var elements = {};
        if (config.modalId === 'cert-modal') {
            elements = {
                title: modal.querySelector('.cert-modal-title'),
                issuer: modal.querySelector('.cert-modal-issuer'),
                badge: modal.querySelector('.cert-modal-badge svg'),
                date: modal.querySelector('.cert-modal-date'),
                credential: modal.querySelector('.cert-modal-credential'),
                desc: modal.querySelector('.cert-modal-description'),
                skills: modal.querySelector('.cert-modal-skills-grid'),
            };
        } else if (config.modalId === 'education-modal') {
            elements = {
                title: modal.querySelector('.timeline-modal-title'),
                institution: modal.querySelector('.timeline-modal-institution'),
                date: modal.querySelector('.timeline-modal-date'),
                credential: modal.querySelector('.timeline-modal-credential'),
                desc: modal.querySelector('.timeline-modal-description'),
                skills: modal.querySelector('.timeline-modal-skills-grid'),
            };
        } else if (config.modalId === 'experience-modal') {
            elements = {
                title: modal.querySelector('.timeline-modal-title'),
                company: modal.querySelector('.timeline-modal-company'),
                date: modal.querySelector('.timeline-modal-date'),
                type: modal.querySelector('.timeline-modal-type'),
                desc: modal.querySelector('.timeline-modal-description'),
                skills: modal.querySelector('.timeline-modal-skills-grid'),
            };
        } else if (config.modalId === 'project-modal') {
            elements = {
                image: modal.querySelector('#project-modal-image'),
                title: modal.querySelector('.project-modal-title'),
                role: modal.querySelector('.project-modal-role'),
                desc: modal.querySelector('.project-modal-description'),
                tech: modal.querySelector('.project-modal-tech-grid'),
                cats: modal.querySelector('.project-modal-cat-grid'),
                github: modal.querySelector('#project-modal-github'),
                live: modal.querySelector('#project-modal-live'),
                full: modal.querySelector('#project-modal-full'),
            };
        }

        var lastFocused = null;

        function openModal(index) {
            var item = data[index];
            if (!item) return;
            lastFocused = document.activeElement;

            if (config.modalId === 'cert-modal') {
                if (elements.title) elements.title.textContent = item.name || '';
                if (elements.issuer) elements.issuer.textContent = item.issuer || '';
                if (elements.badge) elements.badge.innerHTML = item.icon || '';
                if (elements.date) elements.date.textContent = item.date || '';
                if (elements.credential) elements.credential.textContent = item.credential || '';
                if (elements.desc) elements.desc.textContent = item.description || '';
                if (elements.skills) {
                    elements.skills.innerHTML = '';
                    if (item.skills && item.skills.length) {
                        item.skills.forEach(function (s) {
                            var span = document.createElement('span');
                            span.className = 'tech-badge';
                            span.textContent = s;
                            elements.skills.appendChild(span);
                        });
                    }
                }
            } else if (config.modalId === 'education-modal') {
                if (elements.title) elements.title.textContent = item.title || '';
                if (elements.institution) elements.institution.textContent = item.institution || '';
                if (elements.date) elements.date.textContent = item.date || '';
                if (elements.credential) elements.credential.textContent = item.credential || '';
                if (elements.desc) elements.desc.textContent = item.description || '';
                if (elements.skills) {
                    elements.skills.innerHTML = '';
                    if (item.skills && item.skills.length) {
                        item.skills.forEach(function (s) {
                            var span = document.createElement('span');
                            span.className = 'tech-badge';
                            span.textContent = s;
                            elements.skills.appendChild(span);
                        });
                    }
                }
            } else if (config.modalId === 'experience-modal') {
                if (elements.title) elements.title.textContent = item.title || '';
                if (elements.company) elements.company.textContent = item.company || '';
                if (elements.date) elements.date.textContent = item.date || '';
                if (elements.type) elements.type.textContent = (item.type || '').charAt(0).toUpperCase() + (item.type || '').slice(1);
                if (elements.desc) elements.desc.textContent = item.description || '';
                if (elements.skills) {
                    elements.skills.innerHTML = '';
                    if (item.skills && item.skills.length) {
                        item.skills.forEach(function (s) {
                            var span = document.createElement('span');
                            span.className = 'tech-badge';
                            span.textContent = s;
                            elements.skills.appendChild(span);
                        });
                    }
                }
            } else if (config.modalId === 'project-modal') {
                if (elements.image) { elements.image.src = item.image || ''; elements.image.alt = item.title || ''; }
                if (elements.title) elements.title.textContent = item.title || '';
                if (elements.role) elements.role.textContent = item.role || '';
                if (elements.desc) elements.desc.textContent = item.excerpt || '';
                if (elements.tech) {
                    elements.tech.innerHTML = '';
                    if (item.tech_stack) {
                        item.tech_stack.split(',').map(function(s){return s.trim();}).filter(Boolean).forEach(function (t) {
                            var span = document.createElement('span');
                            span.className = 'tech-badge';
                            span.textContent = t;
                            elements.tech.appendChild(span);
                        });
                    }
                }
                if (elements.cats) {
                    elements.cats.innerHTML = '';
                    if (item.categories && item.categories.length) {
                        item.categories.forEach(function (c) {
                            var span = document.createElement('span');
                            span.className = 'tech-badge';
                            span.textContent = c;
                            elements.cats.appendChild(span);
                        });
                    }
                }
                if (elements.github) {
                    if (item.github) { elements.github.href = item.github; elements.github.style.display = 'inline-flex'; } else { elements.github.style.display = 'none'; }
                }
                if (elements.live) {
                    if (item.live) { elements.live.href = item.live; elements.live.style.display = 'inline-flex'; } else { elements.live.style.display = 'none'; }
                }
                if (elements.full) {
                    if (item.permalink) { elements.full.href = item.permalink; elements.full.style.display = 'inline-flex'; } else { elements.full.style.display = 'none'; }
                }
                // PDF viewer setup
                var pdfContainer = modal.querySelector('#project-modal-pdf');
                var pdfCanvas = modal.querySelector('#pdf-canvas');
                var pdfUrl = item.pdf || '';
                if (pdfUrl && pdfContainer && pdfCanvas) {
                    pdfContainer.style.display = 'block';
                    loadPdf(pdfUrl, pdfCanvas);
                } else if (pdfContainer) {
                    pdfContainer.style.display = 'none';
                }
            }

            modal.hidden = false;
            modal.getBoundingClientRect();
            modal.removeAttribute('hidden');
            document.body.style.overflow = 'hidden';
            var focusTarget = modal.querySelector(config.focusSelector) || modal.querySelector('.cert-modal-close, .timeline-modal-close, .project-modal-close');
            if (focusTarget) focusTarget.focus({ preventScroll: true });
            trapFocus(modal);
        }

        function closeModal() {
            if (prefersReduced) {
                modal.hidden = true;
            } else {
                modal.setAttribute('hidden', '');
                setTimeout(function () {
                    if (modal.hasAttribute('hidden')) modal.hidden = true;
                }, 300);
            }
            document.body.style.overflow = '';
            if (lastFocused) lastFocused.focus({ preventScroll: true });
        }

        function trapFocus(modal) {
            var focusable = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            var first = focusable[0];
            var last = focusable[focusable.length - 1];
            var handler = function (e) {
                if (e.key !== 'Tab') return;
                if (e.shiftKey) {
                    if (document.activeElement === first) { e.preventDefault(); last.focus(); }
                } else {
                    if (document.activeElement === last) { e.preventDefault(); first.focus(); }
                }
            };
            modal.addEventListener('keydown', handler);
            modal._focusTrapHandler = handler;
        }

        var keydownTriggers = document.querySelectorAll(config.keydownSelector || config.triggerSelector);
        
        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                if (e.target.closest('a[href]')) return;
                var idx = parseInt(this.getAttribute(config.indexAttr), 10);
                openModal(idx);
            });
        });
        
        keydownTriggers.forEach(function (trigger) {
            trigger.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    var idx = parseInt(this.getAttribute(config.indexAttr), 10);
                    openModal(idx);
                }
            });
        });

        var closeBtn = modal.querySelector(config.closeSelector);
        var closeBtn2 = modal.querySelector(config.closeBtnSelector);
        var backdrop = modal.querySelector('.cert-modal-backdrop, .timeline-modal-backdrop, .project-modal-backdrop');
        [closeBtn, closeBtn2, backdrop].forEach(function (el) {
            if (el) el.addEventListener('click', function (e) {
                if (e.target.closest('a[href]')) return; // don't close if clicking link
                closeModal();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal && !modal.hasAttribute('hidden')) {
                closeModal();
            }
        });
    }

    // Initialize all modals
    createModalHandler({
        modalId: 'education-modal',
        triggerSelector: '.timeline-card-quickview[data-timeline-type="education"]',
        keydownSelector: '.timeline-card-quickview[data-timeline-type="education"], .timeline-card[data-timeline-type="education"]',
        dataId: 'education-details-data',
        indexAttr: 'data-timeline-index',
        closeSelector: '.timeline-modal-close',
        closeBtnSelector: '.timeline-modal-close-btn',
        focusSelector: '.timeline-modal-close',
    });

    createModalHandler({
        modalId: 'project-modal',
        triggerSelector: '.project-card-quickview',
        keydownSelector: '.project-card-quickview, .project-card[data-project-id]',
        dataId: 'project-details-data',
        indexAttr: 'data-project-id',
        closeSelector: '.project-modal-close',
        closeBtnSelector: '.project-modal-close-btn-none',
        focusSelector: '.project-modal-close',
    });

    /* 11. Card glow - fine pointers only */
    if (finePointer && !prefersReduced) {
        document.querySelectorAll('.skill-card, .project-card').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var r = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', (e.clientX - r.left) + 'px');
                card.style.setProperty('--mouse-y', (e.clientY - r.top) + 'px');
            }, { passive: true });
        });
    }

})();
