<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Volunteer;
use App\Models\Donation;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount(['volunteers', 'donations'])->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function show($id)
    {
        $campaign = Campaign::with('volunteers', 'donations')->findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }

    public function joinVolunteer(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        Volunteer::create($request->all());

        return redirect()->back()->with('success', 'Thanks for joining as a volunteer!');
    }

    public function donate(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        Donation::create($request->all());

        return redirect()->back()->with('success', 'Thank you for your donation!');
    }
}