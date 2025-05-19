<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
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
            position: relative;
            z-index: 1;
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
    @stack('styles')
</head>
<body>

    <header class="navbar">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: black;"><h2>Eco-Seed</h2>

        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="{{ route('articles.index') }}">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="#">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>

        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="Notifications">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="Settings">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="Profile">
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>
