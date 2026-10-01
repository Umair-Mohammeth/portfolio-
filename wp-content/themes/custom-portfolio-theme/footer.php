<?php
/**
 * Custom Tech Portfolio Theme Footer
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
</main><!-- #primary -->

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-widget">
                <div class="footer-brand-logo">UMAIR<span>.TECH</span></div>
                <p>
                    <?php esc_html_e( 'Custom-coded tech portfolio engineered for performance, security, and impact. Showcasing expertise in networking infrastructure, cloud security, and automation.', 'tech-portfolio' ); ?>
                </p>
            </div>

            <!-- Quick Links Column -->
            <div class="footer-widget">
                <h3><?php esc_html_e( 'Navigation', 'tech-portfolio' ); ?></h3>
                <nav class="footer-links" aria-label="<?php esc_attr_e( 'Footer Navigation', 'tech-portfolio' ); ?>">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tech-portfolio' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About & Credentials', 'tech-portfolio' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/experience/' ) ); ?>"><?php esc_html_e( 'Experience', 'tech-portfolio' ); ?></a>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>"><?php esc_html_e( 'Projects', 'tech-portfolio' ); ?></a>
                </nav>
            </div>

            <!-- Contact Column -->
            <div class="footer-widget">
                <h3><?php esc_html_e( 'Contact', 'tech-portfolio' ); ?></h3>

                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span>mohammednazarumairmohammeth@gmail.com</span>
                </div>

                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.62 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>+94 721 658 204</span>
                </div>

                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span><?php esc_html_e( 'Kandy, Sri Lanka', 'tech-portfolio' ); ?></span>
                </div>
            </div>

        </div><!-- .footer-grid -->

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
                <?php esc_html_e( 'Mohammed Nazar Umair Mohammeth. All rights reserved.', 'tech-portfolio' ); ?>
            </p>
            <div class="footer-bottom-status">
                <span class="status-dot" aria-hidden="true"></span>
                <span><?php esc_html_e( 'Open to new opportunities', 'tech-portfolio' ); ?></span>
            </div>
            <p><?php esc_html_e( 'Designed & coded in Kandy, Sri Lanka.', 'tech-portfolio' ); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
<button class="back-to-top" id="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'tech-portfolio' ); ?>" type="button">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
</button>
</body>
</html>
