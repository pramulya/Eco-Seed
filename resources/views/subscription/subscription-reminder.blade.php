<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Reminder</title>
</head>
<body style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div style="background: #ffffff; padding: 25px; border-radius: 8px;">
        <h2>Hello {{ $subscription->user->name }},</h2>
        <p>This is a reminder that your <strong>Eco-Seed recurring donation</strong> will renew soon.</p>

        <ul>
            <li><strong>Amount:</strong> ${{ $subscription->amount }}</li>
            <li><strong>Payment Method:</strong> {{ ucfirst($subscription->payment_method) }}</li>
            <li><strong>Renewal Date:</strong> {{ $subscription->next_renewal_at->format('Y-m-d') }}</li>
        </ul>

        <p>If you'd like to update or cancel your subscription, log in to your account.</p>
        <p>Thank you for supporting our mission 🌱</p>
    </div>
</body>
</html>
