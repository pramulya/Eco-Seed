<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <title>Eco-Seed</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
=======
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
>>>>>>> Surya_Branch
        }

        .navbar {
            display: grid;
            grid-template-columns: auto 1fr auto;
<<<<<<< HEAD
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
=======
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
>>>>>>> Surya_Branch
        }

        nav a:hover {
            background-color: rgb(87, 134, 48);
            transition: 0.3s;
        }

        .icons {
            display: flex;
<<<<<<< HEAD
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
    @livewireStyles
</head>

<body>

    <header class="navbar">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: black;">
            <h2>Eco-Seed</h2>

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
    @livewireScripts
</body>

=======
            gap: 30px;
        }
    </style>
</head>
>>>>>>> Surya_Branch
</html>