/* ═══════════════════════════════════════════════════
   UMAIR PORTFOLIO — JavaScript Engine
   Features:
   • Custom cursor tracking
   • Page loader with progress
   • Navbar scroll behavior
   • Typewriter effect
   • Particle canvas background
   • Scroll-triggered animations (IntersectionObserver)
   • Skill bar counter animations
   • Number counter animation
   • Mobile navigation
   • Contact form handler
   ═══════════════════════════════════════════════════ */

'use strict';

// ─── DOM READY ────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  initLoader();
  initCursor();
  initNavbar();
  initTypewriter();
  initParticleCanvas();
  initScrollAnimations();
  initCounters();
  initMobileNav();
});

// ════════════════════════════════════════════════
// 1. LOADER
// ════════════════════════════════════════════════
function initLoader() {
  const loader = document.getElementById('loader');
  const progress = document.getElementById('loader-progress');
  if (!loader || !progress) return;

  let pct = 0;
  const interval = setInterval(() => {
    pct += Math.random() * 18 + 5;
    if (pct >= 100) {
      pct = 100;
      clearInterval(interval);
      setTimeout(() => {
        loader.classList.add('hidden');
        triggerHeroEntrance();
      }, 300);
    }
    progress.style.width = Math.min(pct, 100) + '%';
  }, 80);
}

function triggerHeroEntrance() {
  const heroItems = document.querySelectorAll('.hero [data-animate]');
  heroItems.forEach((el, i) => {
    setTimeout(() => {
      el.classList.add('is-visible');
    }, i * 200);
  });
}

// ════════════════════════════════════════════════
// 2. CUSTOM CURSOR
// ════════════════════════════════════════════════
function initCursor() {
  const cursor = document.getElementById('cursor');
  const follower = document.getElementById('cursor-follower');
  if (!cursor || !follower) return;

  let mouseX = 0, mouseY = 0;
  let followerX = 0, followerY = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    cursor.style.left = mouseX + 'px';
    cursor.style.top = mouseY + 'px';
  });

  // Smooth follower with lerp
  function animateCursor() {
    followerX += (mouseX - followerX) * 0.12;
    followerY += (mouseY - followerY) * 0.12;
    follower.style.left = followerX + 'px';
    follower.style.top = followerY + 'px';
    requestAnimationFrame(animateCursor);
  }
  animateCursor();

  // Scale on interactive elements
  const interactives = document.querySelectorAll('a, button, input, textarea, .cert-card, .glass-card');
  interactives.forEach(el => {
    el.addEventListener('mouseenter', () => {
      cursor.style.transform = 'translate(-50%, -50%) scale(1.8)';
      follower.style.transform = 'translate(-50%, -50%) scale(1.5)';
      follower.style.borderColor = 'rgba(201, 168, 76, 0.8)';
    });
    el.addEventListener('mouseleave', () => {
      cursor.style.transform = 'translate(-50%, -50%) scale(1)';
      follower.style.transform = 'translate(-50%, -50%) scale(1)';
      follower.style.borderColor = 'rgba(201, 168, 76, 0.5)';
    });
  });
}

// ════════════════════════════════════════════════
// 3. NAVBAR
// ════════════════════════════════════════════════
function initNavbar() {
  const navbar = document.getElementById('navbar');
  if (!navbar) return;

  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    if (scrollY > 60) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
    lastScroll = scrollY;
  }, { passive: true });

  // Active section highlight
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');
  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(sec => {
      if (window.scrollY >= sec.offsetTop - 120) current = sec.id;
    });
    navLinks.forEach(link => {
      link.classList.remove('nav-link--active');
      if (link.getAttribute('href') === '#' + current) link.classList.add('nav-link--active');
    });
  }, { passive: true });
}

// ════════════════════════════════════════════════
// 4. MOBILE NAV
// ════════════════════════════════════════════════
function initMobileNav() {
  const toggle = document.getElementById('nav-toggle');
  const navLinks = document.getElementById('nav-links');
  if (!toggle || !navLinks) return;

  toggle.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    toggle.setAttribute('aria-expanded', isOpen);
    // Animate hamburger to X
    const spans = toggle.querySelectorAll('span');
    if (isOpen) {
      spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
      spans[1].style.opacity = '0';
      spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
    } else {
      spans[0].style.transform = '';
      spans[1].style.opacity = '';
      spans[2].style.transform = '';
    }
  });

  // Close on link click
  navLinks.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      navLinks.classList.remove('open');
      const spans = toggle.querySelectorAll('span');
      spans[0].style.transform = '';
      spans[1].style.opacity = '';
      spans[2].style.transform = '';
    });
  });
}

// ════════════════════════════════════════════════
// 5. TYPEWRITER EFFECT
// ════════════════════════════════════════════════
function initTypewriter() {
  const target = document.getElementById('typed-text');
  if (!target) return;

  const roles = [
    'Network Administrator',
    'CCNA Certified Engineer',
    'Cybersecurity Enthusiast',
    'Python Developer',
    'IoT Systems Builder',
    'IT Support Specialist'
  ];

  let roleIdx = 0;
  let charIdx = 0;
  let isDeleting = false;
  let delay = 120;

  function type() {
    const current = roles[roleIdx];
    if (isDeleting) {
      target.textContent = current.substring(0, charIdx - 1);
      charIdx--;
      delay = 60;
    } else {
      target.textContent = current.substring(0, charIdx + 1);
      charIdx++;
      delay = 120;
    }

    if (!isDeleting && charIdx === current.length) {
      isDeleting = true;
      delay = 1800; // Pause at end
    } else if (isDeleting && charIdx === 0) {
      isDeleting = false;
      roleIdx = (roleIdx + 1) % roles.length;
      delay = 400;
    }

    setTimeout(type, delay);
  }

  setTimeout(type, 1200);
}

// ════════════════════════════════════════════════
// 6. PARTICLE CANVAS
// ════════════════════════════════════════════════
function initParticleCanvas() {
  const canvas = document.getElementById('hero-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let W, H, particles;

  function resize() {
    W = canvas.width = canvas.offsetWidth;
    H = canvas.height = canvas.offsetHeight;
  }

  class Particle {
    constructor() { this.reset(); }
    reset() {
      this.x = Math.random() * W;
      this.y = Math.random() * H;
      this.size = Math.random() * 1.5 + 0.5;
      this.vx = (Math.random() - 0.5) * 0.3;
      this.vy = (Math.random() - 0.5) * 0.3 - 0.1;
      this.alpha = Math.random() * 0.5 + 0.1;
      this.life = Math.random() * 200 + 100;
      this.maxLife = this.life;
      // Gold or blue tint
      this.color = Math.random() > 0.6
        ? `rgba(201, 168, 76, ${this.alpha})`
        : `rgba(79, 142, 247, ${this.alpha * 0.4})`;
    }
    update() {
      this.x += this.vx;
      this.y += this.vy;
      this.life--;
      if (this.life <= 0 || this.x < 0 || this.x > W || this.y < 0 || this.y > H) {
        this.reset();
        this.x = Math.random() * W;
        this.y = H + 10;
      }
    }
    draw() {
      const fade = this.life / this.maxLife;
      ctx.save();
      ctx.globalAlpha = fade * this.alpha;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
  }

  function init() {
    resize();
    const count = Math.min(Math.floor(W * H / 6000), 150);
    particles = Array.from({ length: count }, () => new Particle());
  }

  // Connect nearby particles with faint lines
  function connectParticles() {
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 100) {
          ctx.save();
          ctx.globalAlpha = (1 - dist / 100) * 0.08;
          ctx.strokeStyle = 'rgba(201, 168, 76, 0.6)';
          ctx.lineWidth = 0.5;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.stroke();
          ctx.restore();
        }
      }
    }
  }

  function animate() {
    ctx.clearRect(0, 0, W, H);
    particles.forEach(p => { p.update(); p.draw(); });
    connectParticles();
    requestAnimationFrame(animate);
  }

  window.addEventListener('resize', () => { init(); }, { passive: true });
  init();
  animate();
}

// ════════════════════════════════════════════════
// 7. SCROLL ANIMATIONS (IntersectionObserver)
// ════════════════════════════════════════════════
function initScrollAnimations() {
  const elements = document.querySelectorAll('[data-animate]:not(.hero [data-animate])');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = entry.target.dataset.delay ? parseInt(entry.target.dataset.delay) : 0;
        setTimeout(() => {
          entry.target.classList.add('is-visible');
          // Trigger skill bars when skill section visible
          if (entry.target.classList.contains('skill-category')) {
            animateSkillBars(entry.target);
          }
        }, delay);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

  elements.forEach(el => observer.observe(el));
}

// ════════════════════════════════════════════════
// 8. SKILL BARS
// ════════════════════════════════════════════════
function animateSkillBars(container) {
  const bars = container.querySelectorAll('.skill-bar-fill[data-pct]');
  bars.forEach((bar, i) => {
    setTimeout(() => {
      bar.style.width = bar.dataset.pct + '%';
    }, i * 120);
  });
}

// ════════════════════════════════════════════════
// 9. COUNTER ANIMATION
// ════════════════════════════════════════════════
function initCounters() {
  const counters = document.querySelectorAll('[data-count]');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(el => counterObserver.observe(el));
}

function animateCounter(el) {
  const target = parseInt(el.dataset.count);
  const duration = 1500;
  const step = duration / target;
  let current = 0;
  const timer = setInterval(() => {
    current++;
    el.textContent = current;
    if (current >= target) clearInterval(timer);
  }, step);
}

// ════════════════════════════════════════════════
// 10. CONTACT FORM
// ════════════════════════════════════════════════
function handleFormSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const btn = document.getElementById('submit-btn');
  const btnText = document.getElementById('btn-text');

  // Simulate submission (no backend)
  btn.disabled = true;
  btnText.textContent = 'Sending...';

  setTimeout(() => {
    // Replace form with success message
    form.innerHTML = `
      <div class="form-success">
        <div class="form-success-icon">✅</div>
        <h4>Message Sent!</h4>
        <p>Thank you for reaching out. Umair will get back to you soon.</p>
      </div>
    `;
  }, 1500);
}

// ════════════════════════════════════════════════
// 11. SMOOTH SCROLL ENHANCEMENT
// ════════════════════════════════════════════════
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// ════════════════════════════════════════════════
// 12. PARALLAX GLOW EFFECT ON MOUSE MOVE
// ════════════════════════════════════════════════
const hero = document.querySelector('.hero');
if (hero) {
  hero.addEventListener('mousemove', (e) => {
    const rect = hero.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width - 0.5) * 30;
    const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;
    const glow1 = document.querySelector('.glow-1');
    const glow2 = document.querySelector('.glow-2');
    if (glow1) glow1.style.transform = `translate(${x * 0.6}px, ${y * 0.6}px)`;
    if (glow2) glow2.style.transform = `translate(${-x * 0.4}px, ${-y * 0.4}px)`;
  }, { passive: true });
}

// ════════════════════════════════════════════════
// 13. SCROLL HINT FADE
// ════════════════════════════════════════════════
const scrollHint = document.getElementById('scroll-hint');
if (scrollHint) {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
      scrollHint.style.opacity = '0';
      scrollHint.style.pointerEvents = 'none';
    } else {
      scrollHint.style.opacity = '';
      scrollHint.style.pointerEvents = '';
    }
  }, { passive: true });
}

// ════════════════════════════════════════════════
// 14. CERT CARD RIPPLE EFFECT
// ════════════════════════════════════════════════
document.querySelectorAll('.cert-card, .edu-card').forEach(card => {
  card.addEventListener('mouseenter', function() {
    this.style.transition = 'all 0.35s cubic-bezier(0.4, 0, 0.2, 1)';
  });
});

// ════════════════════════════════════════════════
// 15. SUBTLE SCROLL PROGRESS INDICATOR
// ════════════════════════════════════════════════
function createProgressBar() {
  const bar = document.createElement('div');
  bar.id = 'scroll-progress';
  bar.style.cssText = `
    position: fixed;
    top: 0; left: 0;
    height: 2px;
    width: 0%;
    background: linear-gradient(90deg, #F0D060, #C9A84C, #A8862D);
    z-index: 9999;
    transition: width 0.1s linear;
    pointer-events: none;
  `;
  document.body.appendChild(bar);

  window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    bar.style.width = ((scrollTop / docHeight) * 100) + '%';
  }, { passive: true });
}
createProgressBar();
