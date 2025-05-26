<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Mail\SubscriptionCancelled;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function create()
    {
        return view('subscription.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'frequency' => 'required|in:monthly,yearly',
        ]);

        $nextRenewal = now()->add($request->frequency === 'monthly' ? 1 : 12, 'month');

        Subscription::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'frequency' => $request->frequency,
            'next_renewal_at' => $nextRenewal
        ]);

        return redirect()->route('subscription.manage')->with('success', 'Subscription created.');
    }

    public function manage()
    {
        $subscription = Subscription::where('user_id', Auth::id())->first();
        return view('subscription.manage', compact('subscription'));
    }

    public function update(Request $request)
    {
        $subscription = Subscription::where('user_id', Auth::id())->firstOrFail();

        $subscription->update([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'frequency' => $request->frequency,
        ]);

        return back()->with('success', 'Subscription updated.');
    }
    public function cancel()
    {
        $subscription = Subscription::where('user_id', Auth::id())->firstOrFail();
        $subscription->update(['active' => false]);

        Mail::to(Auth::user()->email)->send(new SubscriptionCancelled(Auth::user()));

        return back()->with('success', 'Subscription canceled.');
    }
}
