<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Make a Donation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background: #f9f9f9;
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
            align-items: center;
            gap: 10px;
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

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
        }

        .dropdown-content a:hover {
            background-color: #e5ffe5;
        }

        .dropdown:hover .dropdown-content {
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

        .profile-dropdown-content form {
            margin: 0;
        }

        .profile-dropdown-content button {
            background: none;
            border: none;
            width: 100%;
            padding: 12px 16px;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
        }

        .profile-dropdown-content button:hover {
            background-color: #e5ffe5;
        }

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        header img.tree-header {
            width: 60%;
            max-height: 500px;
            object-fit: cover;
            border-bottom: 4px solid #00a300;
            margin-left: 20%;
            margin-top: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .section {
            flex: 1;
            margin: 0 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .amount-display {
            margin-top: 10px;
            font-weight: bold;
        }

        .continue-button {
            text-align: right;
            padding: 20px;
        }

        button {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        #cardFields {
            display: none;
            transition: all 0.3s ease;
        }
    </style>

    <script>
        function updateAmount(val) {
            document.getElementById('amountDisplay').innerText = '$' + val;
        }

        function toggleCardFields() {
            const method = document.getElementById('payment_method').value;
            const cardFields = document.getElementById('cardFields');
            cardFields.style.display = method === 'card' ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleCardFields();

            @if(session('success'))
                alert("{{ session('success') }}");
            @endif
        });
    </script>
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
            <a href="#">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="{{ route('campaign.index') }}">Campaign</a>
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

    <header>
        <img src="{{ asset('images/Big Tree Image.jpg') }}" alt="Big tree image" class="tree-header">
    </header>

    <form action="{{ route('donate.submit') }}" method="POST">
        @csrf
        <div class="container">
            <div class="section">
                <h2>Choose donation amount</h2>
                <label for="amount">Donate</label><br>
                <input type="range" min="1" max="500" value="100" name="amount" oninput="updateAmount(this.value)">
                <div class="amount-display">
                    Selected: <span id="amountDisplay">$100</span>
                </div>
                <small>Slide the button to your desired amount of donation</small>
            </div>

            <div class="section">
                <h2>Personal Information</h2>

                <label>Name</label>
                <input type="text" name="name" required maxlength="100">

                <label>Email</label>
                <input type="email" name="email" required maxlength="100">

                <label>Payment Method</label>
                <select name="payment_method" id="payment_method" onchange="toggleCardFields()" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="apple_pay">Apple Pay</option>
                </select>

                <div id="cardFields">
                    <label>Card Number</label>
                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456">

                    <label>Expiration (MM/YY)</label>
                    <input type="text" name="card_expiration" placeholder="MM/YY">

                    <label>CVC</label>
                    <input type="text" name="card_cvc" placeholder="123">
                </div>
            </div>
        </div>

        <div class="continue-button">
            <button type="submit">Make Payment</button>
        </div>
    </form>

</body>

</html>
