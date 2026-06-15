<?php
/**
 * The template for displaying projects archive pages
 *
 * @package TechPortfolio
 */

get_header(); ?>

<section class="section page-hero" style="background: linear-gradient(180deg, rgba(212, 175, 55, 0.03) 0%, transparent 100%); padding: 100px 0 60px;">
    <div class="container">
        <h1 class="hero-title" style="margin-bottom: 16px;"><?php esc_html_e( 'Projects', 'tech-portfolio' ); ?></h1>
        <p class="hero-description" style="max-width: 700px; font-size: 1.1rem; margin-bottom: 0;">
            Open-source projects, automation tools, and IoT systems — live from GitHub.
        </p>
    </div>
</section>

<section class="section archive-section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <?php echo do_shortcode( '[github_projects]' ); ?>
    </div>
</section>

<?php if ( have_posts() ) : ?>
<section class="section" style="border-top: 1px solid var(--border-gray);">
    <div class="container">
        <h2 class="section-title" style="margin-bottom: 40px;"><?php esc_html_e( 'Case Studies & Details', 'tech-portfolio' ); ?></h2>

        <?php
        $terms = get_terms( array(
            'taxonomy'   => 'project_category',
            'hide_empty' => true,
        ) );
        
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
            <div class="archive-filters">
                <button class="filter-btn active" data-filter="all"><?php esc_html_e( 'All', 'tech-portfolio' ); ?></button>
                <?php foreach ( $terms as $term ) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>">
                        <?php echo esc_html( $term->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="projects-grid" id="portfolio-grid">
            <?php while ( have_posts() ) : the_post();
                $role       = get_post_meta( get_the_ID(), '_project_role', true );
                $post_terms = get_the_terms( get_the_ID(), 'project_category' );
                $term_slugs = array();
                if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
                    foreach ( $post_terms as $post_term ) {
                        $term_slugs[] = $post_term->slug;
                    }
                }
                $class_string = implode( ' ', $term_slugs );
                ?>
                <article class="project-card <?php echo esc_attr( $class_string ); ?>" data-categories="<?php echo esc_attr( implode( ',', $term_slugs ) ); ?>">
                    <div class="project-card-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php else : ?>
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: #151515; color:#333;">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M16.5 9.4 7.55 4.24a1.79 1.79 0 0 0-1.8 0L3 5.82a1.79 1.79 0 0 0-.9 1.56v6.84a1.8 1.8 0 0 0 .9 1.56l8.05 4.64a1.8 1.8 0 0 0 1.8 0l8.05-4.64a1.8 1.8 0 0 0 .9-1.56v-6.84a1.8 1.8 0 0 0-.9-1.56z"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="project-card-content">
                        <span class="project-card-meta">
                            <?php echo esc_html( $role ? $role : 'Project Scope' ); ?>
                        </span>
                        <h3 class="project-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="project-card-excerpt">
                            <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="project-card-link"><?php esc_html_e( 'View Details', 'tech-portfolio' ); ?></a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const projectCards = document.querySelectorAll('#portfolio-grid .project-card');
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        const filterValue = this.getAttribute('data-filter');
                        projectCards.forEach(card => {
                            if (filterValue === 'all') {
                                card.style.display = 'flex';
                            } else {
                                const cardCats = card.getAttribute('data-categories').split(',');
                                card.style.display = cardCats.includes(filterValue) ? 'flex' : 'none';
                            }
                        });
                    });
                });
            });
        </script>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
