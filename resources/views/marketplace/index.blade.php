<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Marketplace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            background-color: #95eb50;
            padding: 10px 20px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        nav {
            display: inline-flex;
            justify-content: center;
            gap: 15px;
        }

        nav a {
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            padding: 15px 20px;
        }

        nav a:hover {
            background-color: rgb(87, 134, 48);
            transition: 0.3s;
        }

        .icons {
            display: flex;
            gap: 30px;
        }

        .icons img {
            width: 24px;
            height: 24px;
        }

        main {
            padding: 40px 30px;
        }

        h1 {
            text-align: center;
            font-size: 2.8rem;
            color: #2e2e2e;
            margin-bottom: 40px;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .product-card {
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            padding: 20px;
            text-align: left;
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: scale(1.01);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            margin: 0 0 10px;
            font-size: 1.5rem;
            color: #333;
        }

        .product-card .description {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 10px;
        }

        .product-card .price {
            font-size: 1.1rem;
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-card .stock {
            font-size: 0.95rem;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .product-card .highlights {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 12px;
        }

        .product-card .reviews {
            font-size: 0.9rem;
            color: #f39c12;
            margin-bottom: 15px;
        }

        .product-card .buy-btn {
            display: inline-block;
            background-color: #95eb50;
            color: #000;
            padding: 10px 15px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .product-card .buy-btn:hover {
            background-color: #6ec92e;
        }

        .eco-badges {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .eco-badges span {
            background-color: #e0f7d4;
            color: #33691e;
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @php use Illuminate\Support\Str; @endphp

    <header class="navbar">
        <a href="{{ route('dashboard') }}"><h2>Eco-Seed</h2></a>
        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="#">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="#">Campaign</a>
            <a href="{{ route('marketplace.index') }}">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="notifications">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="settings">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="profile">
        </div>
    </header>

    <main>
        <h1>Eco-Friendly Products</h1>

        {{-- Debug Output (Only for development) --}}
        {{-- @dd($products) --}}

        <div class="product-list">
            @if($products && $products->count())
                @foreach ($products as $product)
                    <div class="product-card">
                        <img 
                            src="{{ asset('images/d14934045f6dfcd2e7415d39d16f774d.jpg' . $product->image_url) }}" 
                            alt="{{ $product->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-image.jpg') }}';"
                        >

                        <h3>{{ $product->name }}</h3>

                        <div class="eco-badges">
                            <span>🌱 Eco-Certified</span>
                            <span>♻️ Recyclable</span>
                            <span>🇲🇾 Local</span>
                        </div>

                        <p class="description">
                            {{ $product->description ? Str::limit($product->description, 100) : 'No description available.' }}
                        </p>

                        <div class="price">
                            ${{ number_format($product->price, 2) }}
                        </div>

                        <div class="stock">
                            @if ($product->stock > 0)
                                In Stock ({{ $product->stock }} available)
                            @else
                                Out of Stock
                            @endif
                        </div>

                        <div class="reviews">
                            {{ $product->average_rating ?? '0.0' }} ★ | {{ $product->reviews_count ?? 0 }} Reviews
                        </div>

                        <a href="{{ route('marketplace.show', $product->id) }}" class="buy-btn">View Details</a>
                    </div>
                @endforeach
            @else
                <p style="text-align: center; font-size: 1.2rem; color: #999;">
                    No products available at the moment.
                </p>
            @endif
        </div>
    </main>
</body>
</html>