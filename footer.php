    <!-- Footer -->
    <footer class="py-5" style="background-color:#07080a; border-top: 1px solid var(--h-color-border);">
        <div class="container text-center text-md-start">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold text-warning mb-3"><?php bloginfo( 'name' ); ?></h5>
                    <p class="text-secondary small"><?php bloginfo( 'description' ); ?></p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold text-white mb-3">Liên kết nhanh</h6>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-footer',
                            'container'      => false,
                            'menu_class'     => 'list-unstyled text-secondary small d-flex flex-column gap-2',
                            'fallback_cb'    => '__return_false',
                        )
                    );
                    ?>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold text-white mb-3">Mạng xã hội</h6>
                    <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                        <a href="#" class="text-secondary hover-warning small">Facebook</a>
                        <a href="#" class="text-secondary hover-warning small">Telegram</a>
                        <a href="#" class="text-secondary hover-warning small">Youtube</a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-25">
            <div class="text-center text-secondary small">
                © <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. Custom theme designed by AI.
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
