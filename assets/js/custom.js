/**
 * Custom JavaScript for 5 Phút Crypto Theme
 * Handles Swiper, Coin Marquee, and YouTube Video Playlist.
 */
jQuery(document).ready(function($) {
    // 1. Initialize Swiper Slider if element exists
    if ($('#welcome-swiper').length > 0) {
        new Swiper('#welcome-swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            }
        });
    }

    // 2. YouTube Video Playlist Player
    const playlistData = [
        { id: "dQw4w9WgXcQ", title: "Bài 1: Kiến thức Crypto nền tảng cho người mới bắt đầu", thumb: "https://images.unsplash.com/photo-1621761191319-c6fb62004040?auto=format&fit=crop&w=120&q=80" },
        { id: "L_LUpnjgPso", title: "Bài 2: Hướng dẫn bảo mật ví nóng & ví lạnh an toàn 100%", thumb: "https://images.unsplash.com/photo-1640340434855-6084b1f4901c?auto=format&fit=crop&w=120&q=80" },
        { id: "9sWn8w1qBsw", title: "Bài 3: Cách đọc biểu đồ kỹ thuật & Price Action đơn giản", thumb: "https://images.unsplash.com/photo-1622790698141-94e30457ef12?auto=format&fit=crop&w=120&q=80" }
    ];

    const $playlistContainer = $('#youtube-playlist');
    if ($playlistContainer.length > 0) {
        $playlistContainer.html(playlistData.map((video, index) => `
            <div class="video-item ${index === 0 ? 'active' : ''}" data-id="${video.id}">
                <img src="${video.thumb}" class="video-thumbnail" alt="video thumb">
                <div class="video-title text-white">${video.title}</div>
            </div>
        `).join(''));

        // Handle item click
        $(document).on('click', '.video-item', function() {
            const videoId = $(this).data('id');
            $('#main-video-player').attr('src', `https://www.youtube.com/embed/${videoId}?autoplay=1`);
            $('.video-item').removeClass('active');
            $(this).addClass('active');
        });
    }

    // 3. Coin Marquee API Fetch with Local Fallback (Bypass CORS)
    function fetchCoinPrices() {
        const $marquee = $('#coin-marquee');
        if ($marquee.length === 0) return;

        const coinMeta = {
            'BTCUSDT': { name: 'Bitcoin', symbol: 'BTC', icon: 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png', price: 67250.50, change: 2.45 },
            'ETHUSDT': { name: 'Ethereum', symbol: 'ETH', icon: 'https://assets.coingecko.com/coins/images/279/large/ethereum.png', price: 3480.20, change: -1.15 },
            'SOLUSDT': { name: 'Solana', symbol: 'SOL', icon: 'https://assets.coingecko.com/coins/images/4128/large/solana.png', price: 182.40, change: 5.82 },
            'BNBUSDT': { name: 'BNB', symbol: 'BNB', icon: 'https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png', price: 585.90, change: 0.12 },
            'XRPUSDT': { name: 'Ripple', symbol: 'XRP', icon: 'https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white_-blue_200x200.png', price: 0.612, change: -2.34 },
            'ADAUSDT': { name: 'Cardano', symbol: 'ADA', icon: 'https://assets.coingecko.com/coins/images/975/large/cardano.png', price: 0.385, change: 1.05 },
            'DOGEUSDT': { name: 'Dogecoin', symbol: 'DOGE', icon: 'https://assets.coingecko.com/coins/images/325/large/dogecoin.png', price: 0.124, change: 12.45 }
        };

        function renderCoins(dataMap) {
            let marqueeHTML = '';
            const coinsList = Object.keys(dataMap).map(key => ({
                symbol: dataMap[key].symbol,
                icon: dataMap[key].icon,
                price: dataMap[key].price,
                change: dataMap[key].change
            }));
            const doubleCoins = [...coinsList, ...coinsList, ...coinsList];
            
            doubleCoins.forEach(coin => {
                const priceFormatted = coin.price.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                const isUp = coin.change >= 0;
                const changeText = `${isUp ? '+' : ''}${coin.change.toFixed(2)}%`;
                const changeClass = isUp ? 'up' : 'down';
                
                marqueeHTML += `
                    <div class="coin-item">
                        <img src="${coin.icon}" class="coin-icon" alt="${coin.symbol}">
                        <span class="text-white font-bold">${coin.symbol}</span>
                        <span class="text-muted">${priceFormatted}</span>
                        <span class="coin-change ${changeClass}">${changeText}</span>
                    </div>
                `;
            });
            $marquee.html(marqueeHTML);
        }

        // Handle local file system protocol CORS blocks
        if (window.location.protocol === 'file:') {
            for (const key in coinMeta) {
                const change = (Math.random() - 0.5) * 0.2;
                coinMeta[key].price += coinMeta[key].price * (change / 100);
                coinMeta[key].change += change;
            }
            renderCoins(coinMeta);
            return;
        }

        $.ajax({
            url: 'https://api.binance.com/api/v3/ticker/24hr?symbols=["BTCUSDT","ETHUSDT","SOLUSDT","BNBUSDT","XRPUSDT","ADAUSDT","DOGEUSDT"]',
            type: 'GET',
            success: function(data) {
                data.forEach(item => {
                    if (coinMeta[item.symbol]) {
                        coinMeta[item.symbol].price = parseFloat(item.lastPrice);
                        coinMeta[item.symbol].change = parseFloat(item.priceChangePercent);
                    }
                });
                renderCoins(coinMeta);
            },
            error: function() {
                console.warn("Lỗi tải API live, chuyển sang mock data");
                renderCoins(coinMeta);
            }
        });
    }

    // Run Coin Marquee immediately and refresh
    fetchCoinPrices();
    setInterval(fetchCoinPrices, 5000);
});
