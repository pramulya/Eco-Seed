<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteer for {{ $campaign->campaign_name }} | Eco-Seed</title>
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
            max-width: 600px;
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
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 1rem;
        }
        .btn-submit {
            padding: 12px 25px;
            border-radius: 15px;
            border: none;
            background-color: #95eb50;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }
        .btn-submit:hover {
            opacity: 0.9;
        }
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .campaign-description {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            line-height: 1.5;
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
        <div class="form-container">
            <h1>Volunteer for: {{ $campaign->campaign_name }}</h1>
            
            <div class="campaign-description">
                <p>{{ $campaign->campaign_description }}</p>
            </div>
            
            @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('volunteer.store', $campaign->id) }}" method="POST" onsubmit="showNotification()">
                @csrf
                
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>

                <div class="form-group">
                    <label for="motivation">Motivation (Why do you want to volunteer?)</label>
                    <textarea id="motivation" name="motivation" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 10px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1rem;" required>{{ old('motivation') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="availability_date">Availability Date</label>
                    <input type="date" id="availability_date" name="availability_date" value="{{ old('availability_date') }}" required>
            </div>

                <button type="submit" class="btn-submit">Register as Volunteer</button>
            </form>

            <script>
            function showNotification() {
                alert('Thank you for registering as a volunteer! Your information is being submitted.');
            }
            </script>
        </div>
    </div>
// Add this to your <style> section
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #95eb50;
    color: black;
    padding: 15px 25px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 1000;
    display: none;
    font-weight: 600;
}

// Add this before </body>
<div id="toast" class="toast">Thank you for registering as a volunteer!</div>

<script>
function showToast() {
    const toast = document.getElementById('toast');
    toast.style.display = 'block';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

document.querySelector('form').addEventListener('submit', function() {
    showToast();
});
</script>
</body>
</html>