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

<!-- Experience Timeline -->
<section class="section experience-section" aria-labelledby="experience-title">
    <div class="container">
        <h2 class="section-title reveal" id="experience-title" data-index="01"><?php esc_html_e( 'Career Timeline', 'tech-portfolio' ); ?></h2>

        <div class="timeline">

            <!-- Current Role -->
            <div class="timeline-item">
                <div class="timeline-card">
                    <span class="timeline-date"><?php esc_html_e( 'October 2025 – Present', 'tech-portfolio' ); ?></span>
                    <h3 class="timeline-title"><?php esc_html_e( 'IT Trainee — Network & Cyber Security', 'tech-portfolio' ); ?></h3>
                    <h4 class="timeline-subtitle"><?php esc_html_e( 'Kandy Municipal Council', 'tech-portfolio' ); ?></h4>
                    <div class="timeline-desc">
                        <p><?php esc_html_e( 'Providing operational technical support and configuring localized networking equipment to maintain council administration continuity.', 'tech-portfolio' ); ?></p>
                        <ul>
                            <li><?php esc_html_e( 'Perform proactive computer maintenance and physical hardware servicing.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Assist with network cabling installations and local networking hardware setups.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Troubleshoot critical workstation hardware faults and OS conflicts.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Provide direct desktop and network technical support to department staff.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Deploy, maintain, and monitor localized computer systems and connected peripherals.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Support data entry systems and manage basic internal system updates.', 'tech-portfolio' ); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Volunteer Role -->
            <div class="timeline-item">
                <div class="timeline-card">
                    <span class="timeline-date"><?php esc_html_e( 'January 2023 – September 2023', 'tech-portfolio' ); ?></span>
                    <h3 class="timeline-title"><?php esc_html_e( 'Volunteer — IT & Workshop Support', 'tech-portfolio' ); ?></h3>
                    <h4 class="timeline-subtitle"><?php esc_html_e( 'National Institute of Fundamental Studies (NIFS), Kandy', 'tech-portfolio' ); ?></h4>
                    <div class="timeline-desc">
                        <p><?php esc_html_e( 'Supported technical workflows, inventory tracking systems, and workshop logistical setups within the computer science division.', 'tech-portfolio' ); ?></p>
                        <ul>
                            <li><?php esc_html_e( 'Identified and assisted in resolving hardware failures and local network issues.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Supported inventory registration for tracking internal hardware assets.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Coordinated logistics and setup for computer science research workshops.', 'tech-portfolio' ); ?></li>
                            <li><?php esc_html_e( 'Active member of the Young Scientists Association (YSA) organizing committee.', 'tech-portfolio' ); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div><!-- .timeline -->
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
