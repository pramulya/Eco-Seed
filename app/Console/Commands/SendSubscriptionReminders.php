<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Mail\SubscriptionRenewalReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSubscriptionReminders extends Command
{
    protected $signature = 'subscriptions:send-reminders';
    protected $description = 'Send email reminders before subscription renewal date';

    public function handle()
    {
        $reminderDate = now()->addDays(3);
        $subscriptions = Subscription::where('active', true)
            ->whereDate('next_renewal_at', '=', $reminderDate->toDateString())
            ->get();

        foreach ($subscriptions as $sub) {
            Mail::to($sub->user->email)->send(new SubscriptionRenewalReminder($sub));
        }

        $this->info('Reminders sent.');
    }
}
