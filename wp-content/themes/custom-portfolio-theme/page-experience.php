<?php
/**
 * Template Name: Experience Timeline Page
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Page Hero -->
<section class="page-hero-section" aria-labelledby="experience-page-title">
    <div class="container" style="position: relative; z-index: 1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Professional History', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title" id="experience-page-title"><?php esc_html_e( 'Work Experience', 'tech-portfolio' ); ?></h1>
        <p class="page-hero-desc">
            <?php esc_html_e( 'A history of technical execution in server administration, hardware diagnostics, and local area network orchestration.', 'tech-portfolio' ); ?>
        </p>
    </div>
</section>

<!-- Editable Page Content -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php if ( get_the_content() ) : ?>
        <section class="section page-content-section">
            <div class="container">
                <div class="page-content-body" style="max-width: 800px; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endwhile; endif; ?>
<?php rewind_posts(); ?>

<!-- Experience Grid -->
<section class="section experience-section" aria-labelledby="experience-title">
    <div class="container">
        <h2 class="section-title reveal" id="experience-title" data-index="01"><?php esc_html_e( 'Work Experience', 'tech-portfolio' ); ?></h2>

        <div class="skills-grid">
            <?php
            $experience = array(
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                    'title' => __( 'IT Trainee — Network & Cyber Security', 'tech-portfolio' ),
                    'subtitle' => __( 'Kandy Municipal Council', 'tech-portfolio' ),
                    'desc'  => __( 'Proactive maintenance of 200+ workstations/servers, network cabling (Cat6/fiber), switch/AP configuration, hardware troubleshooting, user support for 150+ staff, asset tracking for 500+ IT assets. Reduced downtime 40%.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    'title' => __( 'Volunteer — IT & Workshop Support', 'tech-portfolio' ),
                    'subtitle' => __( 'National Institute of Fundamental Studies (NIFS), Kandy', 'tech-portfolio' ),
                    'desc'  => __( 'Hardware diagnostics, network troubleshooting, asset tracking for 300+ assets, workshop coordination for 12+ research events (50-100 attendees each), YSA organizing committee member. Streamlined asset tracking by 60%.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-2',
                ),
            );

            foreach ( $experience as $exp ) :
            ?>
                <div class="skill-card reveal <?php echo esc_attr( $exp['delay'] ); ?>">
                    <div class="skill-icon" aria-hidden="true"><?php echo $exp['icon']; // Already escaped SVG ?></div>
                    <h3 class="skill-title"><?php echo esc_html( $exp['title'] ); ?></h3>
                    <p class="skill-subtitle" style="color: var(--gold); font-size: 0.85rem; font-weight: 500; margin-bottom: 8px;"><?php echo esc_html( $exp['subtitle'] ); ?></p>
                    <p class="skill-desc"><?php echo esc_html( $exp['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Skills Snapshot Section -->
<section class="section" aria-labelledby="skills-snapshot-title">
    <div class="container">
        <h2 class="section-title reveal" id="skills-snapshot-title" data-index="02"><?php esc_html_e( 'Technical Toolkit', 'tech-portfolio' ); ?></h2>

        <div style="display: flex; flex-wrap: wrap; gap: 10px; max-width: 760px;" class="reveal">
            <?php
            $tools = array(
                'Cisco Packet Tracer', 'DHCP / DNS / NAT', 'VPN Configuration',
                'Windows Server', 'Linux CLI', 'Python Scripting',
                'Network Cabling', 'Hardware Diagnostics', 'MS Office 365',
                'Google Workspace', 'LAN / WAN', 'Firewall Rules',
                'IoT (ESP32)', 'RFID Systems', 'TCP/IP Stack',
            );
            foreach ( $tools as $tool ) : ?>
                <span class="tech-badge" style="border-radius: 6px; font-size: 0.78rem;"><?php echo esc_html( $tool ); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
