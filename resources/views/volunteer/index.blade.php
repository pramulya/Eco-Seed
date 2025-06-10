<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteers for {{ $campaign->campaign_name }} | Eco-Seed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
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
        .icons {
            display: flex;
            gap: 30px;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .volunteer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .volunteer-table th, .volunteer-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .volunteer-table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #95eb50;
            border-radius: 5px;
            font-weight: 600;
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


    <div class="container">
        <h1>Volunteers for: {{ $campaign->campaign_name }}</h1>
        
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($volunteers->count() > 0)
            <table class="volunteer-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Motivation</th>
                        <th>Availability Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteers as $volunteer)
                    <tr>
                        <td>{{ $volunteer->name }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->phone }}</td>
                        <td>{{ $volunteer->motivation }}</td>
                        <td>{{ $volunteer->availability_date ? \Carbon\Carbon::parse($volunteer->availability_date)->format('M d, Y') : 'Not specified' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No volunteers have registered yet, if you have already registered. please call or message the campaign host.</p>
        @endif

        <a href="{{ route('campaign.index') }}" class="back-btn">Back to Campaigns</a>
    </div>
</body>
</html>