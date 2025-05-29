<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SubscriptionCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your Eco-Seed Subscription Has Been Cancelled')
                    ->view('emails.subscription_cancelled')
                    ->with([
                        'user' => $this->user,
                    ]);
    }
}
