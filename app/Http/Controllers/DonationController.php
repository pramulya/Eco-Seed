<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    // Show the donation form
    public function showForm()
    {
        return view('donate'); // Blade view: resources/views/donate.blade.php
    }

    // Handle the form submission
    public function submitDonation(Request $request)
    {
        // Validation
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
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method
        ]);

        // Redirect back with success message
        return redirect()->route('donate.form')->with('success', 'Payment successful! Thank you for your donation.');
    }
}
