<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Seed | @yield('title', 'Campaigns')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <a href="{{ route('dashboard') }}"><h2>Eco-Seed</h2></a>
        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="#">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="{{ route('campaigns.index') }}">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="">
        </div>
    </header>

    @yield('content')

    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            display: grid;
            grid-template-columns: auto 1fr auto;
            color: black;
            align-items: center;
            background-color: #95eb50;
            padding: 5px 15px;
        }

        nav {
            display: inline-flex;
            justify-content: center;
            gap: 10px;
        }

        nav a {
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            padding: 20px 10px;
            text-decoration: none;
            color: black;
        }

        nav a:hover {
            background-color: rgb(87, 134, 48);
            transition: 0.3s;
        }

        .icons {
            display: flex;
            gap: 30px;
        }
    </style>
</head>
</html>