<?php
/**
 * The template for displaying search results
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<section class="page-hero-section">
    <div class="container" style="position:relative;z-index:1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Search', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title">
            <?php
            printf(
                esc_html__( 'Search Results for: %s', 'tech-portfolio' ),
                '<span style="color: var(--gold);">' . esc_html( get_search_query() ) . '</span>'
            );
            ?>
        </h1>
        <p class="page-hero-desc">
            <?php
            $found = absint( get_query_var( 'found_posts' ) );
            printf(
                esc_html( _n( '%d result found.', '%d results found.', $found, 'tech-portfolio' ) ),
                esc_html( (string) $found )
            );
            ?>
        </p>
    </div>
</section>

<section class="section archive-section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="projects-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="project-card reveal">
                        <div class="project-card-content">
                            <span class="project-card-meta">
                                <?php echo esc_html( get_the_date() ); ?>
                                <span style="margin: 0 8px; color: var(--border);" aria-hidden="true">|</span>
                                <?php
                                $pt_obj = get_post_type_object( get_post_type() );
                                echo $pt_obj ? esc_html( $pt_obj->labels->singular_name ) : esc_html__( 'Post', 'tech-portfolio' );
                                ?>
                            </span>
                            <h3 class="project-card-title">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                            </h3>
                            <div class="project-card-excerpt">
                                <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 25 ) ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="project-card-link"><?php esc_html_e( 'View Details', 'tech-portfolio' ); ?></a>
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
                    <?php esc_html_e( 'No results found. Try a different search term.', 'tech-portfolio' ); ?>
                </p>
                <div style="margin-top: 24px; display:flex; justify-content:center;">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
