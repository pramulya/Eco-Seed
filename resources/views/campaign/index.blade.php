<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Campaigns</title>
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

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .create-button {
            background-color: #EEFF6B;
            padding: 15px 30px;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .create-button:hover {
            background-color: rgb(130, 145, 12);
            transition: 0.3s;
        }

        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .campaign-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .campaign-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .campaign-info {
            margin: 15px 0;
        }

        .campaign-info p {
            margin: 8px 0;
            color: #555;
        }

        .campaign-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #EEFF6B;
        }

        .btn-delete {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-donate {
            background-color: #95eb50;
            color: white;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
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
            <a href="{{ route('campaign.index') }}">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="">
        </div>
    </header>

    <div class="container">
        <div class="header-section">
            <h2>Our Campaigns</h2>
            <a href="{{ route('campaign.create') }}" class="create-button">Create Campaign</a>
        </div>

        <div class="campaign-grid">
            @foreach($campaigns as $campaign)
            <div class="campaign-card">
                <img src="{{ $campaign->image_path ? asset($campaign->image_path) : asset('images/default-campaign.jpg') }}" alt="{{ $campaign->campaign_name }}">
                <h3>{{ $campaign->campaign_name }}</h3>
                <div class="campaign-info">
                    <p><strong>Type:</strong> {{ $campaign->campaign_type }}</p>
                    <p><strong>Category:</strong> {{ $campaign->campaign_category }}</p>
                    <p><strong>Target:</strong> ${{ number_format($campaign->campaign_target, 2) }}</p>
                    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($campaign->campaign_end_date)->format('M d, Y') }}</p>
                </div>
                <div class="campaign-actions">
                    <a href="{{ route('campaign.edit', $campaign->id) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('campaign.destroy', $campaign->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
                <a href="{{ route('donate.form', ['campaign_id' => $campaign->id]) }}" class="btn btn-donate">Donate Now</a>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>