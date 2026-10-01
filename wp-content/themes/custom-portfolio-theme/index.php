<?php
/**
 * The main template file fallback
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<section class="page-hero-section">
    <div class="container" style="position:relative;z-index:1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Journal', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
        <p class="page-hero-desc"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
    </div>
</section>

<section class="section fallback-content">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="projects-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="project-card reveal">
                        <div class="project-card-content">
                            <span class="project-card-meta"><?php echo esc_html( get_the_date() ); ?></span>
                            <h3 class="project-card-title">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                            </h3>
                            <div class="project-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="project-card-link"><?php esc_html_e( 'Read More', 'tech-portfolio' ); ?></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-links">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="empty-state">
                <p style="font-style: italic;">
                    <?php esc_html_e( 'No posts found.', 'tech-portfolio' ); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
