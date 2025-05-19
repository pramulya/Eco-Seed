<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Campaign;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function create($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view('volunteer.create', compact('campaign'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'motivation' => 'required|string',
            'availability' => 'required|string',
            'skills' => 'required|string',
            'campaign_id' => 'required|exists:campaigns,id'
        ]);

        Volunteer::create($validated);

        return redirect()->route('campaign.show', $request->campaign_id)
            ->with('success', 'Thank you for volunteering! We will contact you soon.');
    }

    public function index($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $volunteers = Volunteer::where('campaign_id', $campaign_id)->get();
        return view('volunteer.index', compact('campaign', 'volunteers'));
    }

    public function mainIndex()
    {
        $volunteers = Volunteer::with('campaign')->get();
        return view('volunteer.main', compact('volunteers'));
    }
}