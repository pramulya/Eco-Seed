<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all donations (or you can filter/summarize)
        $donations = Donation::orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('donations'));
    }
}
