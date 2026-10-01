<?php
/**
 * Template Part: Hero Section - Glassmorphism Premium
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_subtitle = isset( $args['subtitle'] ) ? $args['subtitle'] : '';
$hero_title    = isset( $args['title'] ) ? $args['title'] : '';
$hero_desc     = isset( $args['description'] ) ? $args['description'] : '';
$hero_cta      = isset( $args['cta'] ) ? $args['cta'] : array();
$hero_class    = isset( $args['class'] ) ? $args['class'] : 'hero';
$hero_style    = isset( $args['style'] ) ? $args['style'] : '';
?>

<section class="<?php echo esc_attr( $hero_class ); ?>"<?php echo $hero_style ? ' style="' . esc_attr( $hero_style ) . '"' : ''; ?> aria-label="<?php esc_attr_e( 'Hero Banner', 'tech-portfolio' ); ?>">
    <span class="hero-orb hero-orb-1" aria-hidden="true"></span>
    <span class="hero-orb hero-orb-2" aria-hidden="true"></span>
    <div class="container">
        <div class="hero-content">
            <div class="hero-panel">

            <?php if ( $hero_subtitle ) : ?>
                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-dot" aria-hidden="true"></span>
                    <?php echo esc_html( $hero_subtitle ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $hero_title ) : ?>
                <h1 class="hero-title">
                    <?php
                    $title_plain = wp_strip_all_tags( $hero_title );
                    $parts       = explode( ' ', $title_plain, 2 );
                    if ( count( $parts ) === 2 ) {
                        echo esc_html( $parts[0] ) . ' <span class="highlight">' . esc_html( $parts[1] ) . '</span>';
                    } else {
                        echo esc_html( $title_plain );
                    }
                    ?>
                </h1>
            <?php endif; ?>

            <?php if ( $hero_desc ) : ?>
                <p class="hero-description"><?php echo esc_html( $hero_desc ); ?></p>
            <?php endif; ?>

            <!-- Location / Status meta -->
            <div class="hero-meta">
                <span class="hero-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php esc_html_e( 'Kandy, Sri Lanka', 'tech-portfolio' ); ?>
                </span>
                <span class="hero-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    <?php esc_html_e( 'Cisco CCNA Certified', 'tech-portfolio' ); ?>
                </span>
                <span class="hero-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <?php esc_html_e( 'Open to Opportunities', 'tech-portfolio' ); ?>
                </span>
            </div>

            <?php if ( ! empty( $hero_cta ) ) : ?>
                <div class="hero-cta">
                    <?php foreach ( $hero_cta as $btn ) :
                        $btn_url   = isset( $btn['url'] ) ? $btn['url'] : '#';
                        $btn_text  = isset( $btn['text'] ) ? $btn['text'] : '';
                        $btn_class = isset( $btn['class'] ) ? $btn['class'] : 'btn-secondary';
                        $icon = ( 'btn-primary' === $btn_class ) ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>' : '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M12 8v8M5 16v-4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"/></svg>';
                    ?>
                        <a href="<?php echo esc_url( $btn_url ); ?>" class="btn <?php echo esc_attr( $btn_class ); ?>">
                            <?php echo esc_html( $btn_text ); ?>
                            <?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Tech badges row -->
            <div class="hero-badges" aria-label="<?php esc_attr_e( 'Key Skills', 'tech-portfolio' ); ?>">
                <?php
                $badges = array( 'Network Admin', 'Cisco CCNA', 'Cybersecurity', 'Python', 'Cloud Security', 'IoT Systems' );
                foreach ( $badges as $badge ) :
                ?>
                    <span class="hero-badge">
                        <span class="hero-badge-dot" aria-hidden="true"></span>
                        <?php echo esc_html( $badge ); ?>
                    </span>
                <?php endforeach; ?>
            </div>

            </div><!-- .hero-panel -->
        </div><!-- .hero-content -->
    </div><!-- .container -->

    <!-- Scroll indicator -->
    <div class="scroll-indicator" aria-hidden="true">
        <span class="scroll-indicator-text"><?php esc_html_e( 'Scroll', 'tech-portfolio' ); ?></span>
        <span class="scroll-indicator-line"></span>
    </div>

</section>
