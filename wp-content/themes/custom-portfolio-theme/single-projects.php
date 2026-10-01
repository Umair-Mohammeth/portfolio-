<?php
/**
 * The template for displaying a single project post
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<?php
while ( have_posts() ) :
    the_post();

    $project_role       = get_post_meta( get_the_ID(), '_project_role', true );
    $project_tech_stack = get_post_meta( get_the_ID(), '_project_tech_stack', true );
    $project_github     = get_post_meta( get_the_ID(), '_project_github_url', true );
    $project_live       = get_post_meta( get_the_ID(), '_project_live_url', true );
    ?>

    <section class="project-single-hero">
        <div class="container" style="position:relative;z-index:1;">
            <div class="page-hero-tag"><?php esc_html_e( 'Case Study', 'tech-portfolio' ); ?></div>
            <h1 class="page-hero-title"><?php echo esc_html( get_the_title() ); ?></h1>
            <?php if ( ! empty( $project_role ) ) : ?>
                <p class="page-hero-desc">
                    <strong><?php esc_html_e( 'Role / Scope:', 'tech-portfolio' ); ?></strong>
                    <?php echo esc_html( $project_role ); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section project-detail-section" style="padding-top: 40px;">
        <div class="container">
            <div class="project-single-container">
                
                <main class="project-main-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="project-featured-image">
                            <?php the_post_thumbnail( 'project-hero', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="project-content-body">
                        <?php the_content(); ?>
                    </div>

                    <nav class="project-nav" aria-label="<?php esc_attr_e( 'Project navigation', 'tech-portfolio' ); ?>">
                        <div><?php previous_post_link( '%link', '<span>&larr; ' . esc_html__( 'Previous', 'tech-portfolio' ) . '</span>%title' ); ?></div>
                        <div style="text-align:right;"><?php next_post_link( '%link', '<span>' . esc_html__( 'Next', 'tech-portfolio' ) . ' &rarr;</span>%title' ); ?></div>
                    </nav>
                </main>

                <aside class="project-sidebar" aria-label="<?php esc_attr_e( 'Project Details Sidebar', 'tech-portfolio' ); ?>">
                    
                    <?php if ( ! empty( $project_tech_stack ) ) : ?>
                        <div class="project-sidebar-widget">
                            <h3 class="widget-title"><?php esc_html_e( 'Technologies Used', 'tech-portfolio' ); ?></h3>
                            <div class="badge-grid">
                                <?php
                                $badges = explode( ',', $project_tech_stack );
                                foreach ( $badges as $badge ) {
                                    $trimmed_badge = trim( $badge );
                                    if ( ! empty( $trimmed_badge ) ) {
                                        echo '<span class="tech-badge">' . esc_html( $trimmed_badge ) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="project-sidebar-widget">
                        <h3 class="widget-title"><?php esc_html_e( 'Project Metadata', 'tech-portfolio' ); ?></h3>
                        <div class="widget-value" style="display:flex; flex-direction:column; gap:16px;">
                            <div>
                                <strong style="color: var(--text-white); display:block; margin-bottom:4px; font-size:0.9rem; text-transform:uppercase; font-family:var(--font-mono);"><?php esc_html_e( 'Project ID', 'tech-portfolio' ); ?></strong>
                                <span style="font-family: var(--font-mono); font-size: 0.95rem; color: var(--gold);"><?php echo esc_html( sprintf( '#PRJ-%04d', get_the_ID() ) ); ?></span>
                            </div>
                            <div>
                                <strong style="color: var(--text-white); display:block; margin-bottom:4px; font-size:0.9rem; text-transform:uppercase; font-family:var(--font-mono);"><?php esc_html_e( 'Classification', 'tech-portfolio' ); ?></strong>
                                <span style="font-size: 0.95rem;">
                                    <?php
                                    $categories = get_the_terms( get_the_ID(), 'project_category' );
                                    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                        $cat_names = wp_list_pluck( $categories, 'name' );
                                        echo esc_html( implode( ', ', $cat_names ) );
                                    } else {
                                        esc_html_e( 'Uncategorized', 'tech-portfolio' );
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if ( ! empty( $project_github ) || ! empty( $project_live ) ) : ?>
                        <div class="project-sidebar-widget">
                            <h3 class="widget-title"><?php esc_html_e( 'Access & Deployments', 'tech-portfolio' ); ?></h3>
                            <div class="project-cta-block">
                                <?php if ( ! empty( $project_github ) ) : ?>
                                    <a href="<?php echo esc_url( $project_github ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                        <?php esc_html_e( 'GitHub Repository', 'tech-portfolio' ); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ( ! empty( $project_live ) ) : ?>
                                    <a href="<?php echo esc_url( $project_live ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                                        <?php esc_html_e( 'Live Simulation / Demo', 'tech-portfolio' ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </aside>

            </div>
        </div>
    </section>

<?php
endwhile;
get_footer();
?>
