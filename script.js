/* UMAIR.TECH v4 — nav, reveal, counters, filter, modal */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* year */
  var y = document.getElementById('year');
  if (y) y.textContent = new Date().getFullYear();

  /* theme: system default, persisted override */
  var themeBtn = document.getElementById('theme-toggle');
  function applyTheme(t) {
    document.documentElement.setAttribute('data-theme', t);
    var bg = t === 'light' ? '#faf7f1' : '#06070d';
    document.querySelectorAll('meta[name="theme-color"]').forEach(function (m) {
      m.setAttribute('content', bg);
    });
    if (themeBtn) {
      var light = t === 'light';
      themeBtn.setAttribute('aria-pressed', light ? 'true' : 'false');
      themeBtn.setAttribute('aria-label', light ? 'Switch to dark theme' : 'Switch to light theme');
      themeBtn.title = light ? 'Switch to dark theme' : 'Switch to light theme';
    }
  }
  try {
    var saved = localStorage.getItem('umair-theme');
    var sysLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
    applyTheme(saved || (sysLight ? 'light' : 'dark'));
  } catch (e) { applyTheme('dark'); }
  if (themeBtn) themeBtn.addEventListener('click', function () {
    var next = document.documentElement.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
    try { localStorage.setItem('umair-theme', next); } catch (e) { /* private mode */ }
    applyTheme(next);
  });
  try {
    var mq = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)');
    if (mq && mq.addEventListener) mq.addEventListener('change', function (e) {
      if (!localStorage.getItem('umair-theme')) applyTheme(e.matches ? 'light' : 'dark');
    });
  } catch (e) { /* noop */ }

  /* header + to-top */
  var header = document.getElementById('site-header');
  var toTop = document.getElementById('to-top');
  var progress = document.getElementById('scroll-progress-bar');
  var tick = false;
  function onScroll() {
    var pos = window.scrollY || 0;
    if (header) header.classList.toggle('scrolled', pos > 24);
    if (toTop) toTop.hidden = pos < 600;
    if (progress) {
      var max = document.documentElement.scrollHeight - window.innerHeight;
      progress.style.transform = 'scaleX(' + (max > 0 ? Math.min(pos / max, 1) : 0) + ')';
    }
    tick = false;
  }
  window.addEventListener('scroll', function () {
    if (!tick) { tick = true; requestAnimationFrame(onScroll); }
  }, { passive: true });
  onScroll();
  if (toTop) toTop.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
  });

  /* mobile nav */
  var toggle = document.getElementById('nav-toggle');
  var menu = document.getElementById('primary-nav');
  function setNav(open) {
    if (!menu || !toggle) return;
    menu.classList.toggle('open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  }
  if (toggle && menu) {
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      setNav(!menu.classList.contains('open'));
    });
    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () { setNav(false); });
    });
    document.addEventListener('click', function (e) {
      if (menu.classList.contains('open') && !menu.contains(e.target) && !toggle.contains(e.target)) setNav(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && menu.classList.contains('open')) { setNav(false); toggle.focus(); }
    });
  }

  /* active link (multi-page: match pathname, fall back to hash) */
  try {
    var path = (location.pathname.split('/').pop() || 'index.html').toLowerCase();
    var page = path.replace(/\.html$/, '') || 'index';
    if (page === 'index') page = 'home';
    var matched = false;
    document.querySelectorAll('.nav-menu a[data-nav]').forEach(function (a) {
      if (a.dataset.nav === page) { a.classList.add('active'); a.setAttribute('aria-current', 'page'); matched = true; }
    });
    if (!matched) {
      var h = location.hash;
      if (h) {
        var t = document.querySelector('.nav-menu a[href$="' + h + '"]');
        if (t) { t.classList.add('active'); t.setAttribute('aria-current', 'page'); }
      }
    }
  } catch (e) { /* noop */ }

  /* reveal */
  var els = document.querySelectorAll('.reveal');
  if (reduce || !('IntersectionObserver' in window)) {
    els.forEach(function (el) { el.classList.add('visible'); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('visible'); io.unobserve(en.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    els.forEach(function (el) { io.observe(el); });
  }

  /* counters */
  function count(el) {
    var target = parseFloat(el.dataset.count || '0');
    var suffix = el.dataset.suffix || '';
    if (reduce || isNaN(target)) { el.textContent = target + suffix; return; }
    var t0 = performance.now(), dur = 1200;
    (function step(now) {
      var p = Math.min((now - t0) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(eased * target) + suffix;
      if (p < 1) requestAnimationFrame(step);
    })(t0);
  }
  var nums = document.querySelectorAll('.stat-num');
  if ('IntersectionObserver' in window && !reduce) {
    var co = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { count(en.target); co.unobserve(en.target); }
      });
    }, { threshold: 0.5 });
    nums.forEach(function (n) { co.observe(n); });
  } else {
    nums.forEach(count);
  }

  /* typing rotator */
  var typedEl = document.getElementById('typed');
  var roles = ['Network Administrator', 'Cybersecurity Engineer', 'Python Automator', 'CCNA Certified'];
  if (typedEl && !reduce) {
    var ri = 0, ci = roles[0].length, del = true;
    (function tickType() {
      var word = roles[ri];
      if (del) {
        ci--;
        if (ci <= 0) { ci = 0; del = false; ri = (ri + 1) % roles.length; word = roles[ri]; }
      } else {
        ci++;
        if (ci >= word.length) {
          ci = word.length;
          typedEl.textContent = word;
          setTimeout(function () { del = true; tickType(); }, 1600);
          return;
        }
      }
      typedEl.textContent = word.slice(0, ci);
      setTimeout(tickType, del ? 32 : 62);
    })();
  } else if (typedEl) {
    typedEl.textContent = roles[0];
  }

  /* projects data (mirrors GitHub: Umair-Mohammeth) */
  var PROJECTS = [
    { title: 'Smart IoT Parcel Delivery System', cat: 'iot', cats: ['iot', 'security'], role: 'Lead Developer / IoT Engineer', desc: 'ESP32 + RFID access control, servo lock, Telegram alerts and tamper detection for secure parcel hand-off.', tech: ['ESP32', 'RFID', 'Python', 'Telegram API'], github: 'https://github.com/Umair-Mohammeth/Smart-Door-Delivery-Authentication-System' },
    { title: 'Network Infrastructure Simulation', cat: 'network', cats: ['network'], role: 'Network Engineer', desc: 'Packet Tracer enterprise topology: VLANs, OSPF, ACLs, VPN, DHCP and DNS services.', tech: ['Cisco Packet Tracer', 'VLAN', 'OSPF', 'ACL'], github: '' },
    { title: 'ESC/POS Desktop POS', cat: 'automation', cats: ['automation'], role: 'Lead Developer', desc: 'Professional desktop point-of-sale for non-technical users driving ESC/POS thermal printers.', tech: ['Python', 'ESC/POS', 'Desktop UI'], github: 'https://github.com/Umair-Mohammeth/ESC-POS' },
    { title: 'ESC/POS Windows Base', cat: 'automation', cats: ['automation'], role: 'Developer', desc: 'Windows-native C# rebuild of the ESC/POS point-of-sale with direct printer integration.', tech: ['C#', '.NET', 'ESC/POS'], github: 'https://github.com/Umair-Mohammeth/ESC-POS---windows-base' },
    { title: 'School Scheme-of-Work Generator', cat: 'automation', cats: ['automation'], role: 'Developer', desc: 'Python tool that auto-generates structured Scheme of Work documents for educators.', tech: ['Python', 'Automation', 'Documents'], github: 'https://github.com/Umair-Mohammeth/School-Scheme-of-Work-Generator-' },
    { title: 'Word Checker', cat: 'web', cats: ['web', 'automation'], role: 'Developer', desc: 'Text-analysis tool that scans documents for user-defined keyword and phrase references.', tech: ['JavaScript', 'Text Analysis'], github: 'https://github.com/Umair-Mohammeth/Word-Checker' },
    { title: 'Redirect Extension', cat: 'web', cats: ['web'], role: 'Developer', desc: 'Lightweight browser extension applying configurable redirect rules while browsing.', tech: ['JavaScript', 'Chrome APIs'], github: 'https://github.com/Umair-Mohammeth/Redirect-extension-' },
    { title: 'Health Ease Manage', cat: 'web', cats: ['web'], role: 'Frontend Developer', desc: 'Health records and management web app built with React and TypeScript.', tech: ['TypeScript', 'React'], github: 'https://github.com/Umair-Mohammeth/health-ease-manage' },
    { title: 'Custom Tech Portfolio', cat: 'web', cats: ['web'], role: 'Designer & Developer', desc: 'This portfolio theme: dark glassmorphism system, filterable projects, zero page builders.', tech: ['PHP', 'WordPress', 'CSS3', 'JavaScript'], github: 'https://github.com/Umair-Mohammeth/portfolio-' }
  ];

  /* render + filter */
  var grid = document.getElementById('project-grid');
  var status = document.getElementById('filter-status');
  var COVER = {
    iot: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><rect x="6" y="3" width="12" height="18" rx="2"/><circle cx="12" cy="17" r="1" fill="currentColor"/><path d="M9 8h6M9 11h6"/></svg>',
    network: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="5" r="2.2"/><circle cx="5" cy="19" r="2.2"/><circle cx="19" cy="19" r="2.2"/><path d="M12 7.2v5M10.2 12L6.4 17M13.8 12l3.8 5"/></svg>',
    security: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-3.5 8-10V5l-8-3-8 3v7c0 6.5 8 10 8 10z"/></svg>',
    automation: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 5l-2 14"/></svg>',
    web: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 3.8 5.7 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.7-3.8-9S9.5 5.6 12 3z"/></svg>'
  };
  function esc(s) {
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }
  function card(p, i) {
    var tags = p.tech.map(function (t) { return '<span>' + esc(t) + '</span>'; }).join('');
    var cov = COVER[p.cat] || COVER.web;
    return '<article class="proj-card reveal visible" data-cats="' + p.cats.join(',') + '">' +
      '<div class="proj-cover cov-' + p.cat + '" aria-hidden="true">' + cov + '</div>' +
      '<div class="proj-top"><span class="proj-cat">' + esc(p.cat) + '</span>' +
      '<button class="qv" data-i="' + i + '" aria-label="Quick view ' + esc(p.title) + '" title="Quick view">ⓘ</button></div>' +
      '<h3>' + esc(p.title) + '</h3><p>' + esc(p.desc) + '</p>' +
      '<div class="badges">' + tags + '</div></article>';
  }
  function render(filter) {
    if (!grid) return;
    var limit = parseInt(grid.dataset.limit || '0', 10) || 0;
    var shown = 0, added = 0;
    grid.innerHTML = PROJECTS.map(function (p, i) {
      var show = !filter || filter === 'all' || p.cats.indexOf(filter) !== -1;
      if (show && (!limit || added < limit)) { shown++; added++; return card(p, i); }
      if (show) shown++;
      return '';
    }).join('');
    if (status) status.textContent = shown + ' projects shown';
    bindQuick();
  }
  document.querySelectorAll('.filter-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.filter-btn').forEach(function (b) {
        b.classList.remove('active'); b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('active'); btn.setAttribute('aria-pressed', 'true');
      render(btn.dataset.filter);
    });
  });
  render('all');

  /* magnetic buttons (fine pointers, motion-safe) */
  if (!reduce && window.matchMedia && window.matchMedia('(pointer: fine)').matches) {
    document.querySelectorAll('.btn').forEach(function (b) {
      b.classList.add('btn-mag');
      b.addEventListener('mousemove', function (e) {
        var r = b.getBoundingClientRect();
        var x = (e.clientX - r.left - r.width / 2) / r.width;
        var yy = (e.clientY - r.top - r.height / 2) / r.height;
        b.style.transform = 'translate(' + (x * 6).toFixed(1) + 'px,' + (yy * 6).toFixed(1) + 'px)';
      });
      b.addEventListener('mouseleave', function () { b.style.transform = ''; });
    });
  }

  /* modal */
  var modal = document.getElementById('project-modal');
  var mTitle = document.getElementById('pm-title');
  var mRole = document.getElementById('pm-role');
  var mDesc = document.getElementById('pm-desc');
  var mTech = document.getElementById('pm-tech');
  var mGit = document.getElementById('pm-github');
  var mFull = document.getElementById('pm-full');
  var lastFocus = null;
  /* lazy PDF.js viewer */
  var pdfLib = null, pdfLoading = false, pdfDoc = null, pdfPage = 1, pdfUrl = '';
  function ensurePdfLib(cb) {
    if (pdfLib) { cb(pdfLib); return; }
    if (pdfLoading) {
      var wait = setInterval(function () {
        if (pdfLib) { clearInterval(wait); cb(pdfLib); }
      }, 200);
      return;
    }
    pdfLoading = true;
    var s = document.createElement('script');
    s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
    s.onload = function () {
      pdfLib = window.pdfjsLib;
      pdfLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
      pdfLoading = false;
      cb(pdfLib);
    };
    s.onerror = function () { pdfLoading = false; };
    document.head.appendChild(s);
  }
  function renderPdfPage() {
    var canvas = document.getElementById('pdf-canvas');
    if (!canvas || !pdfDoc) return;
    pdfDoc.getPage(pdfPage).then(function (page) {
      var vp = page.getViewport({ scale: 1.4 });
      canvas.width = vp.width; canvas.height = vp.height;
      page.render({ canvasContext: canvas.getContext('2d'), viewport: vp });
      document.getElementById('pdf-cur').textContent = pdfPage;
      document.getElementById('pdf-total').textContent = pdfDoc.numPages;
      document.getElementById('pdf-prev').disabled = pdfPage <= 1;
      document.getElementById('pdf-next').disabled = pdfPage >= pdfDoc.numPages;
    });
  }
  function loadPdf(url) {
    var box = document.getElementById('pm-pdf');
    pdfUrl = url;
    if (!url) { if (box) box.hidden = true; return; }
    if (box) box.hidden = false;
    ensurePdfLib(function (lib) {
      lib.getDocument(url).promise.then(function (doc) {
        pdfDoc = doc; pdfPage = 1; renderPdfPage();
      }).catch(function () {
        var stage = document.querySelector('.pdf-stage');
        if (stage) stage.innerHTML = '<p class="muted" style="padding:20px">Could not load PDF. <a href="' + url + '" target="_blank" rel="noopener" style="color:var(--gold)">Open directly</a>.</p>';
      });
    });
  }
  function trapTab(e) {
    var f = modal.querySelectorAll('button, a[href]');
    f = Array.prototype.filter.call(f, function (el) { return !el.hidden && el.offsetParent !== null; });
    if (!f.length) return;
    var first = f[0], last = f[f.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  }
  function openModal(p) {
    if (!modal) return;
    lastFocus = document.activeElement;
    mTitle.textContent = p.title;
    mRole.textContent = p.role;
    mDesc.textContent = p.desc;
    mTech.innerHTML = p.tech.map(function (t) { return '<span>' + esc(t) + '</span>'; }).join('');
    if (p.github) { mGit.href = p.github; mGit.hidden = false; } else { mGit.hidden = true; }
    if (p.github) { mFull.href = p.github; mFull.hidden = false; } else { mFull.hidden = true; }
    loadPdf(p.pdf || '');
    modal.hidden = false;
    document.body.style.overflow = 'hidden';
    var x = modal.querySelector('.modal-x');
    if (x) x.focus();
  }
  function closeModal() {
    if (!modal) return;
    modal.hidden = true;
    document.body.style.overflow = '';
    pdfDoc = null;
    if (lastFocus && lastFocus.focus) lastFocus.focus();
  }
  function bindQuick() {
    grid.querySelectorAll('.qv').forEach(function (b) {
      b.addEventListener('click', function (e) {
        e.stopPropagation();
        var p = PROJECTS[parseInt(b.dataset.i, 10)];
        if (p) openModal(p);
      });
    });
  }
  if (modal) {
    modal.querySelectorAll('[data-close]').forEach(function (el) {
      el.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !modal.hidden) closeModal();
      if (e.key === 'Tab' && !modal.hidden) trapTab(e);
    });
    var prev = document.getElementById('pdf-prev');
    var next = document.getElementById('pdf-next');
    var dl = document.getElementById('pdf-download');
    var pr = document.getElementById('pdf-print');
    if (prev) prev.addEventListener('click', function () { if (pdfDoc && pdfPage > 1) { pdfPage--; renderPdfPage(); } });
    if (next) next.addEventListener('click', function () { if (pdfDoc && pdfPage < pdfDoc.numPages) { pdfPage++; renderPdfPage(); } });
    if (dl) dl.addEventListener('click', function () {
      if (!pdfUrl) return;
      var a = document.createElement('a');
      a.href = pdfUrl; a.download = ''; a.target = '_blank'; a.rel = 'noopener';
      document.body.appendChild(a); a.click(); a.remove();
    });
    if (pr) pr.addEventListener('click', function () {
      if (!pdfUrl) return;
      var w = window.open(pdfUrl, '_blank', 'noopener');
      if (w) w.onload = function () { w.print(); };
    });
  }
})();
