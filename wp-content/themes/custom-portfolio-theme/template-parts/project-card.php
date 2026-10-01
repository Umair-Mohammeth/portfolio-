<?php
/**
 * Template Part: Project Card
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$role         = isset( $args['role'] ) ? $args['role'] : '';
$term_slugs   = isset( $args['term_slugs'] ) ? $args['term_slugs'] : array();
$delay        = isset( $args['delay'] ) ? $args['delay'] : '';
$class_string = ! empty( $term_slugs ) ? implode( ' ', $term_slugs ) : '';
$data_cats    = ! empty( $term_slugs ) ? esc_attr( implode( ',', $term_slugs ) ) : '';
?>

<article class="project-card reveal <?php echo esc_attr( $class_string . ' ' . $delay ); ?>"
    <?php echo $data_cats ? ' data-categories="' . $data_cats . '"' : ''; ?>
    aria-label="<?php printf( esc_attr__( 'Project: %s', 'tech-portfolio' ), get_the_title() ); ?>">

    <div class="project-card-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'project-card', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
        <?php else : ?>
            <img src="<?php echo esc_url( tech_portfolio_get_project_placeholder( get_the_ID() ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="700" height="440" />
        <?php endif; ?>
        <div class="project-card-overlay" aria-hidden="true"></div>
    </div>

    <div class="project-card-content">
        <span class="project-card-meta">
            <?php echo esc_html( $role ? $role : __( 'Project', 'tech-portfolio' ) ); ?>
        </span>
        <h3 class="project-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="project-card-excerpt">
            <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
        </div>
        <a href="<?php the_permalink(); ?>"
            class="project-card-link"
            aria-label="<?php printf( esc_attr__( 'View details for %s', 'tech-portfolio' ), get_the_title() ); ?>">
            <?php esc_html_e( 'View Details', 'tech-portfolio' ); ?>
        </a>
    </div>
</article>
