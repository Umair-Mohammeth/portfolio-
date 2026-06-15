<?php
/**
 * Template Name: Experience Timeline Page
 *
 * @package TechPortfolio
 */

get_header(); ?>

<section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 60px;">
    <div class="container">
        <h1 class="hero-title" style="margin-bottom: 16px;"><?php esc_html_e( 'Professional Experience', 'tech-portfolio' ); ?></h1>
        <p class="hero-description" style="max-width: 700px; font-size: 1.1rem; margin-bottom: 0;">
            A history of technical execution in server administration, hardware diagnostics, and local area network orchestration.
        </p>
    </div>
</section>

<!-- Experience Timeline Section -->
<section class="section experience-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <div class="timeline">
            <!-- Experience Item 1 -->
            <div class="timeline-item">
                <span class="timeline-date"><?php esc_html_e( 'October 2025 – Present', 'tech-portfolio' ); ?></span>
                <h3 class="timeline-title"><?php esc_html_e( 'IT Trainee (Network and Cyber Security)', 'tech-portfolio' ); ?></h3>
                <h4 class="timeline-subtitle" style="color: var(--accent-gold);"><?php esc_html_e( 'Kandy Municipal Council', 'tech-portfolio' ); ?></h4>
                <div class="timeline-desc">
                    <p><?php esc_html_e( 'Providing operational technical support and configuring localized networking equipment to maintain council administration continuity.', 'tech-portfolio' ); ?></p>
                    <ul>
                        <li><?php esc_html_e( 'Perform proactive computer maintenance and basic physical hardware servicing.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Assist with network cabling installations and local networking hardware setups.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Troubleshoot critical workstation hardware faults and operating system conflicts.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Provide direct desktop and network technical support to department staff for daily IT issues.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Deploy, maintain, and monitor localized computer systems and connected peripherals.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Support data entry systems and manage basic internal system updates.', 'tech-portfolio' ); ?></li>
                    </ul>
                </div>
            </div>
            
            <!-- Experience Item 2 -->
            <div class="timeline-item">
                <span class="timeline-date"><?php esc_html_e( 'January 2023 – September 2023', 'tech-portfolio' ); ?></span>
                <h3 class="timeline-title"><?php esc_html_e( 'Volunteer', 'tech-portfolio' ); ?></h3>
                <h4 class="timeline-subtitle" style="color: var(--accent-gold);"><?php esc_html_e( 'National Institute of Fundamental Studies (NIFS) - Kandy', 'tech-portfolio' ); ?></h4>
                <div class="timeline-desc">
                    <p><?php esc_html_e( 'Supported technical workflows, inventory tracking systems, and workshop logistical setups within the computer science division.', 'tech-portfolio' ); ?></p>
                    <ul>
                        <li><?php esc_html_e( 'Identified and assisted in resolving localized hardware failures and local network connection issues.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Supported the inventory registration project for tracking internal computer and networking hardware assets.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Coordinated logistics and technological setup for computer science research workshops.', 'tech-portfolio' ); ?></li>
                        <li><?php esc_html_e( 'Served as an active member of the workshop organizing committee and the pre-webinar planning group for the Young Scientists Association (YSA).', 'tech-portfolio' ); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
