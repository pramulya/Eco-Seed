<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Campaign;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function main() // This method must exist
    {
        return view('volunteer.main');
    }

    public function view($campaignId)
    {
        $campaign = Campaign::with('volunteers')->findOrFail($campaignId);
        return view('volunteer.view', compact('campaign'));
    }

    public function index($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);
        $volunteers = Volunteer::where('campaign_id', $campaignId)->get();
        return view('volunteer.index', compact('campaign', 'volunteers'));
    }

    public function create($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);
        return view('volunteer.register', compact('campaign'));
    }

    public function store(Request $request, $campaignId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'required|string|max:20',
            'motivation' => 'required|string',
            'availability_date' => 'required|date'
        ]);

        Volunteer::create(array_merge($validated, ['campaign_id' => $campaignId]));

        return redirect()->route('volunteer.index', $campaignId)
               ->with('success', 'Thank you for volunteering!');
    }
}