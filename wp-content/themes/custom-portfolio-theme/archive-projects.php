<?php
/**
 * The template for displaying projects archive pages
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<section class="page-hero-section">
    <div class="container" style="position:relative;z-index:1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Portfolio', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title"><?php esc_html_e( 'Technical Projects Archive', 'tech-portfolio' ); ?></h1>
        <p class="page-hero-desc">
            <?php esc_html_e( 'A filterable showcase of automated systems, networking simulation scenarios, and micro-device engineering.', 'tech-portfolio' ); ?>
        </p>
    </div>
</section>

<section class="section archive-section">
    <div class="container">
        <p class="screen-reader-text" role="status" id="filter-status" aria-live="polite"></p>
        <?php
        $terms = get_terms( array(
            'taxonomy'   => 'project_category',
            'hide_empty' => true,
        ) );
        
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
            <div class="archive-filters" role="group" aria-label="<?php esc_attr_e( 'Project category filters', 'tech-portfolio' ); ?>">
                <button class="filter-btn active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All Projects', 'tech-portfolio' ); ?></button>
                <?php foreach ( $terms as $term ) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>" aria-pressed="false">
                        <?php echo esc_html( $term->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="projects-grid" id="portfolio-grid">
                <?php while ( have_posts() ) : the_post();
                    $role       = get_post_meta( get_the_ID(), '_project_role', true );
                    $post_terms = get_the_terms( get_the_ID(), 'project_category' );
                    $term_slugs = array();
                    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
                        foreach ( $post_terms as $post_term ) {
                            $term_slugs[] = $post_term->slug;
                        }
                    }
                    get_template_part( 'template-parts/project-card', null, array(
                        'role'       => $role,
                        'term_slugs' => $term_slugs,
                    ) );
                endwhile; ?>
            </div>
        <?php else : ?>
            <div class="empty-state">
                <p style="font-style: italic;">
                    <?php esc_html_e( 'No projects have been published yet. Check back soon.', 'tech-portfolio' ); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
