<?php
/**
 * The template for displaying all pages (generic fallback)
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<section class="page-hero-section">
    <div class="container" style="position:relative;z-index:1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Page', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title"><?php echo esc_html( get_the_title() ); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <p class="page-hero-desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <div class="project-main-content">
            <div class="project-content-body">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>
