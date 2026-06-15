<?php
/**
 * The template for displaying the home page
 *
 * @package TechPortfolio
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-subtitle"><?php esc_html_e( 'Network & Security Professional', 'tech-portfolio' ); ?></span>
                <h1 class="hero-title">
                    Mohammed Nazar<br>Umair Mohammeth
                </h1>
                <p class="hero-description">
                    <?php esc_html_e( 'Network Administrator, Cisco CCNA Certified Professional, Cybersecurity Enthusiast, and Python Automation Script Developer. Building highly secure, resilient networks and programmatically optimized infrastructure.', 'tech-portfolio' ); ?>
                </p>
                <div class="hero-tags">
                    <span class="hero-tag">CCNA</span>
                    <span class="hero-tag">Cybersecurity</span>
                    <span class="hero-tag">Python</span>
                    <span class="hero-tag">IoT</span>
                    <span class="hero-tag">Networking</span>
                </div>
                <div class="hero-cta">
                    <a href="<?php echo esc_url( home_url( '/experience/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'View Experience', 'tech-portfolio' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-secondary"><?php esc_html_e( 'About Me', 'tech-portfolio' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-secondary"><?php esc_html_e( 'Get In Touch', 'tech-portfolio' ); ?></a>
                </div>
            </div>
            <div class="hero-image">
                <img src="<?php echo esc_url( wp_get_upload_dir()['baseurl'] . '/2026/profile.png' ); ?>" alt="Mohammed Nazar Umair Mohammeth - Professional Photo" style="max-width:380px; width:100%; border-radius:12px;">
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Section -->
<?php $featured_repos = tech_portfolio_fetch_github_repos(); ?>
<section class="section stats-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">2+</span>
                <span class="stat-label"><?php esc_html_e( 'Years Experience', 'tech-portfolio' ); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number">11</span>
                <span class="stat-label"><?php esc_html_e( 'Certifications', 'tech-portfolio' ); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number">3</span>
                <span class="stat-label"><?php esc_html_e( 'Languages', 'tech-portfolio' ); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo count( $featured_repos ?? [] ); ?></span>
                <span class="stat-label"><?php esc_html_e( 'GitHub Repos', 'tech-portfolio' ); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Core Stack Quick-View Section -->
<section class="section core-stack" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'Core Expertise', 'tech-portfolio' ); ?></h2>
        
        <div class="skills-grid">
            <!-- Card 1: Networking Protocols -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'Networking Protocols', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'DHCP, DNS, NAT, VPN, WAN routing, and local switching protocols.', 'tech-portfolio' ); ?></p>
            </div>
            
            <!-- Card 2: Cisco Packet Tracer -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'Cisco Administration', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'Network simulation, router/switch configuration, and secure access lists via Packet Tracer.', 'tech-portfolio' ); ?></p>
            </div>
            
            <!-- Card 3: Hardware & OS -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'Hardware & OS', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'Advanced Windows administration, basic Linux, hardware troubleshooting & MS Office 365.', 'tech-portfolio' ); ?></p>
            </div>
            
            <!-- Card 4: Python Automation -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'Python Scripting', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'Utility scripts, log parsing, and administrative workflow automation.', 'tech-portfolio' ); ?></p>
            </div>

            <!-- Card 5: Cybersecurity -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'Cybersecurity', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'Network defense architectures, system monitoring, and vulnerability assessments.', 'tech-portfolio' ); ?></p>
            </div>

            <!-- Card 6: IoT & Embedded -->
            <div class="skill-card">
                <div class="skill-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="2"/><path d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14"/></svg>
                </div>
                <h3 class="skill-title"><?php esc_html_e( 'IoT & Embedded', 'tech-portfolio' ); ?></h3>
                <p class="skill-desc"><?php esc_html_e( 'ESP32-CAM, RFID systems, Telegram Bot integration, and smart device automation.', 'tech-portfolio' ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Project Highlight (Dynamic from GitHub) -->
<?php
$featured_repo  = ! empty( $featured_repos ) ? $featured_repos[0] : null;
?>
<section class="section featured-project" style="background-color: rgba(255,255,255,0.01); border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'Featured Project', 'tech-portfolio' ); ?></h2>
        
        <?php if ( $featured_repo ) :
            $repo_name        = $featured_repo['name'] ?? '';
            $repo_description = $featured_repo['description'] ?? '';
            $repo_language    = $featured_repo['language'] ?? '';
            $repo_url         = $featured_repo['html_url'] ?? '#';
            $repo_stars       = $featured_repo['stargazers_count'] ?? 0;
            $repo_updated     = isset( $featured_repo['pushed_at'] ) ? human_time_diff( strtotime( $featured_repo['pushed_at'] ), current_time( 'timestamp' ) ) . ' ago' : '';
        ?>
        <div class="featured-project-card">
            <div class="featured-project-content">
                <span class="featured-project-meta"><?php echo esc_html( $repo_language ? $repo_language : 'Latest Project' ); ?></span>
                <h3 class="featured-project-title">
                    <a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" style="color:inherit;"><?php echo esc_html( $repo_name ); ?></a>
                </h3>
                <p class="featured-project-desc">
                    <?php echo esc_html( $repo_description ? $repo_description : 'No description provided.' ); ?>
                </p>
                <div style="display:flex; gap:16px; align-items:center; margin-bottom:24px; font-size:0.9rem; color:var(--text-gray); font-family:var(--font-mono);">
                    <span>&#9733; <?php echo intval( $repo_stars ); ?> stars</span>
                    <span>&#9679; Updated <?php echo esc_html( $repo_updated ); ?></span>
                </div>
                <a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary"><?php esc_html_e( 'View on GitHub', 'tech-portfolio' ); ?></a>
            </div>
        </div>
        <?php else : ?>
        <p style="color: var(--text-gray); font-style: italic;"><?php esc_html_e( 'No featured project available at this time.', 'tech-portfolio' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- GitHub Projects Section -->
<section class="section github-projects-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'GitHub Projects', 'tech-portfolio' ); ?></h2>
        <p style="text-align: center; color: var(--text-gray); margin-bottom: 40px;"><?php esc_html_e( 'Live portfolio of open-source projects fetched directly from GitHub.', 'tech-portfolio' ); ?></p>
        <?php echo do_shortcode( '[github_projects count="6"]' ); ?>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url( home_url( '/github-projects/' ) ); ?>" class="btn btn-secondary"><?php esc_html_e( 'View All Projects', 'tech-portfolio' ); ?></a>
        </div>
    </div>
</section>

<!-- Languages Section -->
<section class="section languages-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title"><?php esc_html_e( 'Languages', 'tech-portfolio' ); ?></h2>
        
        <div class="languages-grid">
            <div class="language-card">
                <div class="language-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <h3 class="language-name"><?php esc_html_e( 'Tamil', 'tech-portfolio' ); ?></h3>
                <span class="language-level"><?php esc_html_e( 'Full Professional', 'tech-portfolio' ); ?></span>
            </div>
            
            <div class="language-card">
                <div class="language-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <h3 class="language-name"><?php esc_html_e( 'Sinhala', 'tech-portfolio' ); ?></h3>
                <span class="language-level"><?php esc_html_e( 'Professional Working', 'tech-portfolio' ); ?></span>
            </div>
            
            <div class="language-card">
                <div class="language-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <h3 class="language-name"><?php esc_html_e( 'English', 'tech-portfolio' ); ?></h3>
                <span class="language-level"><?php esc_html_e( 'Limited Working', 'tech-portfolio' ); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="section contact-cta" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); border-top: 1px solid var(--border-gray);">
    <div class="container">
        <div class="contact-cta-content">
            <h2 class="section-title"><?php esc_html_e( "Let's Connect", 'tech-portfolio' ); ?></h2>
            <p class="contact-cta-text">
                <?php esc_html_e( 'Open to opportunities in network administration, cybersecurity, and IoT development. Based in Kandy, Sri Lanka.', 'tech-portfolio' ); ?>
            </p>
            <div class="contact-info-row">
                <div class="contact-info-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span>mohammednazarumairmohammeth@gmail.com</span>
                </div>
                <div class="contact-info-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>+94 721 658 204</span>
                </div>
                <div class="contact-info-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Kandy, Sri Lanka</span>
                </div>
            </div>
            <div class="hero-cta" style="margin-top: 32px;">
                <a href="mailto:mohammednazarumairmohammeth@gmail.com" class="btn btn-primary"><?php esc_html_e( 'Send Email', 'tech-portfolio' ); ?></a>
                <a href="tel:+94721658204" class="btn btn-secondary"><?php esc_html_e( 'Call Now', 'tech-portfolio' ); ?></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>