<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ping;
use Carbon\Carbon;


class PingController extends Controller
{
    public function index()
    {
        $pings = Ping::with('user')->latest()->paginate(10);

        $allPings = Ping::with('user')->latest()->paginate(10);

        $myPings = Ping::where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return view('ping.index', compact('allPings', 'myPings'));
    }

    public function create()
    {
        return view('ping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:280', // dibatasi di frontend ke 50 kata
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only('message');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('pings', 'public');
        }

        Ping::create($data);

        return redirect()->route('pings.index');
    }

    public function edit(Ping $ping)
    {
        // Batasi edit hanya dalam 5 menit
        if (Carbon::now()->diffInMinutes($ping->created_at) > 5) {
            return redirect()->route('pings.index')->with('error', 'Ping can only be edited within 5 minutes.');
        }

        return view('ping.edit', compact('ping'));
    }

    public function update(Request $request, Ping $ping)
    {
        $request->validate([
            'message' => 'required|string|max:280',
            'image' => 'nullable|image|max:2048',
        ]);

        $ping->message = $request->message;

        if ($request->hasFile('image')) {
            if ($ping->image) {
                Storage::disk('public')->delete($ping->image);
            }

            $path = $request->file('image')->store('pings', 'public');
            $ping->image = $path;
        }

        $ping->save();

        return redirect()->route('pings.index')->with('success', 'Ping updated successfully!');
    }

    public function destroy(Ping $ping)
    {
        // Batasi delete hanya dalam 3 menit
        if (Carbon::now()->diffInMinutes($ping->created_at) > 3) {
            return redirect()->route('pings.index')->with('error', 'Ping can only be deleted within 3 minutes.');
        }

        if ($ping->image) {
            Storage::disk('public')->delete($ping->image);
        }

        $ping->delete();

        return redirect()->route('pings.index')->with('success', 'Ping deleted successfully!');
    }


}
