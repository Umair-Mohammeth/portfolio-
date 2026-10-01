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

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'tech-portfolio' ); ?></a>

<header class="site-header" id="site-header" role="banner">
    <div class="container header-container">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'UMAIR.TECH – Home', 'tech-portfolio' ); ?>">
                UMAIR<span>.TECH</span>
            </a>
        </div>

        <nav class="site-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'tech-portfolio' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_id'        => 'primary-nav',
                'menu_class'     => 'nav-menu',
                'fallback_cb'    => 'tech_portfolio_default_menu',
            ) );
            ?>
        </nav>

        <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="<?php esc_attr_e( 'Toggle Menu', 'tech-portfolio' ); ?>" aria-haspopup="true">
            <span class="nav-toggle-bar"></span>
            <span class="nav-toggle-bar"></span>
            <span class="nav-toggle-bar"></span>
        </button>
    </div>
</header>

<main id="primary" class="site-main">
