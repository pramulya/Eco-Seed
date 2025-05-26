<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    public function showForm()
    {
        return view('donate'); 
    }

    public function submitDonation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'card_number' => 'nullable|required_if:payment_method,card',
            'card_expiration' => 'nullable|required_if:payment_method,card',
            'card_cvc' => 'nullable|required_if:payment_method,card',
        ]);

        // Store into database
        Donation::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method
        ]);

        return redirect()->route('donation.history')->with('success', 'Payment successful! Thank you for your donation.');

    }

    public function history()
    {
        $donations = Donation::orderBy('created_at', 'desc')->get(); 
        return view('donation-history', compact('donations'));
        // Redirect back with success message
        return redirect()->route('donate.form')->with('success', 'Payment successful! Thank you for your donation.');
    }
}
