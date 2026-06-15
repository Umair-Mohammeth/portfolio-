<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-container">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( wp_get_upload_dir()['baseurl'] . '/2026/Logo.png' ); ?>" alt="Umair Tech Logo" class="logo-img">
            </a>
        </div>
        <nav class="site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'tech-portfolio' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'tech_portfolio_default_menu',
            ) );

            // Default fallback menu if none is assigned in the admin.
            function tech_portfolio_default_menu() {
                ?>
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/experience/' ) ); ?>"><?php esc_html_e( 'Experience', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>"><?php esc_html_e( 'Projects', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/github-projects/' ) ); ?>"><?php esc_html_e( 'GitHub', 'tech-portfolio' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'tech-portfolio' ); ?></a></li>
                </ul>
                <?php
            }
            ?>
        </nav>
    </div>
</header>

<main id="primary" class="site-main">
