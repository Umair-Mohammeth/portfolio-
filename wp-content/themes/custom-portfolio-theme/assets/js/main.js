/**
 * Tech Portfolio – Main JS v3.0 Glassmorphism
 * Handles: header scroll, mobile nav (a11y), scroll-reveal, filter, counters, glow, back-to-top.
 */
(function () {
    'use strict';

    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var finePointer = window.matchMedia && window.matchMedia('(pointer: fine)').matches;

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

    /* 7. Card glow - fine pointers only */
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
