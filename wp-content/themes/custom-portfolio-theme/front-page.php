<?php
/**
 * The template for displaying the home page
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Hero Section.
get_template_part( 'template-parts/hero', null, array(
    'subtitle'    => 'Enterprise Systems & Code',
    'title'       => 'Mohammed Nazar Umair Mohammeth',
    'description' => 'Network Administrator & Cybersecurity Engineer specializing in enterprise infrastructure, threat mitigation, and Python-driven automation. Based in Kandy, Sri Lanka.',
    'cta'         => array(
        array(
            'text'  => __( 'View Experience', 'tech-portfolio' ),
            'url'   => esc_url( home_url( '/experience/' ) ),
            'class' => 'btn-primary',
        ),
        array(
            'text'  => __( 'Browse Projects', 'tech-portfolio' ),
            'url'   => esc_url( get_post_type_archive_link( 'projects' ) ),
            'class' => 'btn-secondary',
        ),
    ),
) );
?>

<!-- ====================================================
     Stats Strip
     ==================================================== -->
<div class="stats-strip reveal">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number" aria-label="<?php esc_attr_e( '5+ Years', 'tech-portfolio' ); ?>">5+</div>
                <div class="stat-label"><?php esc_html_e( 'Years Experience', 'tech-portfolio' ); ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-number">9+</div>
                <div class="stat-label"><?php esc_html_e( 'Certifications', 'tech-portfolio' ); ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-number">15+</div>
                <div class="stat-label"><?php esc_html_e( 'Projects Delivered', 'tech-portfolio' ); ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-number">3+</div>
                <div class="stat-label"><?php esc_html_e( 'Cloud Platforms', 'tech-portfolio' ); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- ====================================================
     Core Stack Section
     ==================================================== -->
<section class="section core-stack">
    <div class="container">
        <h2 class="section-title reveal" data-index="01"><?php esc_html_e( 'Core Stack', 'tech-portfolio' ); ?></h2>

        <div class="skills-grid">
            <?php
            $skills = array(
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>',
                    'title' => __( 'Networking Protocols', 'tech-portfolio' ),
                    'desc'  => __( 'Deep configuration of DHCP, DNS, NAT, VPN, WAN routing, and local switching protocols across enterprise environments.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"/></svg>',
                    'title' => __( 'Cisco Administration', 'tech-portfolio' ),
                    'desc'  => __( 'Hands-on network simulation via Cisco Packet Tracer — configuring routers, switches, and secure access control lists.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-2',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                    'title' => __( 'Cybersecurity', 'tech-portfolio' ),
                    'desc'  => __( 'Threat modeling, vulnerability assessments, and zero-trust architectures for enterprise-grade network defense.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-3',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>',
                    'title' => __( 'Python Automation', 'tech-portfolio' ),
                    'desc'  => __( 'Network automation scripts, log parsers, and workflow orchestration for infrastructure operations.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-4',
                ),
            );

            foreach ( $skills as $skill ) :
            ?>
                <div class="skill-card reveal <?php echo esc_attr( $skill['delay'] ); ?>">
                    <div class="skill-icon" aria-hidden="true"><?php echo $skill['icon']; // Already escaped SVG ?></div>
                    <h3 class="skill-title"><?php echo esc_html( $skill['title'] ); ?></h3>
                    <p class="skill-desc"><?php echo esc_html( $skill['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====================================================
     Featured Projects Section
     ==================================================== -->
<section class="section featured-projects">
    <div class="container">
        <h2 class="section-title reveal" data-index="02"><?php esc_html_e( 'Featured Projects', 'tech-portfolio' ); ?></h2>

        <?php
        $args = array(
            'post_type'      => 'projects',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'no_found_rows'  => true,
        );
        $project_query = new WP_Query( $args );

        if ( $project_query->have_posts() ) : ?>
            <div class="projects-grid">
                <?php
                $delays = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3' );
                $i = 0;
                while ( $project_query->have_posts() ) :
                    $project_query->the_post();
                    $role = get_post_meta( get_the_ID(), '_project_role', true );
                    get_template_part( 'template-parts/project-card', null, array(
                        'role'       => $role,
                        'term_slugs' => array(),
                        'delay'      => isset( $delays[ $i ] ) ? $delays[ $i ] : '',
                    ) );
                    $i++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <div style="text-align: center; margin-top: 52px;" class="reveal">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="btn btn-secondary">
                    <?php esc_html_e( 'View All Projects', 'tech-portfolio' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

        <?php else : ?>
            <p style="color: var(--text-muted); font-style: italic;">
                <?php esc_html_e( 'No projects published yet. Check back soon.', 'tech-portfolio' ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
