<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Seed | @yield('title', 'Default Title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    @stack('styles')

    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            background-color: #95eb50;
            padding: 10px 20px;
        }

        .navbar h2 {
            margin: 0;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        nav a {
            text-decoration: none;
            color: black;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            padding: 15px 10px;
        }

        nav a:hover {
            background-color: rgb(87, 134, 48);
            transition: 0.3s;
        }

        .icons {
            display: flex;
            gap: 20px;
        }

        .icons img {
            width: 24px;
            height: 24px;
        }

        .container {
            padding: 30px;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="{{ route('dashboard') }}">
            <h2>Eco-Seed</h2>
        </a>
        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="{{ route('articles.index') }}">News</a>
            <a href="#">Merch</a>
            <a href="{{ route('cart') }}">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="{{ route('campaign.index') }}">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="">
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
