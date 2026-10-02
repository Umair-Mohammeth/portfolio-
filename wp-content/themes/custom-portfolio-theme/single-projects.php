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
                    <?php else : ?>
                        <div class="project-featured-image">
                            <img src="<?php echo esc_url( tech_portfolio_get_project_placeholder( get_the_ID() ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="1200" height="600" style="width:100%;height:auto;display:block;" />
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
    // Prepare project data for modal (archive quick view)
    $project_data = array(
        'id'          => get_the_ID(),
        'title'       => get_the_title(),
        'role'        => $project_role,
        'tech_stack'  => $project_tech_stack,
        'github'      => $project_github,
        'live'        => $project_live,
        'content'     => get_the_content(),
        'excerpt'     => get_the_excerpt(),
        'categories'  => array(),
        'image'       => tech_portfolio_get_project_placeholder( get_the_ID() ),
    );
    $cats = get_the_terms( get_the_ID(), 'project_category' );
    if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
        foreach ( $cats as $cat ) {
            $project_data['categories'][] = $cat->name;
        }
    }
endwhile;
?>

<!-- Project Modal Data (for JS) -->
<script id="project-details-data" type="application/json"><?php
    // We need to re-query for the modal data since we're after the loop
    // For single project page, the data is already displayed; this is mainly for archive quick-view
    // But we include it for consistency
    $modal_projects = array();
    // Re-query all projects for archive modal support
    $all_projects = new WP_Query( array( 'post_type' => 'projects', 'posts_per_page' => -1, 'post_status' => 'publish' ) );
    if ( $all_projects->have_posts() ) {
        while ( $all_projects->have_posts() ) {
            $all_projects->the_post();
            $pid = get_the_ID();
            $prole = get_post_meta( $pid, '_project_role', true );
            $ptech = get_post_meta( $pid, '_project_tech_stack', true );
            $pgit  = get_post_meta( $pid, '_project_github_url', true );
            $plive = get_post_meta( $pid, '_project_live_url', true );
            $pcats = get_the_terms( $pid, 'project_category' );
            $cat_names = array();
            if ( ! empty( $pcats ) && ! is_wp_error( $pcats ) ) {
                foreach ( $pcats as $pcat ) { $cat_names[] = $pcat->name; }
            }
            $modal_projects[] = array(
                'id'          => $pid,
                'title'       => wp_strip_all_tags( get_the_title() ),
                'role'        => wp_strip_all_tags( $prole ),
                'tech_stack'  => wp_strip_all_tags( $ptech ),
                'github'      => wp_strip_all_tags( $pgit ),
                'live'        => wp_strip_all_tags( $plive ),
                'pdf'         => wp_strip_all_tags( get_post_meta( $pid, '_project_pdf_url', true ) ),
                'excerpt'     => wp_strip_all_tags( get_the_excerpt() ),
                'categories'  => $cat_names,
                'image'       => tech_portfolio_get_project_placeholder( $pid ),
            );
        }
        wp_reset_postdata();
    }
    echo wp_json_encode( $modal_projects );
?></script>

<!-- Project Modal -->
<div class="project-modal" id="project-modal" role="dialog" aria-modal="true" aria-labelledby="project-modal-title" hidden>
    <div class="project-modal-backdrop" tabindex="-1"></div>
    <div class="project-modal-content" role="document">
        <button class="project-modal-close" aria-label="<?php esc_attr_e( 'Close project details', 'tech-portfolio' ); ?>">&times;</button>
        <div class="project-modal-header">
            <div class="project-modal-image" aria-hidden="true">
                <img id="project-modal-image" src="" alt="" aria-hidden="true" />
            </div>
            <div class="project-modal-title-wrap">
                <h2 id="project-modal-title" class="project-modal-title"></h2>
                <p class="project-modal-role"></p>
            </div>
        </div>
        <div class="project-modal-body">
            <div class="project-modal-meta">
                <div class="project-modal-meta-item">
                    <span class="project-modal-meta-label"><?php esc_html_e( 'Role / Scope', 'tech-portfolio' ); ?></span>
                    <span class="project-modal-meta-value project-modal-role"></span>
                </div>
            </div>
            <div class="project-modal-description"></div>
            <div class="project-modal-tech">
                <h4><?php esc_html_e( 'Technologies', 'tech-portfolio' ); ?></h4>
                <div class="project-modal-tech-grid"></div>
            </div>
            <div class="project-modal-categories">
                <h4><?php esc_html_e( 'Categories', 'tech-portfolio' ); ?></h4>
                <div class="project-modal-cat-grid"></div>
            </div>
            <div class="project-modal-pdf" id="project-modal-pdf" style="display:none;">
                <h4><?php esc_html_e( 'Documentation', 'tech-portfolio' ); ?></h4>
                <div class="pdf-viewer-container">
                    <div class="pdf-toolbar">
                        <div class="pdf-toolbar-left">
                            <button class="pdf-btn" id="pdf-prev" aria-label="<?php esc_attr_e( 'Previous page', 'tech-portfolio' ); ?>" disabled>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </button>
                            <button class="pdf-btn" id="pdf-next" aria-label="<?php esc_attr_e( 'Next page', 'tech-portfolio' ); ?>" disabled>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                            <span class="pdf-page-info" id="pdf-page-info" aria-live="polite"><?php esc_html_e( 'Page', 'tech-portfolio' ); ?> <span id="pdf-current-page">1</span> <?php esc_html_e( 'of', 'tech-portfolio' ); ?> <span id="pdf-total-pages">1</span></span>
                        </div>
                        <div class="pdf-toolbar-right">
                            <button class="pdf-btn pdf-download" id="pdf-download" aria-label="<?php esc_attr_e( 'Download PDF', 'tech-portfolio' ); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                <span class="pdf-btn-text"><?php esc_html_e( 'Download', 'tech-portfolio' ); ?></span>
                            </button>
                            <button class="pdf-btn pdf-print" id="pdf-print" aria-label="<?php esc_attr_e( 'Print PDF', 'tech-portfolio' ); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5"/><path d="M18 18h2a2 2 0 0 0 2-2v-5"/></svg>
                                <span class="pdf-btn-text"><?php esc_html_e( 'Print', 'tech-portfolio' ); ?></span>
                            </button>
                            <button class="pdf-btn pdf-fullscreen" id="pdf-fullscreen" aria-label="<?php esc_attr_e( 'Fullscreen', 'tech-portfolio' ); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="pdf-canvas-wrapper">
                        <canvas id="pdf-canvas" aria-hidden="true"></canvas>
                    </div>
                </div>
            </div>
            <div class="project-modal-links">
                <a id="project-modal-github" class="btn btn-primary" href="#" target="_blank" rel="noopener noreferrer" style="display:none;">
                    <?php esc_html_e( 'GitHub Repository', 'tech-portfolio' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>
                </a>
                <a id="project-modal-live" class="btn btn-secondary" href="#" target="_blank" rel="noopener noreferrer" style="display:none;">
                    <?php esc_html_e( 'Live Demo', 'tech-portfolio' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>
                </a>
                <a id="project-modal-full" class="btn btn-secondary" href="#" style="display:none;">
                    <?php esc_html_e( 'Full Case Study', 'tech-portfolio' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
