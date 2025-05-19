<?php

namespace App\Http\Controllers\Campaign;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('campaign.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaign.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'campaign_type' => 'required|string',
            'campaign_category' => 'required|string',
            'campaign_organizer' => 'required|string|max:255',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'required|date|after:campaign_start_date',
            'campaign_target' => 'required|numeric|min:0',
            'campaign_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Add year from start date
        $validated['year'] = Carbon::parse($request->campaign_start_date)->year;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/campaigns'), $imageName);
            $validated['image_path'] = 'images/campaigns/' . $imageName;
        }

        Campaign::create($validated);

        return redirect()->route('campaign.index')->with('success', 'Campaign created successfully!');
    }

    public function show(Campaign $campaign)
    {
        return view('campaign.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('campaign.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'campaign_type' => 'required|string',
            'campaign_category' => 'required|string',
            'campaign_organizer' => 'required|string|max:255',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'required|date|after:campaign_start_date',
            'campaign_target' => 'required|numeric|min:0',
            'campaign_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update year from start date
        $validated['year'] = Carbon::parse($request->campaign_start_date)->year;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($campaign->image_path && file_exists(public_path($campaign->image_path))) {
                unlink(public_path($campaign->image_path));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/campaigns'), $imageName);
            $validated['image_path'] = 'images/campaigns/' . $imageName;
        }

        $campaign->update($validated);

        return redirect()->route('campaign.index')->with('success', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        // Delete campaign image if exists
        if ($campaign->image_path && file_exists(public_path($campaign->image_path))) {
            unlink(public_path($campaign->image_path));
        }

        $campaign->delete();
        return redirect()->route('campaign.index')->with('success', 'Campaign deleted successfully!');
    }

    public function showVolunteerForm(Campaign $campaign)
    {
        return view('campaign.volunteer', compact('campaign'));
    }

    public function joinVolunteer(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'motivation' => 'required|string',
            'availability' => 'required|string',
            'skills' => 'required|string'
        ]);
    
    
        return redirect()->route('campaign.show', $request->campaign_id)
            ->with('success', 'Thank you for volunteering! We will contact you soon.');
    }
    
    public function volunteers(Campaign $campaign)
    {
        $volunteers = $campaign->volunteers()->orderBy('created_at', 'desc')->get();
        return view('campaign.volunteers', compact('campaign', 'volunteers'));
    }

    public function showDonationForm(Campaign $campaign)
    {
        return view('campaign.donate', compact('campaign'));
    }

    public function processDonation(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'email' => 'required|email',
            'message' => 'nullable|string'
        ]);
    
        Donation::create($validated);
        return redirect()->back()->with('success', 'Thank you for your donation!');
    }
}