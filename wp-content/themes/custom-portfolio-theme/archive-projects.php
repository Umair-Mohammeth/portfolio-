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

<!-- Project Modal Data (for JS) -->
<script id="project-details-data" type="application/json"><?php
    $modal_projects = array();
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
                'github'      => wp_strip_all_tags( get_post_meta( $pid, '_project_github_url', true ) ),
                'live'        => wp_strip_all_tags( get_post_meta( $pid, '_project_live_url', true ) ),
                'pdf'         => wp_strip_all_tags( get_post_meta( $pid, '_project_pdf_url', true ) ),
                'excerpt'     => wp_strip_all_tags( get_the_excerpt() ),
                'categories'  => $cat_names,
                'image'       => tech_portfolio_get_project_placeholder( $pid ),
                'permalink'   => get_permalink(),
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
