<?php
/**
 * The template for displaying a single project post
 *
 * @package TechPortfolio
 */

get_header(); ?>

<?php
while ( have_posts() ) :
    the_post();

    // Query hidden post-meta keys securely.
    $project_role       = get_post_meta( get_the_ID(), '_project_role', true );
    $project_tech_stack = get_post_meta( get_the_ID(), '_project_tech_stack', true );
    $project_github     = get_post_meta( get_the_ID(), '_project_github_url', true );
    $project_live       = get_post_meta( get_the_ID(), '_project_live_url', true );
    ?>

    <!-- Project Hero Header -->
    <section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 40px;">
        <div class="container">
            <h1 class="hero-title" style="margin-bottom: 16px;"><?php the_title(); ?></h1>
            <?php if ( ! empty( $project_role ) ) : ?>
                <p class="hero-subtitle" style="font-size: 1.1rem; margin-bottom: 0;">
                    <strong><?php esc_html_e( 'Role / Scope:', 'tech-portfolio' ); ?></strong> 
                    <?php echo esc_html( $project_role ); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Main Container -->
    <section class="section project-detail-section" style="border-top: 1px solid var(--border-gray); padding-top: 40px;">
        <div class="container">
            <div class="project-single-container">
                
                <!-- Project Main Body Content -->
                <main class="project-main-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="project-featured-image" style="margin-bottom: 40px; border-radius: 6px; overflow: hidden; border: 1px solid var(--border-gray);">
                            <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; height:auto; display:block;' ) ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="project-content-body">
                        <?php the_content(); ?>
                    </div>
                </main>

                <!-- Project Sidebar Specs -->
                <aside class="project-sidebar">
                    
                    <!-- Tech Stack Widget -->
                    <?php if ( ! empty( $project_tech_stack ) ) : ?>
                        <div class="project-sidebar-widget">
                            <h3 class="widget-title"><?php esc_html_e( 'Technologies Used', 'tech-portfolio' ); ?></h3>
                            <div class="badge-grid">
                                <?php
                                // Convert comma-separated string to clean individual grid tags.
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

                    <!-- Metadata details widget -->
                    <div class="project-sidebar-widget">
                        <h3 class="widget-title"><?php esc_html_e( 'Project Metadata', 'tech-portfolio' ); ?></h3>
                        <div class="widget-value" style="display:flex; flex-direction:column; gap:16px;">
                            <div>
                                <strong style="color: var(--text-white); display:block; margin-bottom:4px; font-size:0.9rem; text-transform:uppercase; font-family:var(--font-mono);"><?php esc_html_e( 'Project ID', 'tech-portfolio' ); ?></strong>
                                <span style="font-family: var(--font-mono); font-size: 0.95rem; color: var(--accent-gold);"><?php echo esc_html( sprintf( '#PRJ-%04d', get_the_ID() ) ); ?></span>
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

                    <!-- Call-to-Action Interactive Buttons -->
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
endwhile; // End of the loop.
get_footer();
?>
