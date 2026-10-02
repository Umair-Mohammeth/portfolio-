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

<!-- Education Grid -->
<section class="section education-section" aria-labelledby="education-title">
    <div class="container">
        <h2 class="section-title reveal" id="education-title" data-index="01"><?php esc_html_e( 'Education', 'tech-portfolio' ); ?></h2>

        <div class="skills-grid">
            <?php
            $education = array(
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    'title' => __( 'BEng (Hons) Computer Networking and Cloud Security', 'tech-portfolio' ),
                    'subtitle' => __( 'ESU Kandy — Affiliated with London Metropolitan University, UK', 'tech-portfolio' ),
                    'desc'  => __( 'Advanced cloud security frameworks, enterprise routing architectures, virtualization, and vulnerability assessments. Expected 2028.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    'title' => __( 'Higher Diploma in Network Technology and Cybersecurity', 'tech-portfolio' ),
                    'subtitle' => __( 'ICBT Kandy — Affiliated with Cardiff Metropolitan University, UK · Merit Pass', 'tech-portfolio' ),
                    'desc'  => __( 'Infrastructure switching, defense architectures, system monitoring, and network configuration principles. Completed Dec 2025.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-2',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="14" y="2" width="20" height="20" rx="2"/><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>',
                    'title' => __( 'Fullstack Web Development', 'tech-portfolio' ),
                    'subtitle' => __( 'University of Moratuwa (Online)', 'tech-portfolio' ),
                    'desc'  => __( 'Frontend: React.js, responsive design. Backend: Node.js/Express, REST APIs, JWT/OAuth. Database: PostgreSQL, MongoDB. DevOps: Docker, CI/CD, Git/GitHub. Completed 2022.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-3',
                ),
            );

            foreach ( $education as $edu ) :
            ?>
                <div class="skill-card reveal <?php echo esc_attr( $edu['delay'] ); ?>">
                    <div class="skill-icon" aria-hidden="true"><?php echo $edu['icon']; // Already escaped SVG ?></div>
                    <h3 class="skill-title"><?php echo esc_html( $edu['title'] ); ?></h3>
                    <p class="skill-subtitle" style="color: var(--gold); font-size: 0.85rem; font-weight: 500; margin-bottom: 8px;"><?php echo esc_html( $edu['subtitle'] ); ?></p>
                    <p class="skill-desc"><?php echo esc_html( $edu['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Certifications Grid -->
<section class="section certifications-section" aria-labelledby="certs-title">
    <div class="container">
        <h2 class="section-title reveal" id="certs-title" data-index="02"><?php esc_html_e( 'Professional Certifications', 'tech-portfolio' ); ?></h2>

        <div class="skills-grid">
            <?php
            $certifications = array(
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                    'title' => __( 'Cisco Certified Network Associate (CCNA)', 'tech-portfolio' ),
                    'subtitle' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'desc'  => __( 'Validates ability to install, configure, operate, and troubleshoot medium-size routed and switched networks. Covers network fundamentals, IP connectivity, security fundamentals, automation, and programmability.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
                    'title' => __( 'Network Support & Security', 'tech-portfolio' ),
                    'subtitle' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'desc'  => __( 'Focused on network infrastructure support with security hardening: monitoring, threat detection, access control, and secure remote access configuration.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-2',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>',
                    'title' => __( 'Network Basics', 'tech-portfolio' ),
                    'subtitle' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'desc'  => __( 'Foundational networking concepts: OSI/TCP-IP models, IPv4/IPv6 addressing, subnetting, basic switching and routing, and network device management.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-3',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                    'title' => __( 'Operating Systems & Hardware', 'tech-portfolio' ),
                    'subtitle' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'desc'  => __( 'Computer hardware components, operating system installation and configuration, troubleshooting methodology, and peripheral device management.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-4',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>',
                    'title' => __( 'Introduction to Packet Tracer', 'tech-portfolio' ),
                    'subtitle' => __( 'Cisco Systems', 'tech-portfolio' ),
                    'desc'  => __( 'Hands-on proficiency with Cisco Packet Tracer for network simulation, topology design, device configuration, and protocol analysis.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>',
                    'title' => __( 'Python Fundamentals for Researchers', 'tech-portfolio' ),
                    'subtitle' => __( 'National Institute of Fundamental Studies (NIFS)', 'tech-portfolio' ),
                    'desc'  => __( 'Python programming for scientific computing: data manipulation, visualization, automation scripting, and research workflow automation.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-2',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="m9.09 9 1.24 3h2.33l1.24-3"/></svg>',
                    'title' => __( 'Prompt Engineering Professional', 'tech-portfolio' ),
                    'subtitle' => __( 'DeepLearning.AI', 'tech-portfolio' ),
                    'desc'  => __( 'Advanced prompt engineering techniques for LLMs: chain-of-thought, few-shot prompting, RAG integration, and production prompt optimization.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-3',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>',
                    'title' => __( 'Certificate in Computer Science', 'tech-portfolio' ),
                    'subtitle' => __( 'NIBM Sri Lanka', 'tech-portfolio' ),
                    'desc'  => __( 'Core computer science fundamentals: algorithms, data structures, databases, software engineering principles, and programming paradigms.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-4',
                ),
                array(
                    'icon'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    'title' => __( 'Diploma in Skill Development', 'tech-portfolio' ),
                    'subtitle' => __( 'CSDS Sri Lanka', 'tech-portfolio' ),
                    'desc'  => __( 'Professional skills development: communication, project management, teamwork, and technical documentation for IT professionals.', 'tech-portfolio' ),
                    'delay' => 'reveal-delay-1',
                ),
            );

            foreach ( $certifications as $cert ) :
            ?>
                <div class="skill-card reveal <?php echo esc_attr( $cert['delay'] ); ?>">
                    <div class="skill-icon" aria-hidden="true"><?php echo $cert['icon']; // Already escaped SVG ?></div>
                    <h3 class="skill-title"><?php echo esc_html( $cert['title'] ); ?></h3>
                    <p class="skill-subtitle" style="color: var(--gold); font-size: 0.85rem; font-weight: 500; margin-bottom: 8px;"><?php echo esc_html( $cert['subtitle'] ); ?></p>
                    <p class="skill-desc"><?php echo esc_html( $cert['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
