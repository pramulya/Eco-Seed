<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco-Seed | Join as Volunteer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <style>
        /* Same base styles as other pages */
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
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-family: inherit;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 15px;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            background-color: #EEFF6B;
        }

        .campaign-info {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container">
        <div class="form-container">
            <div class="campaign-info">
                <h2>{{ $campaign->campaign_name }}</h2>
                <p><strong>Type:</strong> {{ $campaign->campaign_type }}</p>
                <p><strong>Organizer:</strong> {{ $campaign->campaign_organizer }}</p>
            </div>

            <h3>Volunteer Application Form</h3>
            <form action="{{ route('campaigns.volunteer', $campaign->id) }}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="motivation">Why do you want to volunteer?</label>
                    <textarea id="motivation" name="motivation" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select id="availability" name="availability" required>
                        <option value="">Select availability</option>
                        <option value="Weekdays">Weekdays</option>
                        <option value="Weekends">Weekends</option>
                        <option value="Both">Both Weekdays and Weekends</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="skills">Relevant Skills</label>
                    <textarea id="skills" name="skills" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn">Submit Application</button>
            </form>
        </div>
    </div>
</body>
</html>