<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation History | Eco-Seed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

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

        th, td {
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
        <a href="{{ route('dashboard') }}"><h2>Eco-Seed</h2></a>
        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="#">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="#">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="{{ asset('images/notifications-24px 1.svg') }}" alt="Notifications">
            <img src="{{ asset('images/settings-24px 1.svg') }}" alt="Settings">
            <img src="{{ asset('images/Ellipse 14.png') }}" alt="Profile">
        </div>
    </header>

    <div class="container">
        <h2>Donation History</h2>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                @if(session('success'))
                    alert("{{ session('success') }}");
                @endif
            });
</script>


        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $donation->name }}</td>
                        <td>{{ $donation->email }}</td>
                        <td>${{ number_format($donation->amount, 2) }}</td>
                        <td>{{ ucfirst($donation->payment_method) }}</td>
                        <td>{{ $donation->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No donations yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
