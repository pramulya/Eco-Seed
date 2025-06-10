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
        align-items: center;
    }

    nav a,
    .dropdown > a {
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 10px;
        padding: 20px 10px;
        display: inline-block;
    }

    nav a:hover,
    .dropdown:hover > a {
        background-color: rgb(87, 134, 48);
        transition: 0.3s;
    }

    .icons {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        vertical-align: middle;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 180px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border-radius: 8px;
        margin-top: 5px;
    }

    .dropdown-content a,
    .profile-dropdown-content button {
        color: black;
        padding: 12px 16px;
        display: block;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-content a:hover,
    .profile-dropdown-content button:hover {
        background-color: #e5ffe5;
    }

    .dropdown:hover .dropdown-content,
    .profile-dropdown:hover .profile-dropdown-content {
        display: block;
    }

    .profile-dropdown {
        position: relative;
        display: inline-block;
    }

    .profile-name {
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        padding: 10px;
    }

    .profile-dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #fff;
        min-width: 140px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 2;
        border-radius: 8px;
        text-align: left;
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
            <div class="dropdown">
                <a href="#">Donate ▾</a>
                <div class="dropdown-content">
                    <a href="{{ route('donate.form') }}">Make a Donation</a>
                    <a href="{{ route('donation.history') }}">Donation History</a>
                    <a href="{{ route('subscription.manage') }}">Subscription</a>
                </div>
            </div>
            <a href="{{ route('articles.index') }}">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="{{ route('campaign.index') }}">Campaign</a>
            <a href="#">Marketplace</a>
            <<a href="{{ route('pings.index') }}">Ping</a>

        </nav>
        <div class="icons">
            <img src="images/notifications-24px 1.svg" alt="Notifications">
            <img src="images/settings-24px 1.svg" alt="Settings">

            <div class="profile-dropdown">
                <span class="profile-name">Hi, {{ Auth::user()->name ?? 'User' }} ▾</span>
                <div class="profile-dropdown-content">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="poster">
            <img src="images/donation-image.png" alt="Charity Poster">
            <button>Donate Now</button>
        </div>
    </main>
</body>
</html>
