@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

<div id="app">
    <header class="navbar">
        <a href="{{ route('cart') }}">
            <h2>Back</h2>
        </a>
        <nav>
        </nav>
        <div class="icons">
            <img src="images/settings-24px 1.svg" alt="">
            <img src="images/Ellipse 14.png" alt="">
        </div>
    </header>
    <div class="border-box">
        <div class="header">
            <span class="icon">📍</span>Alamat Pengiriman
        </div>
        <div>
            <strong>Rumah Bandung · Anas</strong><br>
            Private village cluster Seminyak C1 no 3, Jl Cikoneng, Bojongsoang, Kabupaten Bandung, Jawa Barat,
            40288,
            Bojong Soang, Kab. Bandung, Jawa Barat, 6281385418451
        </div>
    </div>

    <div class="border-box">
        <div class="header">
            <span>Cygnus Shop</span>
        </div>
        <div class="item">
            <img src="{{ asset('images/product-image_placeholder.png') }}" alt="Product Image" class="product-image"
                width="50" height="50">
            <div>
                GATERON Magnetic Jade Series Jade / Jade Pro / Jade Gaming / Jade Max Keyboard Switch Set<br>
                <span>Jade GAMING</span>
            </div>
            <div style="margin-left: auto;">
                <strong>1 x Rp9.449</strong>
            </div>
        </div>

        <div class="border-box" style="background-color: #ffffff;">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">More</a>
                <div class="dropdown-menu">
                    <a href="#">Plant Cart</a>
                    <a href="#">Seeds</a>
                    <a href="#">Campaign</a>
                    <a href="#">Marketplace</a>
                </div>
            </div>
            </nav>
        </div>
    </div>
</div>