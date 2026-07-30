<?php
/**
 * The template for displaying fallback content.
 */

get_header(); ?>

<div class="container py-5 my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php if ( have_posts() ) : ?>
                <header class="page-header mb-4">
                    <h1 class="page-title border-bottom border-secondary pb-3 text-warning"><?php bloginfo( 'name' ); ?></h1>
                </header>
                <?php
                while ( have_posts() ) : the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card-custom p-4 mb-4'); ?>>
                        <h2 class="h4"><a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a></h2>
                        <div class="text-secondary small mb-3"><?php echo get_the_date(); ?> • <?php the_author(); ?></div>
                        <div class="entry-content text-light opacity-75">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                    <?php
                endwhile;
                the_posts_navigation( array(
                    'prev_text' => __( '« Bài trước', '5pc-clone' ),
                    'next_text' => __( 'Bài tiếp »', '5pc-clone' ),
                ) );
            else :
                ?>
                <p><?php esc_html_e( 'Không tìm thấy nội dung bài viết.', '5pc-clone' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
