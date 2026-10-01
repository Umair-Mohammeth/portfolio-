<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<section class="error-page">
    <div class="container">
        <div class="error-card reveal visible">
            <div class="eyebrow" style="justify-content:center; margin-bottom:16px;"><?php esc_html_e( 'Error 404', 'tech-portfolio' ); ?></div>
            <div class="error-code" aria-hidden="true">404</div>
            <h1 class="page-hero-title" style="font-size: clamp(1.8rem, 4vw, 2.6rem);"><?php esc_html_e( 'Page Not Found', 'tech-portfolio' ); ?></h1>
            <p class="page-hero-desc" style="margin: 0 auto 32px; text-align:center;">
                <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'tech-portfolio' ); ?>
            </p>
            <div class="hero-cta" style="justify-content: center; opacity:1; animation:none;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Back to Home', 'tech-portfolio' ); ?></a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="btn btn-secondary"><?php esc_html_e( 'Browse Projects', 'tech-portfolio' ); ?></a>
            </div>
            <div style="margin-top:32px; display:flex; justify-content:center;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
