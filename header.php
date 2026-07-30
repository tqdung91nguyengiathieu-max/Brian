<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <style>
        /* Header and Nav Overrides */
        body {
            background-color: var(--h-color-bg);
            color: var(--h-color-text-primary);
        }
        header {
            background-color: rgba(11, 12, 16, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--h-color-border);
            z-index: 1000;
        }
        .navbar-brand img {
            height: 48px;
        }
        .nav-link {
            color: var(--h-color-text-secondary) !important;
            font-weight: 500;
            padding: 10px 16px !important;
            transition: var(--h-transition);
        }
        .nav-link:hover, .nav-link.active {
            color: var(--h-color-yellow) !important;
        }
        .marquee-container {
            background-color: var(--h-color-bg-card);
            border-top: 1px solid var(--h-color-border);
            border-bottom: 1px solid var(--h-color-border);
            padding: 12px 0;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .marquee-inner {
            display: inline-flex;
            animation: marquee 30s linear infinite;
            gap: 40px;
        }
        .marquee-inner:hover {
            animation-play-state: paused;
        }
        .coin-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        .coin-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
        .coin-change {
            font-size: 14px;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
        }
        .coin-change.up {
            color: var(--h-color-green);
            background-color: var(--h-color-green-bg);
        }
        .coin-change.down {
            color: var(--h-color-red);
            background-color: var(--h-color-red-bg);
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header Navigation -->
    <header class="position-sticky top-0">
        <nav class="navbar navbar-expand-lg navbar-dark container py-3">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="Brian Crypto Việt Logo" style="height: 45px; width: 45px; object-fit: contain;">
                <span class="fw-bold fs-4" style="letter-spacing: 0.5px; font-family: 'Inter', sans-serif;">
                    <span class="text-white">Brian</span> <span style="color: var(--h-color-yellow);">Crypto Việt</span>
                </span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-main',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav mx-auto',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    )
                );
                ?>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-white p-0" style="text-decoration:none;" data-bs-toggle="collapse" data-bs-target="#searchFormCollapse">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <!-- Collapsible Search Bar -->
        <div class="collapse bg-dark border-top border-secondary py-3" id="searchFormCollapse">
            <div class="container">
                <form role="search" method="get" class="search-form d-flex gap-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="form-control bg-dark text-white border-secondary" placeholder="Tìm kiếm bài viết..." value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="btn btn-yellow">Tìm</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Coin Marquee (Bảng chạy giá coin) -->
    <div class="marquee-container">
        <div class="marquee-inner" id="coin-marquee">
            <!-- Loop 1 -->
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" class="coin-icon" alt="BTC">
                <span class="text-white font-bold">BTC</span> <span class="text-muted">$67,250.50</span> <span class="coin-change up">+2.45%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/279/large/ethereum.png" class="coin-icon" alt="ETH">
                <span class="text-white font-bold">ETH</span> <span class="text-muted">$3,480.20</span> <span class="coin-change down">-1.15%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/4128/large/solana.png" class="coin-icon" alt="SOL">
                <span class="text-white font-bold">SOL</span> <span class="text-muted">$182.40</span> <span class="coin-change up">+5.82%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png" class="coin-icon" alt="BNB">
                <span class="text-white font-bold">BNB</span> <span class="text-muted">$585.90</span> <span class="coin-change up">+0.12%</span>
            </div>
            <!-- Loop 2 -->
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" class="coin-icon" alt="BTC">
                <span class="text-white font-bold">BTC</span> <span class="text-muted">$67,250.50</span> <span class="coin-change up">+2.45%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/279/large/ethereum.png" class="coin-icon" alt="ETH">
                <span class="text-white font-bold">ETH</span> <span class="text-muted">$3,480.20</span> <span class="coin-change down">-1.15%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/4128/large/solana.png" class="coin-icon" alt="SOL">
                <span class="text-white font-bold">SOL</span> <span class="text-muted">$182.40</span> <span class="coin-change up">+5.82%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png" class="coin-icon" alt="BNB">
                <span class="text-white font-bold">BNB</span> <span class="text-muted">$585.90</span> <span class="coin-change up">+0.12%</span>
            </div>
            <!-- Loop 3 -->
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png" class="coin-icon" alt="BTC">
                <span class="text-white font-bold">BTC</span> <span class="text-muted">$67,250.50</span> <span class="coin-change up">+2.45%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/279/large/ethereum.png" class="coin-icon" alt="ETH">
                <span class="text-white font-bold">ETH</span> <span class="text-muted">$3,480.20</span> <span class="coin-change down">-1.15%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/4128/large/solana.png" class="coin-icon" alt="SOL">
                <span class="text-white font-bold">SOL</span> <span class="text-muted">$182.40</span> <span class="coin-change up">+5.82%</span>
            </div>
            <div class="coin-item">
                <img src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png" class="coin-icon" alt="BNB">
                <span class="text-white font-bold">BNB</span> <span class="text-muted">$585.90</span> <span class="coin-change up">+0.12%</span>
            </div>
        </div>
    </div>
