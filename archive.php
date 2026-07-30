<?php
/**
 * The template for displaying archive pages.
 */

get_header(); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php if ( have_posts() ) : ?>
                <header class="page-header mb-5 border-left border-warning ps-3">
                    <h1 class="page-title text-white fw-bold">
                        <?php the_archive_title(); ?>
                    </h1>
                    <div class="text-secondary small">
                        <?php the_archive_description(); ?>
                    </div>
                </header>

                <div class="row g-4">
                    <?php
                    while ( have_posts() ) : the_post();
                        ?>
                        <div class="col-md-6">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('card-custom h-100 d-flex flex-column'); ?>>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'w-100', 'style' => 'height: 200px; object-fit: cover;')); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <h2 class="h5 mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="text-secondary small mb-3"><?php echo get_the_date(); ?></div>
                                    <p class="text-muted small flex-grow-1"><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="text-warning small fw-bold mt-auto" style="text-decoration:none;">Đọc bài viết →</a>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>

                <div class="mt-5">
                    <?php
                    the_posts_navigation( array(
                        'prev_text' => __( '« Bài trước', '5pc-clone' ),
                        'next_text' => __( 'Bài tiếp »', '5pc-clone' ),
                    ) );
                    ?>
                </div>
            <?php else : ?>
                <p class="text-white"><?php esc_html_e( 'Không có bài viết nào trong danh mục này.', '5pc-clone' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
