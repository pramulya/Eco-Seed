<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Create Campaign</title>
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
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 1rem;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 15px;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit {
            background-color: #EEFF6B;
        }

        .btn-cancel {
            background-color: #ff6b6b;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .file-input {
            margin-top: 10px;
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
            <a href="{{ route('campaign.index') }}">Campaign</a>
            <a href="#">Marketplace</a>
            <<a href="{{ route('pings.index') }}">Ping</a>

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

    <div class="container">
        <div class="form-container">
            <h2>Create New Campaign</h2>
            <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="campaign_name">Campaign Name</label>
                    <input type="text" id="campaign_name" name="campaign_name" required>
                </div>

                <div class="form-group">
                    <label for="campaign_type">Campaign Type</label>
                    <select id="campaign_type" name="campaign_type" required>
                        <option value="">Select Type</option>
                        <option value="Tree Planting">Tree Planting</option>
                        <option value="Conservation">Conservation</option>
                        <option value="Education">Education</option>
                        <option value="Community">Community</option>
                        <option value="Medical Aid">Medical Aid</option>
                        <option value="Disaster Recovery">Disaster Recovery</option>
                        <option value="Animal Rescue">Animal Rescue</option>
                        <option value="Clean Water Access">Clean Water Access</option>
                        <option value="Housing Support">Housing Support</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="campaign_category">Category</label>
                    <select id="campaign_category" name="campaign_category" required>
                        <option value="">Select Category</option>
                        <option value="Environmental">Environmental</option>
                        <option value="Social">Social</option>
                        <option value="Educational">Educational</option>
                        <option value="Health">Health</option>
                        <option value="Disaster Relief">Disaster Relief</option>
                        <option value="Animal Welfare">Animal Welfare</option>
                        <option value="Infrastructure">Infrastructure</option>
                        <option value="Human Rights">Human Rights</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="campaign_organizer">Organizer</label>
                    <input type="text" id="campaign_organizer" name="campaign_organizer" required>
                </div>

                <div class="form-group">
                    <label for="campaign_target">Target Amount ($)</label>
                    <input type="number" id="campaign_target" name="campaign_target" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="campaign_start_date">Start Date</label>
                    <input type="date" id="campaign_start_date" name="campaign_start_date" required>
                </div>

                <div class="form-group">
                    <label for="campaign_end_date">End Date</label>
                    <input type="date" id="campaign_end_date" name="campaign_end_date" required>
                </div>

                <div class="form-group">
                    <label for="campaign_description">Description</label>
                    <textarea id="campaign_description" name="campaign_description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Campaign Image</label>
                    <input type="file" id="image" name="image" class="file-input" accept="image/*">
                </div>

                <div class="button-group">
                    <a href="{{ route('campaign.index') }}" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-submit">Create Campaign</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>