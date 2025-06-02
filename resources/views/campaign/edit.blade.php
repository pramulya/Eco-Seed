<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Edit Campaign</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <style>
        /* Same styles as create.blade.php */
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

        .current-image {
            margin-top: 10px;
            max-width: 200px;
            border-radius: 8px;
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
        <div class="form-container">
            <h2>Edit Campaign</h2>
            <form action="{{ route('campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="campaign_name">Campaign Name</label>
                    <input type="text" id="campaign_name" name="campaign_name" value="{{ $campaign->campaign_name }}" required>
                </div>

                <div class="form-group">
                    <label for="campaign_type">Campaign Type</label>
                    <select id="campaign_type" name="campaign_type" required>
                        <option value="">Select Type</option>
                        <option value="Tree Planting" {{ $campaign->campaign_type == 'Tree Planting' ? 'selected' : '' }}>Tree Planting</option>
                        <option value="Conservation" {{ $campaign->campaign_type == 'Conservation' ? 'selected' : '' }}>Conservation</option>
                        <option value="Education" {{ $campaign->campaign_type == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Community" {{ $campaign->campaign_type == 'Community' ? 'selected' : '' }}>Community</option>
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
                        <option value="Environmental" {{ $campaign->campaign_category == 'Environmental' ? 'selected' : '' }}>Environmental</option>
                        <option value="Social" {{ $campaign->campaign_category == 'Social' ? 'selected' : '' }}>Social</option>
                        <option value="Educational" {{ $campaign->campaign_category == 'Educational' ? 'selected' : '' }}>Educational</option>
                        <option value="Health">Health</option>
                        <option value="Disaster Relief">Disaster Relief</option>
                        <option value="Animal Welfare">Animal Welfare</option>
                        <option value="Infrastructure">Infrastructure</option>
                        <option value="Human Rights">Human Rights</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="campaign_organizer">Organizer</label>
                    <input type="text" id="campaign_organizer" name="campaign_organizer" value="{{ $campaign->campaign_organizer }}" required>
                </div>

                <div class="form-group">
                    <label for="campaign_target">Target Amount ($)</label>
                    <input type="number" id="campaign_target" name="campaign_target" value="{{ $campaign->campaign_target }}" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="campaign_start_date">Start Date</label>
                    <input type="date" id="campaign_start_date" name="campaign_start_date" value="{{ $campaign->campaign_start_date }}" required>
                </div>

                <div class="form-group">
                    <label for="campaign_end_date">End Date</label>
                    <input type="date" id="campaign_end_date" name="campaign_end_date" value="{{ $campaign->campaign_end_date }}" required>
                </div>

                <div class="form-group">
                    <label for="campaign_description">Description</label>
                    <textarea id="campaign_description" name="campaign_description" required>{{ $campaign->campaign_description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Campaign Image</label>
                    @if($campaign->image_path)
                        <img src="{{ asset($campaign->image_path) }}" alt="Current campaign image" class="current-image">
                    @endif
                    <input type="file" id="image" name="image" class="file-input" accept="image/*">
                </div>

                <div class="button-group">
                    <a href="{{ route('campaign.index') }}" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-submit">Update Campaign</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>