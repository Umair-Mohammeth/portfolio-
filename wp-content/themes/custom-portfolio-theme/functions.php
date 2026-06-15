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

    // Register primary navigation menu.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'tech-portfolio' ),
    ) );
}
add_action( 'after_setup_theme', 'tech_portfolio_setup' );

/* ==========================================================================
   2. Enqueue Styles
   ========================================================================== */
function tech_portfolio_scripts() {
    // Enqueue main stylesheet.
    wp_enqueue_style( 'tech-portfolio-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'tech_portfolio_scripts' );

/* ==========================================================================
   3. Register Custom Post Type (Projects)
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
   4. Register Custom Taxonomy (Project Categories)
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
   5. Secure Meta Boxes for CPT Metadata
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
    <?php
}

function tech_portfolio_save_project_meta_data( $post_id ) {
    // Check if nonce is set.
    if ( ! isset( $_POST['tech_portfolio_project_meta_nonce'] ) ) {
        return;
    }

    // Verify nonce.
    if ( ! wp_verify_nonce( $_POST['tech_portfolio_project_meta_nonce'], 'tech_portfolio_save_project_meta' ) ) {
        return;
    }

    // Check permissions.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['post_type'] ) && 'projects' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    } else {
        return;
    }

    // Sanitize and save data.
    if ( isset( $_POST['project_role'] ) ) {
        update_post_meta( $post_id, '_project_role', sanitize_text_field( $_POST['project_role'] ) );
    }

    if ( isset( $_POST['project_tech_stack'] ) ) {
        update_post_meta( $post_id, '_project_tech_stack', sanitize_text_field( $_POST['project_tech_stack'] ) );
    }

    if ( isset( $_POST['project_github_url'] ) ) {
        update_post_meta( $post_id, '_project_github_url', esc_url_raw( $_POST['project_github_url'] ) );
    }

    if ( isset( $_POST['project_live_url'] ) ) {
        update_post_meta( $post_id, '_project_live_url', esc_url_raw( $_POST['project_live_url'] ) );
    }
}
add_action( 'save_post', 'tech_portfolio_save_project_meta_data' );

/* ==========================================================================
   6. GitHub API Helper & Shortcode
   ========================================================================== */
function tech_portfolio_fetch_github_repos( $username = 'Umair-Mohammeth' ) {
    $cache_key = 'tech_portfolio_github_repos_' . $username;
    $repos     = get_transient( $cache_key );

    if ( false === $repos ) {
        $response = wp_remote_get( "https://api.github.com/users/{$username}/repos?sort=updated&per_page=20" );

        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
            return array();
        }

        $body  = wp_remote_retrieve_body( $response );
        $repos = json_decode( $body, true );

        if ( ! is_array( $repos ) ) {
            return array();
        }

        // Filter out forks and archived repos
        $repos = array_filter( $repos, function( $repo ) {
            return ! $repo['fork'] && ! $repo['archived'];
        });

        set_transient( $cache_key, $repos, HOUR_IN_SECONDS );
    }

    return $repos;
}

function tech_portfolio_render_github_projects( $atts = array() ) {
    $atts = shortcode_atts( array(
        'username' => 'Umair-Mohammeth',
        'count'    => 0,
    ), $atts );

    $repos = tech_portfolio_fetch_github_repos( $atts['username'] );

    if ( empty( $repos ) ) {
        return '<p style="color: var(--text-gray); font-style: italic;">Unable to fetch GitHub repositories at this time.</p>';
    }

    if ( $atts['count'] > 0 ) {
        $repos = array_slice( $repos, 0, $atts['count'] );
    }

    $repo_image_map = array(
        'ESC-POS'                     => 'esc-pos.svg',
        'ESC-POS---windows-base'      => 'esc-pos-windows.svg',
        'Smart-Door-Delivery-Authentication-System' => 'smart-door.svg',
        'School-Scheme-of-Work-Generator-' => 'school-scheme.svg',
        'Redirect-extension-'         => 'redirect-extension.svg',
        'health-ease-manage'          => 'health-ease.svg',
        'Word-Checker'                => 'word-checker.svg',
    );
    $assets_url = get_template_directory_uri() . '/../assets/images/projects';

    ob_start();
    ?>
    <div class="projects-grid" id="github-projects-grid">
        <?php foreach ( $repos as $repo ) :
            $name        = $repo['name'] ?? '';
            $description = $repo['description'] ?? '';
            $language    = $repo['language'] ?? '';
            $stars       = $repo['stargazers_count'] ?? 0;
            $updated     = isset( $repo['pushed_at'] ) ? human_time_diff( strtotime( $repo['pushed_at'] ), current_time( 'timestamp' ) ) . ' ago' : '';
            $github_url  = $repo['html_url'] ?? '#';
            $homepage    = $repo['homepage'] ?? '';
            $repo_image  = isset( $repo_image_map[ $name ] ) ? $assets_url . '/' . $repo_image_map[ $name ] : '';
        ?>
        <article class="project-card">
            <div class="project-card-image" style="display:flex; align-items:center; justify-content:center; background: #151515; color:#333; overflow:hidden;">
                <?php if ( $repo_image ) : ?>
                    <img src="<?php echo esc_url( $repo_image ); ?>" alt="<?php echo esc_attr( $name ); ?>" style="width:100%; height:100%; object-fit:cover;">
                <?php else : ?>
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M16.5 9.4 7.55 4.24a1.79 1.79 0 0 0-1.8 0L3 5.82a1.79 1.79 0 0 0-.9 1.56v6.84a1.8 1.8 0 0 0 .9 1.56l8.05 4.64a1.8 1.8 0 0 0 1.8 0l8.05-4.64a1.8 1.8 0 0 0 .9-1.56v-6.84a1.8 1.8 0 0 0-.9-1.56z"/>
                    </svg>
                <?php endif; ?>
            </div>
            <div class="project-card-content">
                <span class="project-card-meta"><?php echo esc_html( $language ? $language : 'Various' ); ?></span>
                <h3 class="project-card-title">
                    <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $name ); ?></a>
                </h3>
                <div class="project-card-excerpt">
                    <?php echo esc_html( $description ? wp_trim_words( $description, 18 ) : 'No description provided.' ); ?>
                </div>
                <div style="display:flex; gap:12px; align-items:center; margin-bottom:16px; font-size:0.85rem; color:var(--text-gray); font-family:var(--font-mono);">
                    <span>&#9733; <?php echo intval( $stars ); ?></span>
                    <span>&#9679; Updated <?php echo esc_html( $updated ); ?></span>
                </div>
                <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener noreferrer" class="project-card-link"><?php esc_html_e( 'View Repository', 'tech-portfolio' ); ?></a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'github_projects', 'tech_portfolio_render_github_projects' );
