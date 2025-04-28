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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required|numeric',
            'end_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'title.required' => 'Please select a title for your campaign',
            'description.required' => 'Please provide a description for your campaign',
            'target_amount.required' => 'Please enter your fundraising target amount',
            'target_amount.numeric' => 'The target amount must be a valid number',
            'end_date.required' => 'Please select when your campaign will end',
            'image.required' => 'Please select an image for your campaign',
            'image.image' => 'The uploaded file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif'
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/campaigns'), $imageName);
            $validatedData['image'] = 'images/campaigns/' . $imageName;
        }
    
        Campaign::create($validatedData);
    
        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign created successfully!');
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required|numeric',
            'end_date' => 'required|date',
        ], [
            'title.required' => 'Please select a title for your campaign',
            'description.required' => 'Please provide a description for your campaign',
            'target_amount.required' => 'Please enter your fundraising target amount',
            'target_amount.numeric' => 'The target amount must be a valid number',
            'end_date.required' => 'Please select when your campaign will end'
        ]);
    
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/campaigns'), $imageName);
            $validatedData['image'] = 'images/campaigns/' . $imageName;
        }
    
        $campaign->update($validatedData);
    
        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
    
        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign deleted successfully!');
    }
}