<style>
    body {
        margin: 0;
        font-family: "Plus Jakarta Sans", sans-serif;
    }

    .navbar {
        display: grid;
        grid-template-columns: auto 1fr auto;
        color: black;
        align-items: center;
        background-color: #95eb50;
        padding: 5px 15px;
    }

    a {
        text-decoration: none;
        color: black;
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
    }

    nav a:hover {
        background-color: rgb(87, 134, 48);
        transition: 0.3s;
    }

    nav .icons {
        display: flex;
        gap: 30px;
    }

    main .poster {
        position: relative;
        justify-self: center;
    }

    .poster button {
        position: absolute;
        bottom: 100px;
        left: 265px;
        width: 360px;
        background-color: #EEFF6B;
        border-radius: 15px;
        border: none;
        font-size: 2rem;
        padding: 15px 20px;
    }

    .poster button:hover {
        background-color: rgb(130, 145, 12);
        transition: 0.3s;
    }
</style>

<body>
    <header class="navbar">
        <a href="{{ route('dashboard') }}">
            <h2>Eco-Seed</h2>
        </a>
        <nav>
            <nav>
                <a href="{{ route('donate.form') }}">Donate</a>
                <a href="{{ route('articles.index') }}">News</a>
                <a href="#">Merch</a>
                <a href="#">Plant Cart</a>
                <a href="#">Seeds</a>
                <a href="#">Campaign</a>
                <a href="#">Marketplace</a>
            </nav>

        </nav>
        <div class="icons">
            <img src="images/notifications-24px 1.svg" alt="">
            <img src="images/settings-24px 1.svg" alt="">
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <img src="images/Ellipse 14.png" alt="Logout" />
                </button>
            </form>
        </div>
    </header>
    <main>
        <div class="poster">
            <img src="images/donation-image.png" alt="">
            <button> Donate Now</button>
        </div>

    </main>
</body>

</html>