<?php
/**
 * Template Name: About & Credentials Page
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Page Hero -->
<section class="page-hero-section" aria-labelledby="about-page-title">
    <div class="container" style="position: relative; z-index: 1;">
        <div class="page-hero-tag"><?php esc_html_e( 'Qualifications & Training', 'tech-portfolio' ); ?></div>
        <h1 class="page-hero-title" id="about-page-title"><?php esc_html_e( 'About & Credentials', 'tech-portfolio' ); ?></h1>
        <p class="page-hero-desc">
            <?php esc_html_e( 'A detailed catalog of academic qualifications, certified network competencies, and specialized engineering training.', 'tech-portfolio' ); ?>
        </p>
    </div>
</section>

<!-- Editable Page Content -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php if ( get_the_content() ) : ?>
        <section class="section page-content-section">
            <div class="container">
                <div class="page-content-body" style="max-width: 800px; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endwhile; endif; ?>
<?php rewind_posts(); ?>

<!-- Education Timeline -->
<section class="section education-section" aria-labelledby="education-title">
    <div class="container">
        <h2 class="section-title reveal" id="education-title" data-index="01"><?php esc_html_e( 'Education Timeline', 'tech-portfolio' ); ?></h2>

        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-card">
                    <span class="timeline-date"><?php esc_html_e( 'March 2026 – Present', 'tech-portfolio' ); ?></span>
                    <h3 class="timeline-title"><?php esc_html_e( 'BEng (Hons) Computer Networking and Cloud Security', 'tech-portfolio' ); ?></h3>
                    <h4 class="timeline-subtitle"><?php esc_html_e( 'ESU Kandy — Affiliated with London Metropolitan University, UK', 'tech-portfolio' ); ?></h4>
                    <div class="timeline-desc">
                        <p><?php esc_html_e( 'Focusing on advanced cloud security frameworks, enterprise routing architectures, virtualization, and vulnerability assessments.', 'tech-portfolio' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-card">
                    <span class="timeline-date"><?php esc_html_e( 'November 2024 – December 2025', 'tech-portfolio' ); ?></span>
                    <h3 class="timeline-title"><?php esc_html_e( 'Higher Diploma in Network Technology and Cybersecurity', 'tech-portfolio' ); ?></h3>
                    <h4 class="timeline-subtitle"><?php esc_html_e( 'ICBT Kandy — Affiliated with Cardiff Metropolitan University, UK · Merit Pass', 'tech-portfolio' ); ?></h4>
                    <div class="timeline-desc">
                        <p><?php esc_html_e( 'Comprehensive study of infrastructure switching, defense architectures, system monitoring, and network configuration principles.', 'tech-portfolio' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-card">
                    <span class="timeline-date"><?php esc_html_e( '2022', 'tech-portfolio' ); ?></span>
                    <h3 class="timeline-title"><?php esc_html_e( 'Fullstack Web Development', 'tech-portfolio' ); ?></h3>
                    <h4 class="timeline-subtitle"><?php esc_html_e( 'University of Moratuwa (Online)', 'tech-portfolio' ); ?></h4>
                    <div class="timeline-desc">
                        <p><?php esc_html_e( 'Learned foundational front-end and back-end web frameworks, database administration, and application deployment strategies.', 'tech-portfolio' ); ?></p>
                    </div>
                </div>
            </div>

        </div><!-- .timeline -->
    </div>
</section>

<!-- Certifications Grid -->
<section class="section certifications-section" aria-labelledby="certs-title">
    <div class="container">
        <h2 class="section-title reveal" id="certs-title" data-index="02"><?php esc_html_e( 'Professional Certifications', 'tech-portfolio' ); ?></h2>

        <div class="certs-grid">
            <?php
            $certifications = array(
                array(
                    'name'   => __( 'Cisco Certified Network Associate (CCNA)', 'tech-portfolio' ),
                    'issuer' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'icon'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                ),
                array(
                    'name'   => __( 'Network Support & Security', 'tech-portfolio' ),
                    'issuer' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'icon'   => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
                ),
                array(
                    'name'   => __( 'Network Basics', 'tech-portfolio' ),
                    'issuer' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'icon'   => '<rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/>',
                ),
                array(
                    'name'   => __( 'Operating Systems & Hardware', 'tech-portfolio' ),
                    'issuer' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'icon'   => '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
                ),
                array(
                    'name'   => __( 'Introduction to Packet Tracer', 'tech-portfolio' ),
                    'issuer' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'icon'   => '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>',
                ),
                array(
                    'name'   => __( 'Python Fundamentals for Researchers', 'tech-portfolio' ),
                    'issuer' => __( 'National Institute of Fundamental Studies (NIFS)', 'tech-portfolio' ),
                    'icon'   => '<polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/>',
                ),
                array(
                    'name'   => __( 'Prompt Engineering Professional', 'tech-portfolio' ),
                    'issuer' => __( 'DeepLearning.AI', 'tech-portfolio' ),
                    'icon'   => '<circle cx="12" cy="12" r="10"/><path d="m9.09 9 1.24 3h2.33l1.24-3"/>',
                ),
                array(
                    'name'   => __( 'Certificate in Computer Science', 'tech-portfolio' ),
                    'issuer' => __( 'NIBM Sri Lanka', 'tech-portfolio' ),
                    'icon'   => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
                ),
                array(
                    'name'   => __( 'Diploma in Skill Development', 'tech-portfolio' ),
                    'issuer' => __( 'CSDS Sri Lanka', 'tech-portfolio' ),
                    'icon'   => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
                ),
            );

            $delay_map = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4', 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4', 'reveal-delay-1' );

            foreach ( $certifications as $i => $cert ) :
                $delay = isset( $delay_map[ $i ] ) ? $delay_map[ $i ] : '';
            ?>
                <div class="cert-card reveal <?php echo esc_attr( $delay ); ?>">
                    <div class="cert-badge" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <?php echo $cert['icon']; // Already escaped SVG paths ?>
                        </svg>
                    </div>
                    <div class="cert-info">
                        <h3><?php echo esc_html( $cert['name'] ); ?></h3>
                        <p><?php echo esc_html( $cert['issuer'] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
