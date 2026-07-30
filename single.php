<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php
            while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header mb-4">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<span class="badge bg-warning text-dark mb-2">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                        <h1 class="entry-title text-white fw-bold display-5 mb-3"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta text-secondary small d-flex align-items-center gap-3 border-bottom border-secondary pb-3">
                            <span>Viết bởi <strong><?php the_author(); ?></strong></span>
                            <span>•</span>
                            <span>Đăng ngày <?php echo get_the_date(); ?></span>
                        </div>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail mb-4 rounded overflow-hidden">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'w-100 h-auto' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content text-light lh-lg" style="font-size: 17px; opacity: 0.9;">
                        <?php
                        the_content();
                        ?>
                    </div>

                    <footer class="entry-footer mt-5 pt-3 border-top border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">Thẻ: <?php the_tags( '', ', ', '' ); ?></span>
                        </div>
                    </footer>
                </article>
                <?php
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
