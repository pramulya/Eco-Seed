<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subscription | Eco-Seed</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: "Plus Jakarta Sans", sans-serif; background: #f4f4f4; }
        .container { max-width: 700px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; }
        label { font-weight: 600; margin-top: 15px; display: block; }
        input, select { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; margin-bottom: 15px; }
        .alert-success { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 10px; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; color: white; cursor: pointer; }
        .btn-update { background: #007bff; }
        .btn-cancel { background: #dc3545; margin-top: 10px; }
    </style>
</head>
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
            <a href="#">Campaign</a>
            <a href="#">Marketplace</a>
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

<body>

    <div class="container">
        <h2>Manage Your Subscription</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($subscription)
            <p><strong>Amount:</strong> ${{ $subscription->amount }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($subscription->payment_method) }}</p>
            <p><strong>Frequency:</strong> {{ ucfirst($subscription->frequency) }}</p>
            <p><strong>Next Renewal:</strong> {{ $subscription->next_renewal_at->format('Y-m-d') }}</p>
            <p><strong>Status:</strong> {{ $subscription->active ? 'Active' : 'Canceled' }}</p>

            @if($subscription->active)
            <form action="{{ route('subscription.update') }}" method="POST">
                @csrf
                <label>Amount</label>
                <input type="number" name="amount" value="{{ $subscription->amount }}" required>

                <label>Payment Method</label>
                <select name="payment_method" required>
                    <option value="paypal" @selected($subscription->payment_method == 'paypal')>PayPal</option>
                    <option value="card" @selected($subscription->payment_method == 'card')>Credit/Debit Card</option>
                    <option value="apple_pay" @selected($subscription->payment_method == 'apple_pay')>Apple Pay</option>
                </select>

                <label>Frequency</label>
                <select name="frequency" required>
                    <option value="monthly" @selected($subscription->frequency == 'monthly')>Monthly</option>
                    <option value="yearly" @selected($subscription->frequency == 'yearly')>Yearly</option>
                </select>

                <button class="btn btn-update">Update</button>
            </form>

            <form action="{{ route('subscription.cancel') }}" method="POST">
                @csrf
                <button class="btn btn-cancel">Cancel Subscription</button>
            </form>
            @endif
        @else
            <p>You don’t have a subscription yet.</p>
            <a href="{{ route('subscription.create') }}" class="btn btn-update">Set Up Subscription</a>
        @endif
    </div>
</body>
</html>
