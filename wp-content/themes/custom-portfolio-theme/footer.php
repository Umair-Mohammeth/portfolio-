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
</main> <!-- #primary -->

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-widget">
                <h3>UMAIR<span>.TECH</span></h3>
                <p><?php esc_html_e( 'Custom-coded tech portfolio engineered for performance, security, and impact. Showcasing expertise in networking infrastructure, cloud security systems, and programmatic automation.', 'tech-portfolio' ); ?></p>
                <div class="footer-social">
                    <a href="https://www.linkedin.com/in/mohammed-nazar-umair-mohammeth" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="https://github.com/Umair-Mohammeth" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                    </a>
                    <a href="mailto:mohammednazarumairmohammeth@gmail.com" aria-label="Email">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer-widget">
                <h3><?php esc_html_e( 'Quick Links', 'tech-portfolio' ); ?></h3>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/experience/' ) ); ?>"><?php esc_html_e( 'Experience', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>"><?php esc_html_e( 'Projects', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'tech-portfolio' ); ?></a></li>
                </ul>
            </div>
            <div class="footer-widget">
                <h3><?php esc_html_e( 'Contact Info', 'tech-portfolio' ); ?></h3>
                <p>
                    <strong><?php esc_html_e( 'Email:', 'tech-portfolio' ); ?></strong> mohammednazarumairmohammeth@gmail.com<br>
                    <strong><?php esc_html_e( 'Phone:', 'tech-portfolio' ); ?></strong> +94 721 658 204<br>
                    <strong><?php esc_html_e( 'Location:', 'tech-portfolio' ); ?></strong> Kandy, Sri Lanka
                </p>
                <div class="footer-languages">
                    <h4><?php esc_html_e( 'Languages', 'tech-portfolio' ); ?></h4>
                    <span class="language-badge">Tamil</span>
                    <span class="language-badge">Sinhala</span>
                    <span class="language-badge">English</span>
                </div>
            </div>
            <div class="footer-widget">
                <h3><?php esc_html_e( 'Focus Areas', 'tech-portfolio' ); ?></h3>
                <p>
                    <?php esc_html_e( '• Network Design & Administration', 'tech-portfolio' ); ?><br>
                    <?php esc_html_e( '• Cloud & Cyber Security Infrastructure', 'tech-portfolio' ); ?><br>
                    <?php esc_html_e( '• Python Scripts & Automation Tools', 'tech-portfolio' ); ?><br>
                    <?php esc_html_e( '• Smart IoT & Embedded Systems', 'tech-portfolio' ); ?><br>

                </p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Mohammed Nazar Umair Mohammeth. <?php esc_html_e( 'All rights reserved.', 'tech-portfolio' ); ?></p>
            <p><?php esc_html_e( 'Designed and Custom Coded in Kandy, Sri Lanka.', 'tech-portfolio' ); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>