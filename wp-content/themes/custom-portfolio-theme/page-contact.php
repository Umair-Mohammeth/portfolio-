<?php
/**
 * Template Name: Contact Page
 *
 * @package TechPortfolio
 */

get_header(); ?>

<section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 60px;">
    <div class="container">
        <h1 class="hero-title" style="margin-bottom: 16px;"><?php esc_html_e( 'Get In Touch', 'tech-portfolio' ); ?></h1>
        <p class="hero-description" style="max-width: 700px; font-size: 1.1rem; margin-bottom: 0;">
            <?php esc_html_e( 'Open to opportunities in network administration, cybersecurity, and IoT development. Feel free to reach out!', 'tech-portfolio' ); ?>
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="section contact-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info Cards -->
            <div class="contact-cards">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h3 class="contact-card-title"><?php esc_html_e( 'Email', 'tech-portfolio' ); ?></h3>
                    <a href="mailto:mohammednazarumairmohammeth@gmail.com" class="contact-card-value">mohammednazarumairmohammeth@gmail.com</a>
                </div>

                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h3 class="contact-card-title"><?php esc_html_e( 'Phone', 'tech-portfolio' ); ?></h3>
                    <a href="tel:+94721658204" class="contact-card-value">+94 721 658 204</a>
                </div>

                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="contact-card-title"><?php esc_html_e( 'Location', 'tech-portfolio' ); ?></h3>
                    <span class="contact-card-value">Kandy, Sri Lanka</span>
                </div>

                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </div>
                    <h3 class="contact-card-title"><?php esc_html_e( 'LinkedIn', 'tech-portfolio' ); ?></h3>
                    <a href="https://www.linkedin.com/in/mohammed-nazar-umair-mohammeth" target="_blank" rel="noopener noreferrer" class="contact-card-value"><?php esc_html_e( 'Connect on LinkedIn', 'tech-portfolio' ); ?></a>
                </div>

                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                    </div>
                    <h3 class="contact-card-title"><?php esc_html_e( 'GitHub', 'tech-portfolio' ); ?></h3>
                    <a href="https://github.com/umair" target="_blank" rel="noopener noreferrer" class="contact-card-value"><?php esc_html_e( 'View GitHub Profile', 'tech-portfolio' ); ?></a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2 class="contact-form-title"><?php esc_html_e( 'Send a Message', 'tech-portfolio' ); ?></h2>
                <form class="contact-form" action="#" method="POST">
                    <div class="form-group">
                        <label for="name"><?php esc_html_e( 'Full Name', 'tech-portfolio' ); ?></label>
                        <input type="text" id="name" name="name" required placeholder="<?php esc_attr_e( 'Your name', 'tech-portfolio' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email"><?php esc_html_e( 'Email Address', 'tech-portfolio' ); ?></label>
                        <input type="email" id="email" name="email" required placeholder="<?php esc_attr_e( 'your@email.com', 'tech-portfolio' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="subject"><?php esc_html_e( 'Subject', 'tech-portfolio' ); ?></label>
                        <input type="text" id="subject" name="subject" required placeholder="<?php esc_attr_e( 'How can I help you?', 'tech-portfolio' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="message"><?php esc_html_e( 'Message', 'tech-portfolio' ); ?></label>
                        <textarea id="message" name="message" rows="5" required placeholder="<?php esc_attr_e( 'Your message...', 'tech-portfolio' ); ?>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Send Message', 'tech-portfolio' ); ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>