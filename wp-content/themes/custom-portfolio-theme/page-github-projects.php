<?php
/**
 * Template Name: GitHub Projects Archive
 *
 * Displays all public GitHub repos for a user, fetched live via API.
 *
 * @package TechPortfolio
 */

get_header(); ?>

<section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 60px;">
    <div class="container">
        <h1 class="hero-title" style="margin-bottom: 16px;"><?php esc_html_e( 'GitHub Projects', 'tech-portfolio' ); ?></h1>
        <p class="hero-description" style="max-width: 700px; font-size: 1.1rem; margin-bottom: 0;">
            <?php esc_html_e( 'Live portfolio of open-source projects, automation tools, and IoT systems fetched directly from GitHub.', 'tech-portfolio' ); ?>
        </p>
    </div>
</section>

<section class="section archive-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <?php echo do_shortcode( '[github_projects]' ); ?>
    </div>
</section>

<?php get_footer(); ?>
