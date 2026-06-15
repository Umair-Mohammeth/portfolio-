<?php
/**
 * Template Name: About & Credentials Page
 *
 * @package TechPortfolio
 */

get_header(); ?>

<section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 60px;">
    <div class="container">
        <div class="about-hero-grid">
            <div class="about-hero-content">
                <h1 class="hero-title" style="margin-bottom: 16px;"><?php esc_html_e( 'About & Credentials', 'tech-portfolio' ); ?></h1>
                <p class="hero-description" style="max-width: 700px; font-size: 1.1rem; margin-bottom: 0;">
                    <?php esc_html_e( 'A detailed catalog of academic qualifications, certified network competencies, and specialized engineering training.', 'tech-portfolio' ); ?>
                </p>
            </div>
            <div class="about-hero-image">
                <img src="<?php echo esc_url( wp_get_upload_dir()['baseurl'] . '/2026/graduation-photo.png' ); ?>" alt="Umair Graduation Portrait" style="max-width:360px; width:100%; border-radius:12px; display:block; border:2px solid var(--border-gold); box-shadow:var(--gold-glow);">
            </div>
        </div>
    </div>
</section>

<!-- Education Timeline Section -->
<section class="section education-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'Education Timeline', 'tech-portfolio' ); ?></h2>
        
        <div class="timeline">
            <!-- Education 1 -->
            <div class="timeline-item">
                <span class="timeline-date"><?php esc_html_e( 'March 2026 – Present', 'tech-portfolio' ); ?></span>
                <h3 class="timeline-title"><?php esc_html_e( 'BEng (Hons) Computer Networking and Cloud Security', 'tech-portfolio' ); ?></h3>
                <h4 class="timeline-subtitle"><?php esc_html_e( 'ESU Kandy (Affiliated with London Metropolitan University, UK)', 'tech-portfolio' ); ?></h4>
                <div class="timeline-desc">
                    <p><?php esc_html_e( 'Focusing on advanced cloud security frameworks, enterprise routing architectures, virtualization, and vulnerability assessments.', 'tech-portfolio' ); ?></p>
                </div>
            </div>
            
            <!-- Education 2 -->
            <div class="timeline-item">
                <span class="timeline-date"><?php esc_html_e( 'November 2024 – December 2025', 'tech-portfolio' ); ?></span>
                <h3 class="timeline-title"><?php esc_html_e( 'Higher Diploma (HD) in Network Technology and Cybersecurity', 'tech-portfolio' ); ?></h3>
                <h4 class="timeline-subtitle"><?php esc_html_e( 'ICBT Kandy (Affiliated with Cardiff Metropolitan University, UK) — Merit Pass', 'tech-portfolio' ); ?></h4>
                <div class="timeline-desc">
                    <p><?php esc_html_e( 'Comprehensive study of infrastructure switching, defense architectures, system monitoring, and network configuration principles.', 'tech-portfolio' ); ?></p>
                </div>
            </div>
            
            <!-- Education 3 -->
            <div class="timeline-item">
                <span class="timeline-date"><?php esc_html_e( '2022', 'tech-portfolio' ); ?></span>
                <h3 class="timeline-title"><?php esc_html_e( 'Fullstack Web Development', 'tech-portfolio' ); ?></h3>
                <h4 class="timeline-subtitle"><?php esc_html_e( 'University of Moratuwa (Online)', 'tech-portfolio' ); ?></h4>
                <div class="timeline-desc">
                    <p><?php esc_html_e( 'Learned fundamental front-end and back-end web frameworks, database administration, and application deployment strategies.', 'tech-portfolio' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certifications Grid Section -->
<section class="section certifications-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'Professional Certifications', 'tech-portfolio' ); ?></h2>
        
        <div class="certs-grid">
            <!-- Cert 1: CCNA -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Cisco Certified Network Associate (CCNA)</h3>
                    <p>Cisco Systems</p>
                </div>
            </div>
            
            <!-- Cert 2: Network Support & Security -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Network Support & Security</h3>
                    <p>Cisco Systems</p>
                </div>
            </div>
            
            <!-- Cert 3: Network Basics -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9.09 9 1.24 3h2.33l1.24-3"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Network Basics</h3>
                    <p>Cisco Systems</p>
                </div>
            </div>

            <!-- Cert 4: OS & Hardware -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Operating Systems & Hardware</h3>
                    <p>Cisco Systems</p>
                </div>
            </div>

            <!-- Cert 5: Packet Tracer -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Introduction to Packet Tracer</h3>
                    <p>Cisco Systems</p>
                </div>
            </div>

            <!-- Cert 6: Python Fundamentals -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Python Fundamentals for Researchers</h3>
                    <p>National Institute of Fundamental Studies (NIFS)</p>
                </div>
            </div>
            
            <!-- Cert 7: Prompt Engineering -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Prompt Engineering Professional</h3>
                    <p>DeepLearning.AI</p>
                </div>
            </div>

            <!-- Cert 8: NIBM CS -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Certificate in Computer Science</h3>
                    <p>National Institute of Business Management (NIBM)</p>
                </div>
            </div>

            <!-- Cert 9: Gmail & Google Sheets -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Gmail & Google Sheets Productivity</h3>
                    <p>Udemy</p>
                </div>
            </div>

            <!-- Cert 10: English Diploma -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Diploma in English</h3>
                    <p>Institute of English</p>
                </div>
            </div>
            
            <!-- Cert 11: Skill Development -->
            <div class="cert-card">
                <div class="cert-badge">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="cert-info">
                    <h3>Diploma in Skill Development</h3>
                    <p>CSDS Sri Lanka</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>