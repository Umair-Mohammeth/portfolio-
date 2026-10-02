/* UMAIR.TECH v4 — nav, reveal, counters, filter, modal */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* year */
  var y = document.getElementById('year');
  if (y) y.textContent = new Date().getFullYear();

  /* header + to-top */
  var header = document.getElementById('site-header');
  var toTop = document.getElementById('to-top');
  var tick = false;
  function onScroll() {
    var pos = window.scrollY || 0;
    if (header) header.classList.toggle('scrolled', pos > 24);
    if (toTop) toTop.hidden = pos < 600;
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

  /* active link */
  try {
    var cur = location.hash || '#top';
    document.querySelectorAll('.nav-menu a').forEach(function (a) {
      a.addEventListener('click', function () {
        document.querySelectorAll('.nav-menu a').forEach(function (x) { x.classList.remove('active'); });
        a.classList.add('active');
      });
    });
    void cur;
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
  function card(p, i) {
    var tags = p.tech.map(function (t) { return '<span>' + t + '</span>'; }).join('');
    return '<article class="proj-card reveal visible" data-cats="' + p.cats.join(',') + '">' +
      '<div class="proj-top"><span class="proj-cat">' + p.cat + '</span>' +
      '<button class="qv" data-i="' + i + '" aria-label="Quick view ' + p.title + '" title="Quick view">ⓘ</button></div>' +
      '<h3>' + p.title + '</h3><p>' + p.desc + '</p>' +
      '<div class="badges">' + tags + '</div></article>';
  }
  function render(filter) {
    if (!grid) return;
    var shown = 0;
    grid.innerHTML = PROJECTS.map(function (p, i) {
      var show = !filter || filter === 'all' || p.cats.indexOf(filter) !== -1;
      if (show) { shown++; return card(p, i); }
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

  /* modal */
  var modal = document.getElementById('project-modal');
  var mTitle = document.getElementById('pm-title');
  var mRole = document.getElementById('pm-role');
  var mDesc = document.getElementById('pm-desc');
  var mTech = document.getElementById('pm-tech');
  var mGit = document.getElementById('pm-github');
  var mFull = document.getElementById('pm-full');
  var lastFocus = null;
  function openModal(p) {
    if (!modal) return;
    lastFocus = document.activeElement;
    mTitle.textContent = p.title;
    mRole.textContent = p.role;
    mDesc.textContent = p.desc;
    mTech.innerHTML = p.tech.map(function (t) { return '<span>' + t + '</span>'; }).join('');
    if (p.github) { mGit.href = p.github; mGit.hidden = false; } else { mGit.hidden = true; }
    if (p.github) { mFull.href = p.github; mFull.hidden = false; } else { mFull.hidden = true; }
    modal.hidden = false;
    document.body.style.overflow = 'hidden';
    var x = modal.querySelector('.modal-x');
    if (x) x.focus();
  }
  function closeModal() {
    if (!modal) return;
    modal.hidden = true;
    document.body.style.overflow = '';
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
    });
  }
})();
