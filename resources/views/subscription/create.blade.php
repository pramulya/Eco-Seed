<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recurring Donation | Eco-Seed</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: "Plus Jakarta Sans", sans-serif; background: #f4f4f4; }
        .container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; }
        label { font-weight: 600; display: block; margin-top: 15px; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
        button { margin-top: 20px; padding: 12px 25px; background-color: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background-color: #218838; }
        .alert-success { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-top: 10px; }
    </style>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Donation History | Eco-Seed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background: #f0f0f0;
            padding: 0;
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

        .icons {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-name {
            cursor: pointer;
            font-weight: 600;
            padding: 10px;
            font-size: 1rem;
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

        .container {
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

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
            <a href="#">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="Notifications">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="Settings">

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

</head>
<body>


    <div class="container">
        <h2>Set Up Recurring Donation</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('subscription.store') }}" method="POST">
            @csrf
            <label>Amount</label>
            <input type="number" name="amount" required min="1">

            <label>Payment Method</label>
            <select name="payment_method" required>
                <option value="">-- Select --</option>
                <option value="paypal">PayPal</option>
                <option value="card">Credit/Debit Card</option>
                <option value="apple_pay">Apple Pay</option>
            </select>

            <label>Frequency</label>
            <select name="frequency" required>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>

            <button type="submit">Subscribe</button>
        </form>
    </div>
</body>
</html>
