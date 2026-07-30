<?php
/**
 * The template for displaying the front page.
 */

get_header(); ?>

    <!-- Welcome Section (Hero Area) -->
    <section class="hero-section container mt-4">
        <div class="row g-4">
            <!-- Left Slider (Featured Posts) -->
            <div class="col-lg-8">
                <div class="swiper swiper-container" id="welcome-swiper">
                    <div class="swiper-wrapper">
                        <?php
                        // Query for slider posts (let's assume tag 'featured' or just latest posts)
                        $slider_query = new WP_Query( array(
                            'posts_per_page' => 3,
                            'post_status'    => 'publish'
                        ) );

                        if ( $slider_query->have_posts() ) :
                            while ( $slider_query->have_posts() ) : $slider_query->the_post();
                                $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                if ( !$thumb_url ) {
                                    $thumb_url = 'https://images.unsplash.com/photo-1621761191319-c6fb62004040?auto=format&fit=crop&w=1200&q=80';
                                }
                                $categories = get_the_category();
                                $category_name = !empty($categories) ? $categories[0]->name : 'Crypto';
                                ?>
                                <div class="swiper-slide" style="background-image: url('<?php echo esc_url($thumb_url); ?>');">
                                    <div class="swiper-slide-overlay">
                                        <span class="swiper-slide-tag"><?php echo esc_html($category_name); ?></span>
                                        <h2 class="swiper-slide-title">
                                            <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="swiper-slide-meta"><?php echo get_the_date(); ?> • <?php the_author(); ?></div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // Fallback mock slider
                            ?>
                            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1621761191319-c6fb62004040?auto=format&fit=crop&w=1200&q=80');">
                                <div class="swiper-slide-overlay">
                                    <span class="swiper-slide-tag">Pháp lý</span>
                                    <h2 class="swiper-slide-title">Hướng dẫn đóng thuế Crypto tại Việt Nam chi tiết nhất 2026</h2>
                                    <div class="swiper-slide-meta">30 Tháng 7, 2026 • 5 phút đọc</div>
                                </div>
                            </div>
                            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1622790698141-94e30457ef12?auto=format&fit=crop&w=1200&q=80');">
                                <div class="swiper-slide-overlay">
                                    <span class="swiper-slide-tag">Chuyên sâu</span>
                                    <h2 class="swiper-slide-title">Bitcoin Halving hoạt động thế nào và tác động dài hạn ra sao?</h2>
                                    <div class="swiper-slide-meta">28 Tháng 7, 2026 • 8 phút đọc</div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            
            <!-- Right Tabbed List -->
            <div class="col-lg-4">
                <div class="welcome-list-container">
                    <div class="welcome-list-tabs">
                        <div class="welcome-tab active" id="tab-new-btn">Mới nhất</div>
                        <div class="welcome-tab" id="tab-hot-btn">Xem nhiều</div>
                    </div>
                    <div class="welcome-list-scroll" id="tabbed-post-list-wp">
                        <?php
                        // Latest posts query
                        $latest_query = new WP_Query( array(
                            'posts_per_page' => 4,
                            'post_status'    => 'publish'
                        ) );

                        if ( $latest_query->have_posts() ) :
                            while ( $latest_query->have_posts() ) : $latest_query->the_post();
                                $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                                if ( !$thumb_url ) {
                                    $thumb_url = 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=120&q=80';
                                }
                                ?>
                                <div class="welcome-post-item">
                                    <img src="<?php echo esc_url($thumb_url); ?>" class="welcome-post-img" alt="<?php the_title_attribute(); ?>">
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="welcome-post-title text-white"><?php the_title(); ?></a>
                                        <small class="text-secondary"><?php echo get_the_date(); ?></small>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // Fallback mock items
                            for ($i = 1; $i <= 3; $i++) {
                                echo '
                                <div class="welcome-post-item">
                                    <img src="https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=120&q=80" class="welcome-post-img" alt="post">
                                    <div>
                                        <a href="#" class="welcome-post-title text-white">Cách tối ưu hóa phí gas Ethereum với các giải pháp Layer 2</a>
                                        <small class="text-secondary">30 Tháng 7</small>
                                    </div>
                                </div>';
                            }
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Three Categories Grid -->
    <section class="container py-5">
        <div class="row g-4">
            <?php
            // We can retrieve 3 categories. If they don't exist, fallback to static mock UI
            $categories_to_show = get_categories( array( 'number' => 3 ) );
            
            if ( !empty($categories_to_show) && count($categories_to_show) >= 3 ) :
                foreach ( $categories_to_show as $cat ) :
                    ?>
                    <div class="col-md-4">
                        <h4 class="category-header"><?php echo esc_html($cat->name); ?></h4>
                        <?php
                        $cat_posts = new WP_Query( array(
                            'cat'            => $cat->term_id,
                            'posts_per_page' => 3
                        ) );

                        $first = true;
                        if ( $cat_posts->have_posts() ) :
                            while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
                                if ( $first ) :
                                    $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                                    if ( !$thumb_url ) $thumb_url = 'https://images.unsplash.com/photo-1640340434855-6084b1f4901c?auto=format&fit=crop&w=500&q=80';
                                    ?>
                                    <div class="card-custom mb-3">
                                        <img src="<?php echo esc_url($thumb_url); ?>" class="w-100" style="height:180px; object-fit:cover;" alt="<?php the_title_attribute(); ?>">
                                        <div class="p-3">
                                            <h5 class="fs-6 fw-bold mb-2">
                                                <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a>
                                            </h5>
                                            <p class="text-muted small mb-0"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    $first = false;
                                else :
                                    ?>
                                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                                        <span class="text-warning fw-bold small">•</span>
                                        <a href="<?php the_permalink(); ?>" class="small fw-semibold text-white"><?php the_title(); ?></a>
                                    </div>
                                    <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <?php
                endforeach;
            else :
                // Fallback static structure (same as in demo.html)
                ?>
                <!-- Category 1 Fallback -->
                <div class="col-md-4">
                    <h4 class="category-header">Kinh nghiệm Giao dịch</h4>
                    <div class="card-custom mb-3">
                        <img src="https://images.unsplash.com/photo-1640340434855-6084b1f4901c?auto=format&fit=crop&w=500&q=80" class="w-100" style="height:180px; object-fit:cover;" alt="Post">
                        <div class="p-3">
                            <h5 class="fs-6 fw-bold mb-2">5 nguyên tắc quản lý vốn xương máu khi trade Futures</h5>
                            <p class="text-muted small mb-0">Học cách bảo vệ tài khoản của bạn trước những biến động cực lớn...</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">01</span>
                        <a href="#" class="small fw-semibold text-white">Cách nhận diện sàn giao dịch Scam/Lừa đảo</a>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">02</span>
                        <a href="#" class="small fw-semibold text-white">Top 3 ví lạnh an toàn nhất thời điểm hiện tại</a>
                    </div>
                </div>
                
                <!-- Category 2 Fallback -->
                <div class="col-md-4">
                    <h4 class="category-header">Phân tích Cơ bản</h4>
                    <div class="card-custom mb-3">
                        <img src="https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=500&q=80" class="w-100" style="height:180px; object-fit:cover;" alt="Post">
                        <div class="p-3">
                            <h5 class="fs-6 fw-bold mb-2">Đánh giá tiềm năng Layer 2: Arbitrum vs Optimism</h5>
                            <p class="text-muted small mb-0">So sánh chi tiết về TVL, tốc độ xử lý và khả năng mở rộng của...</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">01</span>
                        <a href="#" class="small fw-semibold text-white">Tokenomics là gì? 4 yếu tố cần soi kỹ khi mua token</a>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">02</span>
                        <a href="#" class="small fw-semibold text-white">Cách đọc whitepaper một dự án Crypto trong 10 phút</a>
                    </div>
                </div>

                <!-- Category 3 Fallback -->
                <div class="col-md-4">
                    <h4 class="category-header">Airdrop & Retroactive</h4>
                    <div class="card-custom mb-3">
                        <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=500&q=80" class="w-100" style="height:180px; object-fit:cover;" alt="Post">
                        <div class="p-3">
                            <h5 class="fs-6 fw-bold mb-2">Săn kèo Retroactive trên testnet mới của Scroll</h5>
                            <p class="text-muted small mb-0">Hướng dẫn từng bước cày volume và tương tác hợp đồng thông minh...</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">01</span>
                        <a href="#" class="small fw-semibold text-white">Cách chống Sybil hiệu quả khi cày nhiều ví airdrop</a>
                    </div>
                    <div class="d-flex align-items-center gap-2 border-top border-secondary py-2">
                        <span class="text-warning fw-bold small">02</span>
                        <a href="#" class="small fw-semibold text-white">Hướng dẫn Claim Airdrop dự án mới nhất</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Custom Video Playlist Section -->
    <section class="video-section">
        <div class="container">
            <h3 class="category-header mb-4">Video Tiêu Điểm</h3>
            <div class="row g-4">
                <!-- Left Video Player -->
                <div class="col-lg-8">
                    <div class="video-player-wrapper">
                        <iframe id="main-video-player" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <!-- Right Playlist Scroll -->
                <div class="col-lg-4">
                    <div class="video-playlist-container">
                        <h5 class="fw-bold mb-3" style="color: var(--h-color-yellow);">Danh sách phát hot</h5>
                        <div class="video-playlist-scroll" id="youtube-playlist">
                            <!-- Populated dynamically via assets/js/custom.js -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
