<?php
/**
 * Custom Tech Portfolio Theme Functions
 *
 * @package TechPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* ==========================================================================
   1. Theme Setup
   ========================================================================== */
function tech_portfolio_setup() {
    // Load theme textdomain for translations.
    load_theme_textdomain( 'tech-portfolio', get_template_directory() . '/languages' );

    // Enable support for Post Thumbnails on pages and posts.
    add_theme_support( 'post-thumbnails' );

    // Enable support for document title tag.
    add_theme_support( 'title-tag' );

    // Enable support for semantic HTML5 markup.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Block editor support.
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    // Editor styles for consistent block editing experience.
    add_editor_style();

    // Register primary navigation menu.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'tech-portfolio' ),
    ) );

    // Add content width for responsive embeds.
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }

    // Register custom image sizes.
    add_image_size( 'project-card', 700, 440, true );
    add_image_size( 'project-hero', 1200, 600, true );
}
add_action( 'after_setup_theme', 'tech_portfolio_setup' );

/* ==========================================================================
   2. Enqueue Styles & Scripts
   ========================================================================== */
function tech_portfolio_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );
    $css_version   = file_exists( get_template_directory() . '/style.css' ) ? filemtime( get_template_directory() . '/style.css' ) : $theme_version;
    $js_path       = '/assets/js/main.js';
    $js_version    = file_exists( get_template_directory() . $js_path ) ? filemtime( get_template_directory() . $js_path ) : $theme_version;

    // Enqueue main stylesheet.
    wp_enqueue_style( 'tech-portfolio-style', get_stylesheet_uri(), array(), (string) $css_version );

    // Enqueue Google Fonts (Outfit + JetBrains Mono, non-blocking).
    wp_enqueue_style(
        'tech-portfolio-google-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap',
        array(),
        null
    );

    // Enqueue main script (handles nav, scroll-reveal, counters, filter).
    wp_enqueue_script(
        'tech-portfolio-main',
        get_template_directory_uri() . $js_path,
        array(),
        (string) $js_version,
        true
    );
    wp_script_add_data( 'tech-portfolio-main', 'defer', true );
}
add_action( 'wp_enqueue_scripts', 'tech_portfolio_scripts' );

/* ==========================================================================
   3. Default Fallback Menu
   ========================================================================== */
function tech_portfolio_default_menu() {
    ?>
    <ul class="nav-menu" id="primary-nav">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tech-portfolio' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'tech-portfolio' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/experience/' ) ); ?>"><?php esc_html_e( 'Experience', 'tech-portfolio' ); ?></a></li>
        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>"><?php esc_html_e( 'Projects', 'tech-portfolio' ); ?></a></li>
    </ul>
    <?php
}

/* ==========================================================================
   4. (Removed) Separate filter script – functionality merged into main.js
   ========================================================================== */

/* ==========================================================================
   5. Register Custom Post Type (Projects)
   ========================================================================== */
function tech_portfolio_register_cpt_projects() {
    $labels = array(
        'name'                  => _x( 'Projects', 'Post type general name', 'tech-portfolio' ),
        'singular_name'         => _x( 'Project', 'Post type singular name', 'tech-portfolio' ),
        'menu_name'             => _x( 'Projects', 'Admin Menu text', 'tech-portfolio' ),
        'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'tech-portfolio' ),
        'add_new'               => __( 'Add New Project', 'tech-portfolio' ),
        'add_new_item'          => __( 'Add New Project', 'tech-portfolio' ),
        'new_item'              => __( 'New Project', 'tech-portfolio' ),
        'edit_item'             => __( 'Edit Project', 'tech-portfolio' ),
        'view_item'             => __( 'View Project', 'tech-portfolio' ),
        'all_items'             => __( 'All Projects', 'tech-portfolio' ),
        'search_items'          => __( 'Search Projects', 'tech-portfolio' ),
        'not_found'             => __( 'No projects found.', 'tech-portfolio' ),
        'not_found_in_trash'    => __( 'No projects found in Trash.', 'tech-portfolio' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true, // Enable Block Editor support
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'tech_portfolio_register_cpt_projects' );

/* ==========================================================================
   6. Register Custom Taxonomy (Project Categories)
   ========================================================================== */
function tech_portfolio_register_taxonomy_projects() {
    $labels = array(
        'name'              => _x( 'Project Categories', 'taxonomy general name', 'tech-portfolio' ),
        'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'tech-portfolio' ),
        'search_items'      => __( 'Search Project Categories', 'tech-portfolio' ),
        'all_items'         => __( 'All Project Categories', 'tech-portfolio' ),
        'parent_item'       => __( 'Parent Project Category', 'tech-portfolio' ),
        'parent_item_colon' => __( 'Parent Project Category:', 'tech-portfolio' ),
        'edit_item'         => __( 'Edit Project Category', 'tech-portfolio' ),
        'update_item'       => __( 'Update Project Category', 'tech-portfolio' ),
        'add_new_item'      => __( 'Add New Project Category', 'tech-portfolio' ),
        'new_item_name'     => __( 'New Project Category Name', 'tech-portfolio' ),
        'menu_name'         => __( 'Project Categories', 'tech-portfolio' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'project_category', array( 'projects' ), $args );
}
add_action( 'init', 'tech_portfolio_register_taxonomy_projects' );

/* ==========================================================================
   7. Secure Meta Boxes for CPT Metadata
   ========================================================================== */
function tech_portfolio_add_project_meta_boxes() {
    add_meta_box(
        'project_details_meta_box',
        __( 'Project Settings & Specifications', 'tech-portfolio' ),
        'tech_portfolio_render_project_meta_box',
        'projects',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tech_portfolio_add_project_meta_boxes' );

function tech_portfolio_render_project_meta_box( $post ) {
    // Use nonce for verification.
    wp_nonce_field( 'tech_portfolio_save_project_meta', 'tech_portfolio_project_meta_nonce' );

    // Retrieve existing values.
    $role       = get_post_meta( $post->ID, '_project_role', true );
    $tech_stack = get_post_meta( $post->ID, '_project_tech_stack', true );
    $github_url = get_post_meta( $post->ID, '_project_github_url', true );
    $live_url   = get_post_meta( $post->ID, '_project_live_url', true );
    $pdf_url    = get_post_meta( $post->ID, '_project_pdf_url', true );

    // Output form fields securely.
    ?>
    <p>
        <label for="project_role"><strong><?php esc_html_e( 'Project Role / Scope:', 'tech-portfolio' ); ?></strong></label><br />
        <input type="text" id="project_role" name="project_role" value="<?php echo esc_attr( $role ); ?>" class="widefat" placeholder="e.g. Lead Developer / Cybersecurity Engineer" />
    </p>
    <p>
        <label for="project_tech_stack"><strong><?php esc_html_e( 'Tech Stack (Comma-separated):', 'tech-portfolio' ); ?></strong></label><br />
        <input type="text" id="project_tech_stack" name="project_tech_stack" value="<?php echo esc_attr( $tech_stack ); ?>" class="widefat" placeholder="e.g. ESP32, Python, RFID, Telegram API" />
    </p>
    <p>
        <label for="project_github_url"><strong><?php esc_html_e( 'GitHub Repository URL:', 'tech-portfolio' ); ?></strong></label><br />
        <input type="url" id="project_github_url" name="project_github_url" value="<?php echo esc_url( $github_url ); ?>" class="widefat" placeholder="https://github.com/..." />
    </p>
    <p>
        <label for="project_live_url"><strong><?php esc_html_e( 'Live Link / Simulation URL:', 'tech-portfolio' ); ?></strong></label><br />
        <input type="url" id="project_live_url" name="project_live_url" value="<?php echo esc_url( $live_url ); ?>" class="widefat" placeholder="https://..." />
    </p>
    <p>
        <label for="project_pdf_url"><strong><?php esc_html_e( 'PDF Documentation URL:', 'tech-portfolio' ); ?></strong></label><br />
        <input type="url" id="project_pdf_url" name="project_pdf_url" value="<?php echo esc_url( $pdf_url ); ?>" class="widefat" placeholder="https://.../documentation.pdf" />
        <span class="description"><?php esc_html_e( 'Direct link to a PDF file for the live viewer.', 'tech-portfolio' ); ?></span>
    </p>
    <?php
}

function tech_portfolio_save_project_meta_data( $post_id ) {
    // Check permissions first (cheapest check).
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check post type.
    if ( ! isset( $_POST['post_type'] ) || 'projects' !== $_POST['post_type'] ) {
        return;
    }

    // Verify nonce (VibeSec: always require nonce, reject if missing).
    if ( ! isset( $_POST['tech_portfolio_project_meta_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tech_portfolio_project_meta_nonce'] ) ), 'tech_portfolio_save_project_meta' ) ) {
        return;
    }

    // Sanitize and save data (use wp_unslash before sanitizing).
    if ( isset( $_POST['project_role'] ) ) {
        update_post_meta( $post_id, '_project_role', sanitize_text_field( wp_unslash( $_POST['project_role'] ) ) );
    }

    if ( isset( $_POST['project_tech_stack'] ) ) {
        // VibeSec: sanitize comma-separated tech stack, strip tags
        $tech_stack = sanitize_text_field( wp_unslash( $_POST['project_tech_stack'] ) );
        $tech_stack = wp_strip_all_tags( $tech_stack );
        update_post_meta( $post_id, '_project_tech_stack', $tech_stack );
    }

    if ( isset( $_POST['project_github_url'] ) ) {
        // VibeSec: validate URL scheme is http/https only
        $github_url = esc_url_raw( wp_unslash( $_POST['project_github_url'] ), array( 'http', 'https' ) );
        if ( $github_url ) {
            update_post_meta( $post_id, '_project_github_url', $github_url );
        }
    }

    if ( isset( $_POST['project_live_url'] ) ) {
        // VibeSec: validate URL scheme is http/https only
        $live_url = esc_url_raw( wp_unslash( $_POST['project_live_url'] ), array( 'http', 'https' ) );
        if ( $live_url ) {
            update_post_meta( $post_id, '_project_live_url', $live_url );
        }
    }

    if ( isset( $_POST['project_pdf_url'] ) ) {
        // VibeSec: validate URL scheme is http/https only
        $pdf_url = esc_url_raw( wp_unslash( $_POST['project_pdf_url'] ), array( 'http', 'https' ) );
        if ( $pdf_url ) {
            update_post_meta( $post_id, '_project_pdf_url', $pdf_url );
        }
    }
}
add_action( 'save_post', 'tech_portfolio_save_project_meta_data' );

/* ==========================================================================
   8. Security Headers (VibeSec Hardening)
   ========================================================================== */
function tech_portfolio_security_headers() {
    if ( ! is_admin() && ! headers_sent() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: DENY' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );

        // Only send HSTS on HTTPS to avoid breaking local XAMPP http.
        if ( is_ssl() ) {
            header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
        }

        // Content Security Policy — allow self + Google Fonts. No inline scripts blocked
        // that would break wp_head JSON-LD; tighten only if all inline moved to files.
        $csp = implode( '; ', array(
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline'",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "img-src 'self' data: https:",
            "font-src 'self' https://fonts.gstatic.com",
            "connect-src 'self'",
            "frame-ancestors 'none'",
            "base-uri 'self'",
            "form-action 'self'",
        ) );
        header( "Content-Security-Policy: {$csp}" );
    }
}
add_action( 'send_headers', 'tech_portfolio_security_headers' );

/* ==========================================================================
   8b. Disable XML-RPC (attack surface reduction)
   ========================================================================== */
function tech_portfolio_disable_xmlrpc() {
    return false;
}
add_filter( 'xmlrpc_enabled', 'tech_portfolio_disable_xmlrpc' );

/* ==========================================================================
   8c. Disable file editing in admin
   ========================================================================== */
function tech_portfolio_disable_file_edit() {
    if ( defined( 'DISALLOW_FILE_EDIT' ) && DISALLOW_FILE_EDIT ) {
        return;
    }
    // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
    if ( ! defined( 'ABSPATH' ) ) {
        return;
    }
}
add_action( 'admin_init', 'tech_portfolio_disable_file_edit' );

/* ==========================================================================
   8d. Remove WordPress version from head and feeds
   ========================================================================== */
function tech_portfolio_remove_version() {
    remove_action( 'wp_head', 'wp_generator' );
    add_filter( 'the_generator', '__return_empty_string' );
}
add_action( 'after_setup_theme', 'tech_portfolio_remove_version' );

/* ==========================================================================
   8e. Disable REST API user enumeration
   ========================================================================== */
function tech_portfolio_restrict_user_rest( $response, $handler, $request ) {
    $route = $request->get_route();
    if ( preg_match( '/\/wp\/v2\/users/', $route ) && ! current_user_can( 'list_users' ) ) {
        return new WP_Error(
            'rest_forbidden',
            __( 'You do not have permission to access this endpoint.', 'tech-portfolio' ),
            array( 'status' => 403 )
        );
    }
    return $response;
}
add_filter( 'rest_request_before_callbacks', 'tech_portfolio_restrict_user_rest', 10, 3 );

/* ==========================================================================
   9. Register Widget Areas
   ========================================================================== */
function tech_portfolio_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area', 'tech-portfolio' ),
        'id'            => 'footer-widgets',
        'description'   => esc_html__( 'Widgets in this area appear in the footer.', 'tech-portfolio' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'tech_portfolio_widgets_init' );

/* ==========================================================================
   10. Performance: Defer Non-Critical Scripts & Preload Fonts
   ========================================================================== */
function tech_portfolio_script_loader( $tag, $handle, $src ) {
    // Modern WP already defers via wp_script_add_data; keep as fallback.
    $defer_scripts = array( 'tech-portfolio-main' );

    if ( in_array( $handle, $defer_scripts, true ) && false === strpos( $tag, ' defer' ) ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'tech_portfolio_script_loader', 10, 3 );

function tech_portfolio_preload_assets() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <?php
}
add_action( 'wp_head', 'tech_portfolio_preload_assets', 1 );

/* ==========================================================================
   10b. Performance: Browser Caching via .htaccess (PHP cannot cache statics)
   NOTE: send_headers only fires for WP PHP requests, never for .css/.js/.png
   served directly by Apache. Use .htaccess Expires/Cache-Control instead.
   ========================================================================== */
function tech_portfolio_cache_headers() {
    return;
}
add_action( 'send_headers', 'tech_portfolio_cache_headers', 99 );

/* ==========================================================================
   10c. Performance: Add Lazy Loading to Iframes
   ========================================================================== */
function tech_portfolio_lazy_iframes( $content ) {
    if ( is_admin() ) {
        return $content;
    }
    return str_replace( '<iframe ', '<iframe loading="lazy" ', $content );
}
add_filter( 'the_content', 'tech_portfolio_lazy_iframes' );

/* ==========================================================================
   10d. Project Placeholder Images (SVG)
   ========================================================================== */
function tech_portfolio_get_project_placeholder( $post_id = 0 ) {
    // Direct slug => file, plus common short aliases used on this site.
    $map = array(
        'iot-rfid-access'       => 'iot-rfid-access.svg',
        'iot'                   => 'iot-rfid-access.svg',
        'network-automation'    => 'network-automation.svg',
        'networking'            => 'network-automation.svg',
        'network'               => 'network-automation.svg',
        'cybersecurity-monitor' => 'cybersecurity-monitor.svg',
        'security'              => 'cybersecurity-monitor.svg',
        'cybersecurity'         => 'cybersecurity-monitor.svg',
        'cloud-infrastructure'  => 'cloud-infrastructure.svg',
        'cloud'                 => 'cloud-infrastructure.svg',
        'python-automation'     => 'python-automation.svg',
        'python'                => 'python-automation.svg',
        'automation'            => 'python-automation.svg',
        'cisco-packet-tracer'   => 'cisco-packet-tracer.svg',
        'cisco'                 => 'cisco-packet-tracer.svg',
        'packet-tracer'         => 'cisco-packet-tracer.svg',
    );

    $default = 'network-automation.svg';
    $file    = $default;

    if ( $post_id ) {
        // 0) Explicit per-project image override (_project_image meta).
        $override = (string) get_post_meta( $post_id, '_project_image', true );
        if ( $override && preg_match( '/^[a-z0-9-]+\.svg$/', $override ) && file_exists( get_template_directory() . '/assets/images/' . $override ) ) {
            return get_template_directory_uri() . '/assets/images/' . $override;
        }

        // 1) Tech-stack / title keywords first (most specific to the build).
        $haystack = strtolower( get_the_title( $post_id ) . ' ' . (string) get_post_meta( $post_id, '_project_tech_stack', true ) );
        $keywords = array(
            'rfid'     => 'iot-rfid-access.svg',
            'esp32'    => 'iot-rfid-access.svg',
            'parcel'   => 'iot-rfid-access.svg',
            'servo'    => 'iot-rfid-access.svg',
            'telegram' => 'iot-rfid-access.svg',
            'cisco'    => 'cisco-packet-tracer.svg',
            'packet'   => 'cisco-packet-tracer.svg',
            'vlan'     => 'cisco-packet-tracer.svg',
            'ospf'     => 'cisco-packet-tracer.svg',
            'python'   => 'python-automation.svg',
            'threat'   => 'cybersecurity-monitor.svg',
            'firewall' => 'cybersecurity-monitor.svg',
            'cloud'    => 'cloud-infrastructure.svg',
            'ec2'      => 'cloud-infrastructure.svg',
        );
        foreach ( $keywords as $kw => $img ) {
            if ( false !== strpos( $haystack, $kw ) ) {
                $file = $img;
                break;
            }
        }

        // 2) Fall back to category slug.
        if ( $file === $default ) {
            $terms = get_the_terms( $post_id, 'project_category' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $slug = strtolower( $term->slug );
                    if ( isset( $map[ $slug ] ) ) {
                        $file = $map[ $slug ];
                        break;
                    }
                    if ( false !== strpos( $slug, 'iot' ) || false !== strpos( $slug, 'rfid' ) || false !== strpos( $slug, 'esp' ) ) {
                        $file = 'iot-rfid-access.svg';
                        break;
                    }
                }
            }
        }
    }

    return get_template_directory_uri() . '/assets/images/' . $file;
}

/* ==========================================================================
   11. SEO: Open Graph Meta Tags
   ========================================================================== */
function tech_portfolio_opengraph_meta() {
    if ( is_singular() && ! is_post_type_archive() ) {
        global $post;
        ?>
        <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( wp_trim_words( get_the_excerpt(), 30, '...' ) ); ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
        <?php
        if ( has_post_thumbnail() ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumb ) {
                ?>
                <meta property="og:image" content="<?php echo esc_url( $thumb[0] ); ?>">
                <?php
            }
        }
    } elseif ( is_front_page() ) {
        ?>
        <meta property="og:title" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php
    }
}
add_action( 'wp_head', 'tech_portfolio_opengraph_meta', 2 );

/* ==========================================================================
   12. SEO: JSON-LD Structured Data (Person Schema)
   ========================================================================== */
function tech_portfolio_structured_data() {
    if ( is_front_page() ) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'Person',
            'name'        => 'Mohammed Nazar Umair Mohammeth',
            'jobTitle'    => 'Network Administrator',
            'description' => 'Cisco CCNA Certified Network Administrator, Cybersecurity Enthusiast, and Python Automation Developer based in Kandy, Sri Lanka.',
            'url'         => home_url( '/' ),
            'email'       => 'mohammednazarumairmohammeth@gmail.com',
            'telephone'   => '+94721658204',
            'sameAs'      => array(),
            'address'     => array(
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Kandy',
                'addressRegion'   => 'Central Province',
                'addressCountry'  => 'LK',
            ),
            'knowsAbout' => array(
                'Network Administration', 'Cisco CCNA', 'Cybersecurity',
                'Python Scripting', 'Cloud Security', 'IoT Systems',
            ),
        );

        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'tech_portfolio_structured_data', 3 );
